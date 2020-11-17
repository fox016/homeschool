<?php

const listSize = 15; // Number of words in each week's list
const startWeek = 14; // Number to use to start counting weeks (for display only)

// Get input filename from command line args
// Input file is a list of words with one word per line
if(isset($argv[1]))
  $file = $argv[1];
else
  die("Usage: php process.php <filename>\n");

// Open file
try
{
  $contents = file_get_contents($file);
}
catch(Exception $e)
{
  die("Could not open file $file: " . $e->getMessage());
}

// Parse file into array of words
$lines = explode("\n", $contents);
$wordList = array();
foreach($lines as $line)
{
  $word = trim($line);
  if($word != "")
      $wordList[] = $word;
}

// Divide words into random lists of size listSize
$week = startWeek;
$weekWords = array();
while(count($wordList))
{
  $index = rand(0, count($wordList)-1);
  $weekWords[] = $wordList[$index];
  array_splice($wordList, $index, 1);
  if(count($weekWords) == listSize)
  {
    printList($weekWords, $week);
    $week++;
    $weekWords = array();
  }
}
if(!empty($weekWords))
  printList($weekWords, $week);

/*
 * Print list of words associated with given week #
 */
function printList($words, $week)
{
  echo "=== Week $week ===\n";
  foreach($words as $w)
    echo "$w\n";
  echo "\n";
}
