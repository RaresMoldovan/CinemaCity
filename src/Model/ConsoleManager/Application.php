<?php

namespace Model\ConsoleManager;

use Model\ConsoleManager\Importer\HallImporter;
use Model\ConsoleManager\Importer\MovieImporter;
use Model\ConsoleManager\Importer\ShowImporter;
use Model\ConsoleManager\Input\CSVReader;
use Model\ConsoleManager\Input\OptionReader;
use Model\DataAccess\Connection\DatabaseConfiguration;
use Model\DataAccess\Connection\DatabaseConnection;
use Model\DataAccess\Repository\GenreRepository;
use Model\ConsoleManager\Importer\GenreImporter;
use Model\ConsoleManager\Output\ErrorReporter;
use Model\ConsoleManager\Validator\ShowOptionValidator;
use Model\ConsoleManager\Validator\CSVOptionValidator;
use Model\DataAccess\Repository\HallRepository;
use Model\DataAccess\Repository\MovieRepository;
use Model\DataAccess\Repository\SeatRepository;
use Model\DataAccess\Repository\ShowRepository;

class Application
{
    private $errorReporter;
    private $databaseConfiguration;
    private $databaseConnection;

    /**
     * Application constructor.
     * @param $errorReporter
     */
    public function __construct(ErrorReporter $errorReporter)
    {
        $this->errorReporter         = $errorReporter;
        $config = require __DIR__ . '/../DataAccess/config.php';
        $this->databaseConfiguration = new DatabaseConfiguration($config['host'], $config['databaseName'], $config['username'], $config['password']);
        $this->databaseConnection    = new DatabaseConnection($this->databaseConfiguration);
    }

    /**
     * Function that performs the main flow of the genre importing mechanism.
     */
    public function runGenresImporter(): void
    {
        $csvData         = $this->commonFlow();
        $genreRepository = new GenreRepository($this->databaseConnection->getPDO());
        $genreImporter   = new GenreImporter($csvData, $genreRepository);
        $genreImporter->import();

    }

    /**
     * Function that performs the main flow of the genre importing mechanism.
     */
    public function runHallImporter(): void
    {
        $csvData        = $this->commonFlow();
        $hallRepository = new HallRepository($this->databaseConnection->getPDO());
        $seatRepository = new SeatRepository($this->databaseConnection->getPDO(), $hallRepository);
        $hallImporter   = new HallImporter($csvData, $hallRepository, $seatRepository);
        try {
            $hallImporter->import();
        } catch (\Exception $e) {
            $this->errorReporter->report($e->getMessage());
        }
    }

    /**
     * Function that performs the main flow of the movie importing mechanism.
     */
    public function runMovieImporter(): void
    {
        $csvData         = $this->commonFlow();
        $genreRepository = new GenreRepository($this->databaseConnection->getPDO());
        $movieRepository = new MovieRepository($this->databaseConnection->getPDO(), $genreRepository);
        $movieImporter   = new MovieImporter($csvData, $movieRepository, $genreRepository);
        try {
            $movieImporter->import();
        } catch (\Exception $e) {
            $this->errorReporter->report($e->getMessage());
        }
    }


    /**
     * @return array
     */
    private function commonFlow(): array
    {
        global $argv, $argc;
        $optionValidator = new CSVOptionValidator();
        if ($argc < 2) {
            $this->errorReporter->report('You must submit a CSV file');
            exit;
        }
        $fileName = $argv[1];
        $message  = $optionValidator->validateFileName($fileName);
        if ($message !== '') {
            $this->errorReporter->report($message);
            exit;
        }
        $csvReader = new CSVReader($fileName, '|');
        $csvData   = [];

        try {
            $csvData = $csvReader->getContent();
        } catch (\Exception $e) {
            $this->errorReporter->report($e->getMessage());
            exit;
        }
        return $csvData;
    }

    /**
     * Function that performs the main flow of the show import mechanism.
     */
    public function runShowImporter(): void
    {
        $optionReader = new OptionReader(['day','month','year','hour','minute','movie','hall'],[]);
        $optionValidator = new ShowOptionValidator($optionReader->getOptions());
        $message = $optionValidator->validateArguments();
        if($message!=='') {
            $this->errorReporter->report($message);
            exit;
        }
        $genreRepository = new GenreRepository($this->databaseConnection->getPDO());
        $movieRepository = new MovieRepository($this->databaseConnection->getPDO(), $genreRepository);
        $hallRepository = new HallRepository($this->databaseConnection->getPDO());
        $showRepository = new ShowRepository($this->databaseConnection->getPDO(), $movieRepository, $hallRepository);
        $showImporter = new ShowImporter($showRepository, $movieRepository, $hallRepository);
        try {
            $showImporter->import($optionReader->getOption('movie'),
                $optionReader->getOption('hall'),
                $optionReader->getOption('day'),
                $optionReader->getOption('month'),
                $optionReader->getOption('year'),
                $optionReader->getOption('hour'),
                $optionReader->getOption('minute'));
        }catch(\Exception $exception) {
            $this->errorReporter->report($exception->getMessage());
            exit;
        }

    }
}