<?php

namespace App\Controller;

use App\Model\ArticleManager;

class AjaxController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();

        header('Content-Type: application/json');
    }

    public function getArticles(): string
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->selectAll();

        return json_encode($articles);
    }

    public function getRandomArticle(): string
    {
        //TODO1
        $articleManager = new ArticleManager();
        $randomArticle = $articleManager->selectRandomOne();

        return json_encode($randomArticle);
    }

    public function searchArticles(string $search): string
    {
        //TODO2
        $articleManager = new ArticleManager();
        $searchResults = $articleManager->searchByTitle($search);

        return json_encode($searchResults);
    }

    public function getArticleById(int $id): string
    {
        //TODO3
        $articleManager = new ArticleManager();
        $article = $articleManager->selectOneById($id);

        return json_encode($article);
    }
}
