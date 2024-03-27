<?php

namespace App\Views;

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

        $viewPath = __DIR__.'/../Templates/'.$view.'.php';

        if (! file_exists($viewPath)) {
            d('View: '.$viewPath.' não encontrado.');
        }
        include $viewPath; // Inclui o arquivo da view
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

        $partialPath = __DIR__.'/../Templates/partials/'.$partial.'.php';

        if (! file_exists($partialPath)) {
            d("Partial: '{$partialPath}' não encontrado");
        }

        include $partialPath;
    }
}
