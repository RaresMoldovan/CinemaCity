<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 10.08.2018
 * Time: 14:14
 */

namespace Router\Protocol;

use Helper\UrlHelper;


class Request implements RequestInterface
{
    private $type;
    private $uri;
    private $urlHelper;

    public function __construct()
    {
        $this->type      = $_SERVER['REQUEST_METHOD'];
        $this->uri       = strtok($_SERVER["REQUEST_URI"], '?');
        $this->urlHelper = new UrlHelper();
    }

    /**
     * @return mixed
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param $name
     * @return string
     */
    public function getPOSTParameter(string $name): string
    {
        return (isset($_POST[$name]) ? $_POST[$name] : '');
    }

    /**
     * @param string $name
     * @return string
     */
    public function getQueryParameter(string $name): string
    {
        return $this->urlHelper->getQueryParamValue($name);
    }

    /**
     * @return string
     */
    public function getReferer(): string
    {
        return (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
    }

    /**
     * @param string $path
     */
    public function redirect(string $path): void
    {
        header('Location: ' . $path);
    }

    /**
     * @return string
     */
    public function getLastUriParameter() : string
    {
        return $this->urlHelper->getLastParameterOfUri();
    }

    /**
     * @return string
     */
    public function getHost() : string
    {
        return $_SERVER['HTTP_HOST'];
    }
}