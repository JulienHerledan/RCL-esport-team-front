<?php

namespace App\Controller\API;

use App\Entity\Comment;
use App\Repository\CommentRepository;
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
   */
  public function create(Request $request, SerializerInterface $serializer, ValidatorInterface $validator, CommentRepository $commentRepository): Response
  {

    // Je recupère le json dans la requete
    $json = $request->getContent();

    // Si on peut sérializer avec $this->json, il est possible également d'importer le serializer et de faire la démarche en sens inverse et transformer un json en objet
    // Pensez à composer require symfony/serializer-pack
    try {
      // si le code ne lance pas d'expection nous n'allons pas dans le catch (json valide)
      $comment = $serializer->deserialize($json, Comment::class, 'json');

    } catch (NotEncodableValueException $e) {

      return $this->json(["error" => "Json non valide"], Response::HTTP_BAD_REQUEST);
    }


    // J'utilise le composant validator pour vérifier si les champs sont bien remplis
    // Si l'objet est incomplet, j'aurai une erreur sql en faisant le add
    $errors = $validator->validate($comment);

    // Je boucle sur le tableau d'erreur
    // cette condition correspond à si il y a une erreur
    if (count($errors) > 0) {
      // Je créer un tableau avec mes erreurs
      $errorsArray = [];
      foreach ($errors as $error) {
        // A l'index qui correspond au champs mal remplis, j'y injecte le/les messages d'erreurs
        $errorsArray[$error->getPropertyPath()][] = $error->getMessage();
      }
      return $this->json($errorsArray, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    $commentRepository->add($comment, true);

    // Renvoi un json avec en premier argument les données et en deuxième un status code
    return $this->json($comment, Response::HTTP_CREATED, [], ["groups" => "comments"]);
  }
}


