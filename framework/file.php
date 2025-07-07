<?php
class file {
  static function extract($file, $files = [], $dest) {
    $zip = new ZipArchive();
    $zip->open($file);
    $zip->extractTo($dest, $files);
    $zip->close();
  }

  static function filename($file) {
    $parts = explode('\\', $file);
    $filename = array_pop($parts);
    return $filename;
  }

  static function dir($file) {
    $filename = self::filename($file);
    $dir = str_replace("\\$filename", "", $file);
    return $dir;
  }

  static function dex2jar($dexFile) {
    $jarFile = str_replace(".dex", ".jar", $dexFile);
    exec(DEX2JAR_PATH . "\\d2j-dex2jar.bat -f -o $jarFile $dexFile");
    return $jarFile;
  }

  static function jar2dex($jarFile) {
    $dexFile = str_replace(".jar", ".dex", $jarFile);
    exec(DEX2JAR_PATH . "\\d2j-jar2dex.bat -f -o $dexFile $jarFile");
    return $dexFile;
  }

  static function deleteFromZip($zipFile, $entities = []) {
    foreach ($entities as $entity) {
      exec(ZIP . " -d $zipFile \"$entity/*\"");
    }
  }

  static function ext($path) {
    $parts = explode('.', $path);
    return array_pop($parts);
  }

  static function copy_as($oldFile, $newName) {
    $oldExt = self::ext($oldFile);
    $oldName = self::filename($oldFile);
    $oldName = str_replace(".$oldExt", "", $oldName);
    $newFile = str_replace("$oldName.$oldExt", "$newName.$oldExt", $oldFile);
    $cmd = "copy \"$oldFile\" \"$newFile\"";
    exec($cmd);
    return $newFile;
  }

  static function zip($zipName, $files) {
    $zip = new ZipArchive();
    $zip->open($zipName, ZipArchive::CREATE);
    foreach ($files as $path => $localName) {
      $zip->addFile($path, $localName);
    }

    $zip->close();
  }

  static function del($files) {
    foreach ($files as $file) {
      unlink($file);
    }
  }
}
