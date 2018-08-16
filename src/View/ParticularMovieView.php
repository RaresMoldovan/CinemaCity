<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 15.08.2018
 * Time: 16:03
 */

namespace View;

use Model\Domain\Entity\Movie;
use Model\Domain\Collection\EntityCollection;

use Helper\UrlHelper;

class ParticularMovieView extends View
{
    public function __construct(string $loggedUser, Movie $movie, EntityCollection $shows, EntityCollection $genres)
    {
        ob_start();
        $urlHelper = new UrlHelper();
        require_once __DIR__ . '/templates/head.phtml';
        require_once __DIR__ . '/templates/movie.phtml';
        require_once __DIR__ . '/templates/footer.phtml';
        $this->renderingContent = ob_get_contents();
        ob_end_clean();
    }

}