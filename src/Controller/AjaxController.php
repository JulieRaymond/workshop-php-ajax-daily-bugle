<?php

namespace App\Controller;

use App\Model\ArticleManager;

class AjaxController extends AbstractController
{

    public function jsonArticles(): string
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles();

        return json_encode($articles);
    }

    public function randomJsonArticle(): string
    {
        //TODO
        return "";
    }

    public function searchJsonArticles(string $search): string
    {
        //TODO
        return $search;
    }

    public function getJsonArticleById(int $id): string
    {
        //TODO
        return "$id";
    }
}
