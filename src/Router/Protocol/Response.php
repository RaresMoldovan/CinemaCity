<?php
/**
 * Created by PhpStorm.
 * User: rares
 * Date: 8/12/2018
 * Time: 3:24 PM
 */

namespace Router\Protocol;


class Response
{
    private $content;

    /**
     * Response constructor.
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent() : string
    {
        return $this->content;
    }

    /**
     * @return void
     */
    public function render() : void
    {
        echo $this->content;
    }
}