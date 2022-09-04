<?php

declare(strict_types=1);

namespace Controllers;

class MainController extends AbstractController
{
    public function main()
    {
        $this->view->renderHtml('main/main.php');
    }
}