<?php

namespace App\Views;

use Exception;

/**
 * implement view system
 */
class View
{
    /**
     * return a view file
     *
     * @param  string  $view
     * @param  array  $data
     */
    public static function render($view, $data = [])
    {
        extract($data);

        $viewPath = rootPath('app/Templates/'.$view.'.php');

        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            throw new Exception("O arquivo da página '{$viewPath}' não pode ser encontrado.");
        }
    }

    /**
     * inject on view a partial file
     *
     * @param  string  $partial
     * @param  array  $data
     */
    public static function inject($partial, $data = [])
    {
        extract($data);

        $partialPath = rootPath('app/Templates/partials/'.$partial.'.php');

        if (file_exists($partialPath)) {
            require $partialPath;
        } else {
            throw new Exception("Partials '{$partialPath}' não existe");
        }
    }
}
