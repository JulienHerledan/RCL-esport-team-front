<?php

namespace App\Controller\API;

use App\Repository\MemberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController
{
    /**
     * @Route("/api/member", name="app_api_member_getAll", methods="GET")
     */
    public function getAll(MemberRepository $memberRepository): JsonResponse
    {

        return $this->json($memberRepository->findAll(), Response::HTTP_OK,[], ["groups" => "member"]);
    }
}
