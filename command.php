<?php
const DEX2JAR_PATH = '.\\ProjectDependencies\\dex_tools';
const ZIP = '.\\ProjectDependencies\\zip\\bin\\zip.exe';

require_once "framework/common.php";
require_once "framework/file.php";

$action = $argv[1];
$action = str_replace("-", "_", $action);
$params = array_slice($argv, 2);
call_user_func($action, ...$params);

function minify_dex($file) {
    $wd = file::dir($file) . "\\YourProjectFiles";

    file::extract($file, [
        'classes.dex',
    ], $wd);

    $dexFile = "$wd\\classes.dex";
    $jarFile = file::dex2jar($dexFile);
    dump($jarFile);

    file::deleteFromZip($jarFile, [
        'android',
        'androidx',
        'kotlin',
        'kotlinx',
        'okhttp3',
        'okio',
        'org',
        'com/google',
        'com/squareup',
        'com/mikepenz',
    ]);

    $newDexFile = file::jar2dex($jarFile);
    $timestamp = time();
    $zipName = "$wd\\publish-$timestamp.zip";
    file::zip($zipName, [
        $newDexFile => 'core.dex',
    ]);

    file::del([
        "$wd\\classes.dex",
        //"$wd\\classes.jar",
    ]);
}