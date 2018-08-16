<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 15.08.2018
 * Time: 20:03
 */

namespace View;


use Model\Domain\Collection\EntityCollection;
use Model\Domain\Entity\Show;

use Helper\UrlHelper;

class ShowView extends View
{
    public function __construct(string $loggedUser, Show $show, EntityCollection $genres, EntityCollection $seats)
    {
        ob_start();
        $urlHelper = new UrlHelper();
        require_once __DIR__ . '/templates/head.phtml';
        require_once __DIR__ . '/templates/show.phtml';
        require_once __DIR__ . '/templates/footer.phtml';
        $this->renderingContent = ob_get_contents();
        ob_end_clean();
    }

}