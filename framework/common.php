<?php

function dump($object) {
  echo "\r\n";
  if (is_string($object)) {
    echo $object;
    return;
  }

  if (is_array($object)) {
    print_r($object);
    return;
  }

  if ($object === null) {
    echo "null";
    return;
  }

  var_dump($object);
}