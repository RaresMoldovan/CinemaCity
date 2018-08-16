<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 13.08.2018
 * Time: 12:47
 */

namespace View;


use Helper\UrlHelper;
use Model\Domain\Collection\EntityCollection;

class MovieView extends View
{
    public function __construct(string $loggedUser, int $nrOfRecords, EntityCollection $movies, EntityCollection $genres)
    {
        ob_start();
        $urlHelper = new UrlHelper();
        require_once __DIR__ . '/templates/head.phtml';
        require_once __DIR__ . '/templates/movies.phtml';
        require_once __DIR__ . '/templates/footer.phtml';
        $this->renderingContent = ob_get_contents();
        ob_end_clean();

    }

}