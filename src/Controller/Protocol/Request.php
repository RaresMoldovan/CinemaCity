<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 10.08.2018
 * Time: 14:14
 */

class Request
{
    private $type;
    private $url;

    public function __construct()
    {
        $type = $_SERVER['REQUEST-METHOD'];
        $url = $_SERVER['REQUEST_URI'];
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getPOSTParameter(string $name) : string
    {
        return (isset($_POST[$name]) ? $_POST[$name] : '';
    }

    public function getQueryParameter(string $name) : string
    {
        return (isset($_GET[$name]) ? $_GET[$name] : '');
    }

}