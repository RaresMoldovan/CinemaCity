<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 06.08.2018
 * Time: 18:49
 */

namespace Model\DataAccess\Mapper;

use Model\DataAccess\Repository\GenreRepository;
use Model\DataAccess\Repository\MovieRepository;
use Model\Domain\Entity\Entity;
use Model\Domain\Entity\Movie;
use Model\Domain\Entity\NullEntity;

class MovieMapper extends EntityMapper
{

    const FIELD_YEAR = 'year';
    const FIELD_DESCRIPTION = 'description';
    const FIELD_IMAGE = 'image';

    private $genreRepository;

    /**
     * MovieMapper constructor.
     * @param GenreRepository $genreRepository
     */
    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    /**
     * @param array $associative
     * @return Entity
     */
    public function map(array $associative): Entity
    {
        $id          = $associative[parent::FIELD_ID];
        $name        = $associative[parent::FIELD_NAME];
        $year        = $associative[self::FIELD_YEAR];
        $description = $associative[self::FIELD_DESCRIPTION];
        $image       = $associative[self::FIELD_IMAGE];

        //Construct the movie object without any genres attached
        $movie = new Movie($id, $name, $description, $year, $image);

        //Attach the genres
        $genres = $this->genreRepository->getGenresForMovie($id);
        foreach ($genres as $genre) {
            $movie->addGenre($genre);
        }
        return $movie;
    }

}