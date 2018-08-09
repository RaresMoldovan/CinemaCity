<?php

namespace Model\ConsoleManager;

use Model\ConsoleManager\Importer\HallImporter;
use Model\ConsoleManager\Importer\MovieImporter;
use Model\ConsoleManager\Input\CSVReader;
use Model\DataAccess\Connection\DatabaseConfiguration;
use Model\DataAccess\Connection\DatabaseConnection;
use Model\DataAccess\Repository\GenreRepository;
use Model\ConsoleManager\Importer\GenreImporter;
use Model\ConsoleManager\Output\ErrorReporter;
use Model\ConsoleManager\Validator\OptionValidator;
use Model\DataAccess\Repository\HallRepository;
use Model\DataAccess\Repository\MovieRepository;
use Model\DataAccess\Repository\SeatRepository;

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
        $this->databaseConfiguration = new DatabaseConfiguration('mysql', 'cinema', 'root', '');
        $this->databaseConnection    = new DatabaseConnection($this->databaseConfiguration);
    }

    /**
     * Function that performs the main flow of the genre importing mechanism.
     */
    public function runGenresImporter()
    {
        $csvData         = $this->commonFlow();
        $genreRepository = new GenreRepository($this->databaseConnection->getPDO());
        $genreImporter   = new GenreImporter($csvData, $genreRepository);
        $genreImporter->import();

    }

    /**
     * Function that performs the main flow of the genre importing mechanism.
     */
    public function runHallImporter()
    {
        $csvData        = $this->commonFlow();
        $hallRepository = new HallRepository($this->databaseConnection->getPDO());
        $seatRepository = new SeatRepository($this->databaseConnection->getPDO());
        $hallImporter   = new HallImporter($csvData, $hallRepository, $seatRepository);
        try {
            $hallImporter->import();
        } catch (\Exception $e) {
            $this->errorReporter->report($e->getMessage());
        }
    }

    public function runMovieImporter()
    {
        $csvData         = $this->commonFlow();
        $genreRepository = new GenreRepository($this->databaseConnection->getPDO());
        $movieRepository = new MovieRepository($this->databaseConnection->getPDO(), $genreRepository);
        $movieImporter = new MovieImporter($csvData, $movieRepository, $genreRepository);
        try {
            $movieImporter->import();
        }catch(\Exception $e) {
            $this->errorReporter->report($e->getMessage());
        }
    }


    /**
     * @return array
     */
    private
    function commonFlow(): array
    {
        global $argv, $argc;
        $optionValidator = new OptionValidator([]);
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
}