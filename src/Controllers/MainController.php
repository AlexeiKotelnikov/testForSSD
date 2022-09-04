<?php

declare(strict_types=1);

namespace Controllers;

use Services\DB;
use View\View;

class MainController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../templates');
    }

    public function main(): void
    {
        $this->view->renderHtml('main/main.php');
    }
}