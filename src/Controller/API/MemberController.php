<?php

namespace App\Controller\API;

use App\Repository\ArticleRepository;
use App\Repository\CompetitionRepository;
use App\Repository\GameRepository;
use App\Repository\MemberRepository;
use App\Repository\SocialNetworkRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController
{
    /**
     * @Route("/api/members", name="app_api_members_getAll", methods={"GET"})
     */
    public function getAll(MemberRepository $memberRepository): JsonResponse
    {  
        return $this->json($memberRepository->findAll(), Response::HTTP_OK,[], ["groups" => "members"]);
    }
}
