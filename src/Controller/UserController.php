<?php
/**
 * Created by PhpStorm.
 * User: rares
 * Date: 8/12/2018
 * Time: 3:39 PM
 */

namespace Controller;


use Model\DataAccess\Connection\DatabaseConnection;
use Model\DataAccess\Repository\UserRepository;
use Router\Protocol\Session;
use View\LogInView;
use Router\Protocol\Response;
use Router\Protocol\RequestInterface;
use View\NotFoundView;
use View\RegisterView;
use Model\Domain\Entity\User;

class UserController
{
    private $request;
    private $connection;
    private $session;

    /**
     * UserController constructor.
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
     * Maps to GET request at '/api/html/users/logIn'.
     * @return Response
     */
    public function getLogInPage(): Response
    {
        $logInView = new LogInView('');
        return new Response($logInView->getRenderingContent());
    }

    /**
     * @return Response
     */
    public function getRegisterPage(): Response
    {
        $registerView = new RegisterView('');
        return new Response($registerView->getRenderingContent());
    }

    /**
     * @return Response
     */
    public function handleLogIn(): Response
    {
        $userRepository = new UserRepository($this->connection->getPDO());
        $users          = $userRepository->findByColumn('email', $this->request->getPOSTParameter('user'));
        $logInView      = new LogInView('Username or password incorrect!');
        if (count($users) === 0) {
            return new Response($logInView->getRenderingContent());
        }
        if ($users->current()->getPassword() !== md5($this->request->getPOSTParameter('password'))) {
            return new Response($logInView->getRenderingContent());
        }
        $this->session->setSessionVariable('user', $users->current()->getEmail());
        $this->session->setSessionVariable('userId', $users->current()->getId());
        $redirectTo = $this->session->getSessionVariable('destination');
        $redirectTo = empty($redirectTo) ? 'http://cinema.local/movies' : $redirectTo;
        $this->request->redirect($redirectTo);
        return new Response('redirect');
    }

    /**
     * @return Response
     */
    public function handleRegister(): Response
    {
        $userRepository = new UserRepository($this->connection->getPDO());
        $registerView   = new RegisterView('Passwords do not match!');
        if ($this->request->getPOSTParameter('password') !== $this->request->getPOSTParameter('repeatPassword')) {
            return new Response($registerView->getRenderingContent());
        }
        $user = new User(1, $this->request->getPOSTParameter('user'), md5($this->request->getPOSTParameter('password')));
        $userRepository->insert($user);
        $this->session->setSessionVariable('user', $this->request->getPOSTParameter('user'));
        $this->session->setSessionVariable('userId', $userRepository->findByColumn('email', $this->request->getPOSTParameter('user'))->current()->getId());
        $redirectTo = $this->session->getSessionVariable('destination');
        $redirectTo = empty($redirectTo) ? 'http://' . $this->request->getHost() . '/movies' : $redirectTo;
        $this->request->redirect($redirectTo);
    }

    /**
     * @return Response
     */
    public function handleLogOut(): Response
    {
        $this->session->unsetSessionVariable('user');
        $this->session->unsetSessionVariable('userId');
        $this->request->redirect('http://' . $this->request->getHost() . '/movies');
    }

    /**
     * @return Response
     */
    public function handleNotFound(): Response
    {
        $notFoundView = new NotFoundView('The page you are looking for is either not available or you are not allowed to access it');
        return new Response($notFoundView->getRenderingContent());
    }


}