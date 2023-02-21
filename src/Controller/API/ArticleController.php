<?php

namespace App\Controller\API;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
  /**
   * @Route("/api/articles", name="app_api_article_list")
   */
  public function getAll(ArticleRepository $articleRepository): JsonResponse
  {
    return $this->json($articleRepository->findAll(), Response::HTTP_OK, [], ["groups" => "article"]);
  }
}
