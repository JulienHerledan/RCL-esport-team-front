<?php

namespace App\Controller\API;

use App\Repository\MatcheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatcheController extends AbstractController
{
    /**
     * @Route("/api/matches", name="app_api_matches_getAll", methods="GET")
     */
    public function getAll(MatcheRepository $mr): JsonResponse
    {
        // i get all the matches with MovieRepository
        $matches = $mr->findAll();

        // return a json response with $matches
        return $this->json($matches, Response::HTTP_OK,[], ["groups" => "matches"]);
    }
}
