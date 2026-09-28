<?php

namespace app\controllers;

class ServicesController extends Controller
{
    public function index()
    {
        $this->render('services', [
            'title_key' => 'nav_services',
            'active_page' => 'services'
        ]);
    }
}
