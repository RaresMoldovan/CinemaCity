<?php
/**
 * Created by PhpStorm.
 * User: rares
 * Date: 8/12/2018
 * Time: 5:03 PM
 */

namespace View;


class LogInView extends View
{
    public function __construct(string $error)
    {
        ob_start();
        require_once __DIR__ . '/templates/head.phtml';
        require_once __DIR__ . '/templates/logIn.phtml';
        $this->renderingContent = ob_get_contents();
        ob_end_clean();

    }
}