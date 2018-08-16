<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 13.08.2018
 * Time: 12:00
 */

namespace Controller;


use Model\DataAccess\Connection\DatabaseConnection;
use Model\DataAccess\Repository\GenreRepository;
use Model\DataAccess\Repository\HallRepository;
use Model\DataAccess\Repository\MovieRepository;
use Model\DataAccess\Repository\ShowRepository;
use Router\Protocol\Request;
use Router\Protocol\Response;
use Router\Protocol\Session;
use View\MovieView;
use View\ParticularMovieView;

class MovieController
{
    private $request;
    private $connection;
    private $session;

    /**
     * MovieController constructor.
     * @param Request $request
     * @param DatabaseConnection $connection
     * @param Session $session
     */
    public function __construct(Request $request, DatabaseConnection $connection, Session $session)
    {
        $this->session    = $session;
        $this->request    = $request;
        $this->connection = $connection;
    }

    /**
     * @return Response
     */
    public function getHomePage(): Response
    {
        $this->request->redirect('http://' . $this->request->getHost() . '/movies');
        return new Response('redirect');
    }

    /**
     * @return Response
     */
    public function getMoviesPage(): Response
    {
        $this->session->setSessionVariable('destination', $this->request->getURI());
        //Move them in constructor?
        $genreRepository     = new GenreRepository($this->connection->getPDO());
        $movieRepository     = new MovieRepository($this->connection->getPDO(), $genreRepository);
        $genres              = $genreRepository->getAll();
        $totalCountAndMovies = $movieRepository->getFilteredMovies(
            $this->request->getQueryParameter('page'),
            $this->request->getQueryParameter('genre'),
            $this->request->getQueryParameter('year'),
            $this->request->getQueryParameter('date'),
            $this->request->getQueryParameter('sort')
        );

        $movieView = new MovieView($this->session->getSessionVariable('user'), $totalCountAndMovies[0], $totalCountAndMovies[1], $genres);
        return new Response($movieView->getRenderingContent());
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function getMoviePage(): Response
    {
        $this->session->setSessionVariable('destination', $this->request->getURI());
        $genreRepository = new GenreRepository($this->connection->getPDO());
        $movieRepository = new MovieRepository($this->connection->getPDO(), $genreRepository);
        $hallRepository  = new HallRepository($this->connection->getPDO());
        $showRepository  = new ShowRepository($this->connection->getPDO(), $movieRepository, $hallRepository);
        $movie           = $movieRepository->getById((int)$this->request->getLastUriParameter());
        if($movie===null) {
            throw new \Exception('Movie id not found!');
        }
        //$shows = $showRepository->findByColumn('movie_id', (int)$this->request->getLastUriParameter());
        $shows     = $showRepository->getAllUpcomingShowsForMovie((int)$this->request->getLastUriParameter());
        $genres    = $genreRepository->getGenresForMovie((int)$this->request->getLastUriParameter());
        $movieView = new ParticularMovieView($this->session->getSessionVariable('user'), $movie, $shows, $genres);
        return new Response($movieView->getRenderingContent());
    }
}