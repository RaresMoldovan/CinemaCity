<?php
require_once '../vendor/autoload.php';

use Model\ConsoleManager\Application;
use Model\ConsoleManager\Output\ErrorReporter;

$application = new Application(new ErrorReporter());
$application->runShowImporter();
