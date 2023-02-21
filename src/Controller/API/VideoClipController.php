<?php

namespace App\Controller\API;

use App\Repository\VideoClipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoClipController extends AbstractController
{
    /**
     * @Route("/api/video-clip", name="app_api_video_clip_getAll", methods={"GET"})
     */
    public function getAll(VideoClipRepository $videoClipRepository): JsonResponse
    {
        $videos = $videoClipRepository->findAll();
        return $this->json($videos, Response::HTTP_OK);
    }


}

