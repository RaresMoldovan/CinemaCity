<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 16.08.2018
 * Time: 16:59
 */

namespace View;


class NotFoundView extends View
{
    public function __construct(string $message)
    {
        ob_start();
        require_once __DIR__ . '/templates/head.phtml';
        require_once __DIR__ . '/templates/notFound.phtml';
        $this->renderingContent = ob_get_contents();
        ob_end_clean();

    }

}