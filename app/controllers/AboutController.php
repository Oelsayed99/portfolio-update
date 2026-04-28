<?php

namespace app\controllers;

class AboutController extends Controller
{
    public function index()
    {
        $this->render('about', [
            'title_key' => 'nav_about',
            'active_page' => 'about'
        ]);
    }
}
