<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 08.08.2018
 * Time: 19:19
 */

namespace Model\ConsoleManager\Importer;

use Model\DataAccess\Repository\GenreRepository;
use Model\Domain\Entity\Genre;

class GenreImporter
{
    private $csvFormat;
    private $genreRepository;

    /**
     * GenreImporter constructor.
     * @param $csvFormat array
     * @param $genreRepository GenreRepository
     */
    public function __construct(array $csvFormat, GenreRepository $genreRepository)
    {
        $this->csvFormat       = $csvFormat;
        $this->genreRepository = $genreRepository;
    }

    /**
     * Input csv here is an array with n elements which has at position 0 the names of the columns and on the next n-1
     * elements represent actual genre records with id on position 0 and name on position 1.
     * @see \OptionValidator for validation of csv format.
     */
    public function import()
    {
        foreach ($this->csvFormat as $record) {
            $genre = new Genre($record[0], $record[1]);
            $this->genreRepository->insertHardCodedId($genre);
        }
    }


}