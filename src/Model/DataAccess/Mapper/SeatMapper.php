<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 06.08.2018
 * Time: 18:49
 */

namespace Model\DataAccess\Mapper;

use Model\Domain\Entity\Entity;
use Model\Domain\Entity\Seat;
use Model\DataAccess\Repository\HallRepository;

class SeatMapper extends EntityMapper
{
    const FIELD_CODE = 'code';
    const FIELD_HALL = 'hall_id';

    private $hallRepository;

    public function __construct(HallRepository $hallRepository)
    {
        $this->hallRepository = $hallRepository;
    }

    public function map(array $associative): Entity
    {
        $id     = $associative[parent::FIELD_ID];
        $code   = $associative[self::FIELD_CODE];
        $hallId = $associative[self::FIELD_HALL];
        $hall   = $this->hallRepository->getById($hallId);
        return new Seat($id, $hall, $code);
    }

}