<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 08.08.2018
 * Time: 19:19
 */

namespace Model\ConsoleManager\Importer;

use Model\DataAccess\Repository\HallRepository;
use Model\DataAccess\Repository\MovieRepository;
use Model\DataAccess\Repository\ShowRepository;
use Model\Domain\Entity\Show;

class ShowImporter
{
    private $showRepository;
    private $movieRepository;
    private $hallRepository;

    /**
     * ShowImporter constructor.
     * @param $showRepository
     * @param $movieRepository
     * @param $hallRepository
     */
    public function __construct(ShowRepository $showRepository, MovieRepository $movieRepository, HallRepository $hallRepository)
    {
        $this->showRepository  = $showRepository;
        $this->movieRepository = $movieRepository;
        $this->hallRepository  = $hallRepository;
    }

    /**
     * @param string $movieName
     * @param string $hallName
     * @param string $day
     * @param string $month
     * @param string $year
     * @param string $hour
     * @param string $minutes
     * @throws \Exception
     */
    public function import(string $movieName, string $hallName, string $day, string $month, string $year, string $hour, string $minutes)
    {
        $movie = $this->movieRepository->findByColumn('name', $movieName);
        $hall = $this->hallRepository->findByColumn('name', $hallName);
        if($movie===null) {
            throw new \Exception('Movie not found in the database!');
        }
        if($hall===null) {
            throw new \Exception('Hall not found in the database!');
        }
        $date = $this->formatDate($day, $month, $year, $hour, $minutes);
        $this->showRepository->insert(new Show(1, $movie->current(), $hall->current(), $date));


    }


    public function formatDate(string $day, string $month, string $year, string $hour, string $minutes) : string
    {
        $dateString = '';
        $dateString .= $year . '-';
        $dateString .= (strlen($month)<2 ? '0' . $month : $month) . '-';
        $dateString .= (strlen($day)<2 ? '0' . $day : $day) . ' ';
        $dateString .= (strlen($hour)<2 ? '0' . $hour : $hour) . ':';
        $dateString .= (strlen($hour)<2 ? '0' . $minutes : $minutes) . ':';
        $dateString .= '00';
        return $dateString;
    }
}