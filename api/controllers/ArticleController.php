<?php

class ArticleController
{
    public function index($sort = null)
    {
        $articles = Article::all($sort);

        echo json_encode($articles);
    }
}