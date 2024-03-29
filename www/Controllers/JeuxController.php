<?php

namespace App\Controllers;

use App\Core\View;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Content;
use App\Models\Game_Category;
use App\Models\Game;

use App\Models\JoinTable\Comment_article;
use App\Models\JoinTable\Game_Article;
use App\Models\JoinTable\Game_Content;

use App\Repository\AbstractRepository;
use App\Repository\ArticleRepository;
use App\Repository\CommentArticleRepository;
use App\Repository\CommentRepository;
use App\Repository\ContentRepository;
use App\Repository\GameArticleRepository;
use App\Repository\GameCategoryRepository;
use App\Repository\GameContentRepository;
use App\Repository\GameRepository;

class JeuxController extends AbstractRepository
{
    private ArticleRepository $articleRepository;
    private GameCategoryRepository $gameCategoryRepository;
    private GameArticleRepository $gameArticleRepository;
    private GameRepository $gameRepository;
    private CommentArticleRepository $commentArticleRepository;
    private CommentRepository $commentRepository;
    private GameContentRepository $gameContentRepository;
    private ContentRepository $contentRepository;

    public function __construct() {
        $this->articleRepository = new ArticleRepository();
        $this->gameCategoryRepository = new GameCategoryRepository();
        $this->gameArticleRepository = new GameArticleRepository();
        $this->gameRepository = new GameRepository();
        $this->commentArticleRepository = new CommentArticleRepository();
        $this->commentRepository = new CommentRepository();
        $this->gameContentRepository = new GameContentRepository();
        $this->contentRepository = new ContentRepository();
    }
    public function allgames(){
        $view = new View("Jeux/allGames", "front");
        $jeux = $this->gameRepository->selectAll(new Game);
        $categories = $this->gameCategoryRepository->selectAll(new Game_Category());

        $result = [];
        foreach ($jeux as $index => $value) {
            foreach ($categories as $categorie) {
                if ($value->getCategory_id() == $categorie->getId()) {
                    $result[] = ["title" => $value->getTitle(), "id" => $value->getId(), "categorie" => $categorie->getCategoryName()];
                }
            }
        }

        $view->assign("jeux", $result);
    }

    public function oneGame()
    {
        if(empty($_GET) || $_SERVER['REQUEST_METHOD'] != "GET") {
            Errors::define(400, 'Bad HTTP request');
            echo json_encode("Bad Method");
            exit;
        }

        $view = new View("Jeux/oneGame", "front");
        $jeuxModel = $this->gameRepository;
        $categorieJeuxModel = $this->gameCategoryRepository;
        $commentModel = $this->commentRepository;
        $articleJeuModel = $this->gameArticleRepository;
        $commentArticleModel = $this->commentArticleRepository;
        $articleModel = $this->articleRepository;
        $gameContentModel = $this->gameContentRepository;
        $contentModel = $this->contentRepository;

        $whereSql = ["id" => $_GET["id"]];
        $jeu = $jeuxModel->getOneWhere($whereSql, new Game());

        $whereSql = ["jeux_id" => $jeu->getId()];
        $jeuContent = $gameContentModel->getOneWhere($whereSql, new Game_Content());

        if ($jeuContent) {
            $whereSql = ["id" => $jeuContent->getContentId()];
            $content = $contentModel->getOneWhere($whereSql, new Content());

            $url = $content->getPathContent();
            $url = implode("/", array_slice(explode("/", $url), 5));
            $view->assign("imageUrl", $url);
        }

        $whereSql = ["id" => $jeu->getCategory_id()];
        $categorie = $categorieJeuxModel->getOneWhere($whereSql, new Game_Category());

        $view->assign("jeu", $jeu);
        $view->assign("categorie", $categorie);

        $whereSql = ["jeux_id" => $jeu->getId()];
        $articlesJeu = $articleJeuModel->getAllWhere($whereSql, new Game_Article());

        if ($articlesJeu) {
            $articles = [];
            $commentsByArticles = [];
            foreach ($articlesJeu as $articleJeu){
                $whereSql = ["id" => $articleJeu->getArticleId()];
                $article = $articleModel->getOneWhere($whereSql, new Article());
                $articles[] = $article;

                $whereSql = ["article_id" => $articleJeu->getArticleId()];
                $commentArticle = $commentArticleModel->getOneWhere($whereSql, new Comment_article());

                if ($commentArticle) {
                    $whereSql = ["id" => $commentArticle->getCommentId()];
                    $comments = $commentModel->getAllWhere($whereSql, new Comment());
                    $commentsByArticles[] = ["articleId" => $article->getId(), "comments" => $comments];
                }
            }
            $view->assign("articles", $articles);
            $view->assign("commentsByArticles", $commentsByArticles);
        }
    }
}