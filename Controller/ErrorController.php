<?php
namespace Controller;


use View\View;

class ErrorController {
    public function notFoundAction($url) {
        echo (new View('error', '404'))->create(['url' => $url]);
    }
}