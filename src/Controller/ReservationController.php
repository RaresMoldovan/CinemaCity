<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 15.08.2018
 * Time: 19:44
 */

namespace Controller;

use Helper\MailHelper;
use Model\DataAccess\Repository\GenreRepository;
use Model\DataAccess\Repository\MovieRepository;
use Model\DataAccess\Repository\ReservationRepository;
use Model\DataAccess\Repository\SeatRepository;
use Model\DataAccess\Repository\ShowRepository;
use Model\DataAccess\Repository\UserRepository;
use Model\DataAccess\Repository\HallRepository;
use Router\Protocol\RequestInterface;
use Router\Protocol\Response;
use Router\Protocol\Session;
use Model\DataAccess\Connection\DatabaseConnection;
use View\LogInView;
use View\ShowView;

class ReservationController
{
    private $request;
    private $connection;
    private $session;

    /**
     * ReservationController constructor.
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
     * @throws \Exception
     */
    public function getShowPage()
    {
        $this->session->setSessionVariable('destination', $this->request->getURI());
        if ($this->session->getSessionVariable('user') === '') {
            $this->request->redirect('http://' . $this->request->getHost() . '/users/logIn');
            $logInView = new LogInView('');
            return new Response($logInView->getRenderingContent());
        }
        $showId          = $this->request->getLastUriParameter();
        $genreRepository = new GenreRepository($this->connection->getPDO());
        $movieRepository = new MovieRepository($this->connection->getPDO(), $genreRepository);
        $hallRepository  = new HallRepository($this->connection->getPDO());
        $showRepository  = new ShowRepository($this->connection->getPDO(), $movieRepository, $hallRepository);
        $seatRepository  = new SeatRepository($this->connection->getPDO(), $hallRepository);
        $show            = $showRepository->getById((int)$showId);
        if($show==null) {
            throw new \Exception();
        }
        $seats           = $seatRepository->getRemainingSeatsForShow($show);
        $genres          = $genreRepository->getGenresForMovie($show->getMovie()->getId());
        $showView        = new ShowView($this->session->getSessionVariable('user'), $show, $genres, $seats);
        return new Response($showView->getRenderingContent());
    }

    /**
     * @return Response
     */
    public function book(): Response
    {
        $genreRepository       = new GenreRepository($this->connection->getPDO());
        $movieRepository       = new MovieRepository($this->connection->getPDO(), $genreRepository);
        $hallRepository        = new HallRepository($this->connection->getPDO());
        $showRepository        = new ShowRepository($this->connection->getPDO(), $movieRepository, $hallRepository);
        $seatRepository        = new SeatRepository($this->connection->getPDO(), $hallRepository);
        $userRepository        = new UserRepository($this->connection->getPDO());
        $reservationRepository = new ReservationRepository($this->connection->getPDO(), $hallRepository, $showRepository, $userRepository, $seatRepository);
        $mailHelper            = new MailHelper();
        $seatId                = $this->request->getPOSTParameter('seat');
        $showId                = $this->request->getLastUriParameter();
        $userId                = $this->session->getSessionVariable('userId');
        $reservationRepository->insertReservationWithIdNames($userId, $showId, $seatId);
        $show = $showRepository->getById($showId);

        $seat = $seatRepository->getById($seatId);

        $mailHelper->sendReservationMail($show->getMovie()->getName(), $show->getTime(), $seat->getCode(), $this->session->getSessionVariable('user'));

        $this->request->redirect('http://' . $this->request->getHost() . "/movies");
        return new Response('Redirected');
    }
}