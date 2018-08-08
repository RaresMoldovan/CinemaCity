<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 06.08.2018
 * Time: 18:50
 */

namespace Model\DataAccess\Mapper;

use Model\DataAccess\Repository\HallRepository;
use Model\DataAccess\Repository\MovieRepository;
use Model\Domain\Entity\Entity;
use Model\Domain\Entity\Show;

class ShowMapper extends EntityMapper
{
    const FIELD_MOVIE = 'movie_id';
    const FIELD_HALL = 'hall_id';

    private $movieRepository;
    private $hallRepository;

    /**
     * ShowMapper constructor.
     * @param $movieRepository
     * @param $hallRepository
     */
    public function __construct(MovieRepository $movieRepository, HallRepository $hallRepository)
    {
        $this->movieRepository = $movieRepository;
        $this->hallRepository  = $hallRepository;
    }

    public function map(array $associative): Entity
    {
        $id = $associative[parent::FIELD_ID];
        $movieId = $associative[self::FIELD_MOVIE];
        $hallId = $associative[self::FIELD_HALL];

        //Time formatting
        $time = $associative['time'];
        $time = strtotime($time);
        $formattedTime = date("m/d/y g:i A", $time);

        //Foreign keys finding
        $movie = $this->movieRepository->getById($movieId);
        $hall = $this->hallRepository->getById($hallId);
        return new Show($id, $movie, $hall, $formattedTime);
    }

}