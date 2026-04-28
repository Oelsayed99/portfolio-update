<?php

namespace app\controllers;

class BlogController extends Controller
{
    public function index()
    {
        $this->render('blog', [
            'title_key' => 'nav_blog',
            'active_page' => 'blog'
        ]);
    }
}
