<?php

namespace app\controllers;

class ProjectController extends Controller
{
    public function index()
    {
        $this->render('projects', [
            'title_key' => 'nav_projects',
            'active_page' => 'projects'
        ]);
    }
}
