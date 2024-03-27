<?php

/**
 * thats file contains the global functions thats
 * implements functionality of application and thats
 * functions can be called and used on all application
 */

/**
 * return uri requested
 *
 * @return string uri requested
 */
function requestUrl(): string
{
    $url = '';
    if (isset($_SERVER['REQUEST_URI'])) {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    return $url;
}

/**
 * return request method
 *
 * @return string request method
 */
function requestMethod(): string
{
    $method = $_SERVER['REQUEST_METHOD'];
    if (isset($method)) {
        return $method;
    }

    return '';
}

/**
 * return a project name
 *
 * @return string nameOfProject
 */
function projectName(): string
{
    return 'cuide_em_casa';
}

/**
 * @param string? $path path of included in return
 * @return string complete path
 */
function rootPath(?string $path = ''): string
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $base_url = $protocol.'://'.$host;

    return $base_url.$path;
}

/**
 * return desired file on assest folder
 *
 * @param string? $path name of desired file
 */
function assets(?string $path = null)
{
    $completePath = '';

    $assetsPath = __DIR__.'/../../public/assets/';

    if (file_exists($assetsPath.$path)) {
        $completePath = rootPath('/assets/'.$path);
    }

    echo $completePath;

}
