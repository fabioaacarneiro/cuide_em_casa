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
    $method = '';
    if (isset($_SERVER['REQUEST_METHOD'])) {
        $method = $_SERVER['REQUEST_METHOD'];
    }

    return $method;
}

/**
 * return a project name
 *
 * @return string nameOfProject
 */
function projectName(): string
{
    return 'Cuide em Casa';
}

/**
 * @param string? $path path of included in return
 * @return string complete path
 */
function rootPath(?string $path = ''): string
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];

    return $protocol.'://'.$host.$path;
}

/**
 * return desired file on assest folder
 *
 * @param string? $path name of desired file
 */
function assets(?string $path = null)
{
    echo rootPath('/assets/'.$path);
}
