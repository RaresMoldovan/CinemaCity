<?php
/**
 * Created by PhpStorm.
 * User: rares
 * Date: 8/12/2018
 * Time: 5:20 PM
 */

namespace View;


class RegisterView extends View
{
    public function __construct(string $error)
    {
        ob_start();
        require_once __DIR__ . '/templates/head.phtml';
        require_once __DIR__ . '/templates/register.phtml';
        $this->renderingContent = ob_get_contents();
        ob_end_clean();
    }

}