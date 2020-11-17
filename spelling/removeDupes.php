<?php

/*
 * Reads words from two files
 * Prints words from file-new-words with words from file-old-words removed
 */

if(isset($argv[1]) && isset($argv[2])) {
  $fileNewWords = $argv[1];
  $fileOldWords = $argv[2];
} else {
  die("Usage: php removeDupes.php <file-new-words> <file-old-words>");
}

$newWords = getWordsFromFile($fileNewWords);
$oldWords = getWordsFromFile($fileOldWords);

$finalList = array();
foreach($newWords as $word => $bool) {
  if(!isset($oldWords[$word])) {
    $finalList[] = $word;
  }
}

sort($finalList);
foreach($finalList as $word) {
  echo "$word\n";
}

function getWordsFromFile($filename) {
  try {
    $contents = file_get_contents($filename);
  } catch(Exception $e) {
    die("Could not open file ($filename): " . $e->getMessage());
  }
  $lines = explode("\n", $contents);
  $words = array();
  foreach($lines as $line) {
    $word = trim($line);
    if($word != "") {
      $words[$word] = true;
    }
  }
  return $words;
}
