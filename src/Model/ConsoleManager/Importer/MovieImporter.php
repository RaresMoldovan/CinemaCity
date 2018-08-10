<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 08.08.2018
 * Time: 19:19
 */
namespace Model\ConsoleManager\Importer;

use Model\DataAccess\Repository\GenreRepository;
use Model\DataAccess\Repository\MovieRepository;
use Model\Domain\Entity\Movie;
class MovieImporter
{
    private $csvFormat;
    private $movieRepository;
    private $genreRepository;

    /**
     * MovieImporter constructor.
     * @param $csvFormat array
     * @param $movieRepository MovieRepository
     * @param $genreRepository GenreRepository
     */
    public function __construct(array $csvFormat, MovieRepository $movieRepository, GenreRepository $genreRepository)
    {
        $this->csvFormat =  $csvFormat;
        $this->movieRepository = $movieRepository;
        $this->genreRepository = $genreRepository;
    }

    /**
     * @throws \Exception
     */
    public function import()
    {
        foreach($this->csvFormat as $record)
        {
            $movie = new Movie($record[0], $record[1], $record[2], (int)$record[3], $record[4]);
            $record[5] = trim($record[5]);
            $genres = explode(',', $record[5]);
            foreach($genres as $genreName) {
                $genre = $this->genreRepository->findByColumn('name', $genreName);
                if($genre===null) {
                    throw new \Exception('Genre not found!');
                }
                $movie->addGenre($genre->current());
            }
            $this->movieRepository->insertHardCodedId($movie);
        }
    }


}