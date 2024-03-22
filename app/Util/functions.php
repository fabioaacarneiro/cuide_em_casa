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
function requestUri(): string
{
    $uri = $_SERVER['REQUEST_URI'];
    if (isset($uri)) {
        return $uri;
    }

    return '';
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
function rootPath(?string $path = null): string
{
    $documentRoot = $_SERVER['DOCUMENT_ROOT'];
    $projectName = projectName();
    $pathOfProject = $documentRoot.'/'.$projectName;
    $completePath = '';

    if (! is_null($path)) {
        $completePath = $pathOfProject.'/'.$path;

        return $completePath;
    }

    return $pathOfProject;
}

/**
 * return desired file on assest folder
 *
 * @param string? $path name of desired file
 * @return string complete path of desired file
 */
function assets(?string $path = null): string
{
    $completePath = '';
    $rootPath = rootPath();
    if (! is_null($path)) {
        $completePath = $rootPath.'/'.$path;

        return $path;
    } else {
        exit('Error: assets() aguarda uma string como parametro, recebido: '.gettype($path));
    }

    if (! file_exists($completePath)) {
        exit('Error: Arquivo inexistente ou nome inválido: '.$completePath);
    }

    return $completePath;
}
