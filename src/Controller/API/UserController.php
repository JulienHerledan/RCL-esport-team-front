<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    /**
     * Create User
     * @Route("/api/users", name="app_api_user_create", methods={"POST"})
     */
    public function create(Request $request, SerializerInterface $serializer, ValidatorInterface $validator, UserRepository $userRepository): Response
    {
        // Je recupère le json dans la requete
        $json = $request->getContent();

        // Si on peut sérializer avec $this->json, il est possible également d'importer le serializer et de faire la démarche en sens inverse et transformer un json en objet
        // Pensez à composer require symfony/serializer-pack
        // !WARNING =  Serialize => transforme l'objet en json VS Deserializer => transforme des objets en json

        try{
            //si le code ne lance pas d'exception nous n'allons pas dans le catch (json valide)
            // on transfome le json en objet Movie
            $user = $serializer->deserialize($json, User::class, 'json');
        }catch(NotEncodableValueException $e){
            return $this->json(["erreur" => "json non valide"], Response::HTTP_BAD_REQUEST);
        
        }

        //j'utilise le composant validator pour verifier si les champs sont bien remplis
        $errors = $validator->validate($user);

        // Je boucle sur le tableau d'erreur
        // cette condition correspond à si il y a une erreur
        if(count($errors) > 0){
            // Je créer un tableau avec mes erreurs
            $errorsArray = [];
            foreach($errors as $error){
                // A l'index qui correspond au champs mal remplis, j'y injecte le/les messages d'erreurs
                $errorsArray[$error->getPropertyPath()][] = $error->getMessage();
            }
            return $this->json($errorsArray,Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        $userRepository->add($user,true);

        // Renvoi un json avec en premier argument les données et en deuxième un status code
        return $this->json($user,Response::HTTP_CREATED);
    }
}
