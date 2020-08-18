<?php

const listSize = 15;

if(isset($argv[1]))
  $file = $argv[1];
else
  die("Usage: php process.php <filename>\n");
try
{
  $contents = file_get_contents($file);
}
catch(Exception $e)
{
  die("Could not open file $file: " . $e->getMessage());
}

$lines = explode("\n", $contents);
$wordList = array();
foreach($lines as $line)
{
  $word = trim($line);
  if($word != "")
      $wordList[] = $word;
}

$week = 1;
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

function printList($words, $week)
{
  echo "=== Week $week ===\n";
  foreach($words as $w)
    echo "$w\n";
  echo "\n";
}

?>
