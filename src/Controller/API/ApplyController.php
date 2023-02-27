<?php

namespace App\Controller\API;

use App\Entity\Apply;
use App\Repository\ApplyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApplyController extends AbstractController
{
    /**
     * @Route("/api/apply", name="app_api_apply_create", methods={"POST"})
     */
    public function create(Request $request, SerializerInterface $serializer, ValidatorInterface $validator, ApplyRepository $applyRepository): Response
    {
        // Get json content from the request
        $json = $request->getContent();
        //dd($json);

        // Deserialize our object
        try {
        $apply = $serializer->deserialize($json, Apply::class, 'json');
        } catch (NotEncodableValueException $e) {
        return $this->json(["error" => "Json non valide"], Response::HTTP_BAD_REQUEST);
        }

        // Check errors in values
        $errors = $validator->validate($apply);

        if (count($errors) > 0) {
        $errorsArray = [];
        foreach ($errors as $error) {
            $errorsArray[$error->getPropertyPath()][] = $error->getMessage();
        }
        return $this->json($errorsArray, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Save object in database
        $applyRepository->add($apply, true);

        // Return the object created
        // Don't return the location because we don't need a route to get one apply
        return $this->json($apply, Response::HTTP_CREATED);
  }
}


