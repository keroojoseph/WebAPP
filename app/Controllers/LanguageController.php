<?php

namespace App\Controllers;

use App\Libs\Helper;

class LanguageController extends AbstractController
{
    use Helper;

    public function defaultAction()
    {
        if ($_SESSION['lang'] == 'en') {
            $_SESSION['lang'] = 'ar';
        } else {
            $_SESSION['lang'] = 'en';
        }
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}