<?php

namespace app\controllers;

class HomeController extends Controller
{
    public function index()
    {
        $this->render('home', [
            'title_key' => 'nav_home',
            'active_page' => 'home'
        ]);
    }
}
