<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{

    private $passwordHasher;
    private $userRepository;

    public function __construct(UserPasswordHasherInterface  $passwordHasher, UserRepository $userRepository)
    {
        $this->passwordHasher = $passwordHasher;
        $this->userRepository = $userRepository;
    }

    /**
     * Check token
     * @Route("/api/users/check", name="app_api_user_check", methods={"GET"})
     */
    public function checkToken(): Response
    {
        return $this->json(["message" => "JWT Token still valid"], Response::HTTP_OK);
    }

    /**
     * Create User
     * @Route("/api/users", name="app_api_user_create", methods={"POST"})
     */
    public function create(Request $request, SerializerInterface $serializer, ValidatorInterface $validator): Response
    {
        // I getback the content of the request
        $json = $request->getContent();
        // dd($json);

        // deserialize the json
        try{
            //if the json is valide we don't go to the catch
            $user = $serializer->deserialize($json, User::class, 'json');

            // I set the user to an ActiveUser
            $user->setIsActive(1);
            // i  set up the date dateImmutable
            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setRoles(['ROLE_USER']);

            // dd($user);
            // I use the passwordHasher to hash my clean password
            $passwordHash = $this->passwordHasher->hashPassword($user, $user->getPassword());

            // I set the user's password with the passwordHash
            $user->setPassword($passwordHash);
            // dd($user);

        }catch(NotEncodableValueException $e){
            return $this->json(["erreur" => "json non valide"], Response::HTTP_BAD_REQUEST);
        }

        // I use validator composant to verify all the required
        $errors = $validator->validate($user);

        // Manage error
        if(count($errors) > 0){
            $errorsArray = [];
            foreach($errors as $error){
                $errorsArray[$error->getPropertyPath()][] = $error->getMessage();
            }
            return $this->json($errorsArray,Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        // ad user to the database
        $this->userRepository->add($user,true);


        return $this->json($user,Response::HTTP_CREATED,[],["groups" =>"users"]);
    }

    /**
     * getOne User
     * @Route("/api/users", name="app_api_user_getOne", methods={"GET"})
     */
    public function getOne(): Response
    {
        $user=$this->getUser();

        return $user ? 
        $this->json($user,Response::HTTP_OK,[],["groups" =>"users"]) : 
        $this->json(["erreur" => "Utilisateur inconnu"], Response::HTTP_NOT_FOUND);

    }

    /**
     * update an User
     * @Route("/api/users", name="app_api_user_update", methods={"PATCH"})
     */
    public function update(Request $request, SerializerInterface $serializer, ValidatorInterface $validator): Response
    {
        // I getback the content of the request
        $json = $request->getContent();


        // deserialize the json
        try{
            //if the json is valide we don't go to the catch
            $user = $serializer->deserialize($json, User::class, 'json');

            // I set the user to an ActiveUser
            $user->setIsActive(1);
            // i  set up the date dateImmutable
            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setRoles(['ROLE_USER']);

            // dd($user);
            // I use the passwordHasher to hash my clean password
            $passwordHash = $this->passwordHasher->hashPassword($user, $user->getPassword());

            // I set the user's password with the passwordHash
            $user->setPassword($passwordHash);
            // dd($user);

        }catch(NotEncodableValueException $e){
            return $this->json(["erreur" => "json non valide"], Response::HTTP_BAD_REQUEST);
        }

        // I use validator composant to verify all the required
        $errors = $validator->validate($user);

        // Manage error
        if(count($errors) > 0){
            $errorsArray = [];
            foreach($errors as $error){
                $errorsArray[$error->getPropertyPath()][] = $error->getMessage();
            }
            return $this->json($errorsArray,Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        // ad user to the database
        $this->userRepository->add($user,true);


        return $this->json($user,Response::HTTP_CREATED,[],["groups" =>"users"]);
    }
}