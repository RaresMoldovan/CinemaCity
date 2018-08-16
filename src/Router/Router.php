<?php
/**
 * Created by PhpStorm.
 * User: rares
 * Date: 8/12/2018
 * Time: 3:27 PM
 */

namespace Router;

use Controller\UserController;
use Model\DataAccess\Connection\DatabaseConnection;
use Router\Protocol\Request;
use Router\Protocol\Response;
use Router\Protocol\Session;

class Router
{
    private $request;
    private $connection;
    private $session;

    /**
     * Router constructor.
     */
    public function __construct(DatabaseConnection $connection)
    {
        $this->request    = new Request();
        $this->session    = new Session();
        $this->connection = $connection;
    }

    /**
     * Standard URI must begin with (api/html|json|xml). The function assumes that if the api part is not provided
     * the user asks for html so it fills the missing part with 'api/html'.
     * @param string $uri
     * @return string
     */
    private function completeURI(string $uri): string
    {
        if (strcmp(substr($uri, 1, 3), 'api') !== 0) {
            return '/api/html' . $uri;
        }
        return $uri;
    }

    public function getURI(): string
    {
        return $this->request->getUri();
    }

    /**
     * Function dynamically calls a class constructor and its method by making use of the configuration file which
     * maps for all URIs the class and the method which server the request.
     * @return string
     */
    public function route(): Response
    {
        //Require the configuration map
        $requestMap = require_once 'config.php';

        //Save the request details from the configuration map
        $completedURI   = $this->request->getUri();
        $requestDetails = $this->getRequestDetails($completedURI, $requestMap);

        if (empty($requestDetails)) {
            $requestDetails[0] = 'Controller\UserController';
            $requestDetails[1] = 'handleNotFound';
        }
        //Create an instance of the controller
        $className   = $requestDetails[0];
        $classMethod = $requestDetails[1];
        $controller  = new $className($this->request, $this->connection, $this->session);
        try {
            $response = $controller->{$classMethod}();
        } catch (\Exception $exception) {
            $controller = new UserController($this->request, $this->connection, $this->session);
            $response   = $controller->handleNotFound();
        } finally {
            return $response;
        }
    }

    /**
     * Searches in the request map a pattern which matches the required URI.
     * @param string $uri
     * @param array $requestMap
     * @return array
     */
    private function getRequestDetails(string $uri, array $requestMap): array
    {
        if (isset($requestMap[serialize([$uri, $this->request->getType()])])) {
            return $requestMap[serialize([$uri, $this->request->getType()])];
        }
        foreach ($requestMap as $routeAndMethod => $controllerAndMethod) {
            if (preg_match('/^' . str_replace('/', '\/', unserialize($routeAndMethod)[0]) . '$/', $uri) == 1 && $this->request->getType() === unserialize($routeAndMethod)[1]) {
                return $controllerAndMethod;
            }
        }
        return [];
    }


}