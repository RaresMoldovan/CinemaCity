<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 15.08.2018
 * Time: 18:37
 */


namespace Controller;

use Model\DataAccess\Repository\GenreRepository;
use Model\DataAccess\Repository\MovieRepository;
use Model\DataAccess\Repository\ReservationRepository;
use Model\DataAccess\Repository\SeatRepository;
use Model\DataAccess\Repository\ShowRepository;
use Model\DataAccess\Repository\UserRepository;
use Router\Protocol\RequestInterface;
use Router\Protocol\Response;
use Router\Protocol\Session;
use Model\DataAccess\Connection\DatabaseConnection;
use Model\DataAccess\Repository\HallRepository;

class ShowController
{
    private $session;
    private $request;
    private $connection;

    /**
     * ShowController constructor.
     * @param RequestInterface $request
     * @param DatabaseConnection $connection
     * @param Session $session
     */
    public function __construct(RequestInterface $request, DatabaseConnection $connection, Session $session)
    {
        $this->session    = $session;
        $this->request    = $request;
        $this->connection = $connection;
    }

    /**
     * @return Response
     */
    public function getNumberOfRemainingSeats()
    {
        $genreRepository       = new GenreRepository($this->connection->getPDO());
        $movieRepository       = new MovieRepository($this->connection->getPDO(), $genreRepository);
        $hallRepository        = new HallRepository($this->connection->getPDO());
        $showRepository        = new ShowRepository($this->connection->getPDO(), $movieRepository, $hallRepository);
        $userRepository        = new UserRepository($this->connection->getPDO());
        $seatRepository        = new SeatRepository($this->connection->getPDO(), $hallRepository);
        $reservationRepository = new ReservationRepository($this->connection->getPDO(), $hallRepository, $showRepository, $userRepository, $seatRepository);
        $showId                = $this->request->getLastUriParameter();
        $show                  = $showRepository->getById((int)$showId);
        return new Response((string)$reservationRepository->getRemainingNumberOfSeatsForShow($show));
    }
}