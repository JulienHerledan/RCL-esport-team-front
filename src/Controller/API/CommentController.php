<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Entity\Comment;
use App\Repository\CommentRepository;
use Faker\Guesser\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;


class CommentController extends AbstractController
{
  /**
   *
   * @Route("/api/comments", name="app_api_comment_create", methods={"POST"})
   * 
   */
   public function create(Request $request, SerializerInterface $serializer, ValidatorInterface $validator, CommentRepository $commentRepository): Response
  {
    // Get json content from the request
    $json = $request->getContent();
    
    
    // Deserialize our object
    try {
      $comment = $serializer->deserialize($json, Comment::class, 'json');
      $user = $this->getUser();
      $comment->setAuthor($user);
    } catch (NotEncodableValueException $e) {
      
      return $this->json(["error" => "Json non valide"], Response::HTTP_BAD_REQUEST);
    }
    
    // Check errors in values
    $errors = $validator->validate($comment);

    if (count($errors) > 0) {
      $errorsArray = [];
      foreach ($errors as $error) {
        $errorsArray[$error->getPropertyPath()][] = $error->getMessage();
      }
      return $this->json($errorsArray, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    // Save object in database
    $commentRepository->add($comment, true);
    
    // Return the object created
    // Don't return the location because we don't need a route to get one comment
    
    return $this->json($comment, Response::HTTP_CREATED, [], ["groups" => "comments"]);
    
    
  }
}


