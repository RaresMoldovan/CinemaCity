<?php
/**
 * Created by PhpStorm.
 * User: rares
 * Date: 8/12/2018
 * Time: 4:37 PM
 */

namespace Router\Protocol;


interface RequestInterface
{
    public function getType() : string;
    public function getURI() : string;
    public function getPOSTParameter(string $name) : string;
    public function getQueryParameter(string $name) : string;
    public function redirect(string $path) : void;
    public function getLastUriParameter() : string;
    public function getHost() : string;
}