<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 16.08.2018
 * Time: 18:16
 */

namespace View;


abstract class View
{
    protected $renderingContent;

    public function getRenderingContent()
    {
        return $this->renderingContent;
    }
}