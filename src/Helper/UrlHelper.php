<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 14.08.2018
 * Time: 18:31
 */

namespace Helper;

class UrlHelper
{
    /**
     * @return mixed
     */
    public function getCurrentUrl(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @return mixed
     */
    public function getQueryParams(): array
    {
        $url = $this->getCurrentUrl();

        parse_str(parse_url($url, PHP_URL_QUERY), $query);

        return $query;
    }

    /**
     * @param array $params
     * @return string
     */
    public function addQueryParams(array $params): string
    {
        $url = $this->getCurrentUrl();

        parse_str(parse_url($url, PHP_URL_QUERY), $query);
        foreach ($params as $key => $value) {
            $query[$key] = $value;

        }
        $queryAsString = http_build_query($query);
        return strtok($url, '?') . '?' . $queryAsString;
    }

    /**
     * @param string $param
     * @return string
     */
    public function getQueryParamValue(string $param): string
    {
        return (isset($this->getQueryParams()[$param]) ? $this->getQueryParams()[$param] : '');
    }

    /**
     * @return string
     */
    public function getLastParameterOfUri(): string
    {
        $query = explode('/', parse_url($this->getCurrentUrl(), PHP_URL_PATH));
        return end($query);
    }

}