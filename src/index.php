<?php

require_once '../vendor/autoload.php';
use Model\ConsoleManager\Input\CSVReader;

$csvReader = new CSVReader('genres.csv',"|");
$csvReader->readCSV();