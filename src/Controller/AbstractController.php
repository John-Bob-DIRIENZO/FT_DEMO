<?php

namespace App\Controller;

abstract class AbstractController
{
    protected function render(string $template, string $title, array $params): void
    {
        $templatePath = dirname(__DIR__, 2) . "/templates/template.php";
        $viewPath = dirname(__DIR__, 2) . "/templates/" . $template;

        foreach ($params as $key => $val) {
            $$key = $val;
        }

        ob_start();
        require_once $viewPath;
        $content = ob_get_clean();

        require_once $templatePath;
        exit;
    }
}
