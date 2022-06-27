<?php

namespace App\Controller;

use App\Entity\User;
use App\Models\JsonError;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiUserController extends AbstractController
{
    /**
     * @Route("/api/user", name="api_user", methods={"GET"})
     */
    public function listUser(UserRepository $userRepository): Response
    {
        // dd($userRepository);
        return $this->json(
            $userRepository->findAll(),
            200,
            [],
            ['groups'=> ['list_user']]
        );
    }

    /**
     * @Route("/api/user/{id}", name="api_user_id", methods={"GET"})
     */
    public function showUser(User $user = null)
    {
        // dump($user);
        if ($user === null){
            $error = new JsonError(Response::HTTP_NOT_FOUND, User::class . ' non trouvé');
            return $this->json($error, $error->getError());
        }

        return $this->json(
            $user,
            Response::HTTP_OK,
            [],
            ['groups' => 'show_user']
        );
    }

    /**
     * @Route("/api/user/slug/{slug_user}", name="api_user_slug", methods={"GET"})
     */
    public function showUserBySlug(User $user = null)
    {

        // dump($user);
        if ($user === null){
            $error = new JsonError(Response::HTTP_NOT_FOUND, User::class . ' non trouvé');
            return $this->json($error, $error->getError());
        }

        
        return $this->json(
            $user,
            Response::HTTP_OK,
            [],
            ['groups' => 'show_user']
        );
    }

    /**
     * @Route("/api/secure/user/create", name="api_user_create", methods={"POST"})
     */
    public function createUser(EntityManagerInterface $entityManager, Request $request, ValidatorInterface $validator, UserPasswordHasherInterface $hasher)
    {       
        $data = $request->getContent();
        $dataDecoded = json_decode($data);
        // dd($request);
        $newUser = new User;

        $newUser->setNameUser($dataDecoded->name_user);
        $newUser->setEmail($dataDecoded->email);
        $newUser->setPassword($dataDecoded->password);

        $password = $newUser->getPassword();
        $passHasher = $hasher->hashPassword($newUser, $password);
        $newUser->setPassword($passHasher);

        // En une ligne
        // $newUser->setPassword($hasher->hashPassword($newUser, $newUser->getPassword()));
        
        $errors = $validator->validate($newUser);
        if (count($errors) > 0) {

            $myJsonError = new JsonError(Response::HTTP_UNPROCESSABLE_ENTITY, "Des erreurs de validation ont été trouvées");
            $myJsonError->setValidationErrors($errors);
    
            return $this->json($myJsonError, $myJsonError->getError());
        }

        $newUser->setCertificationUser(false);
        $newUser->setStatusUser(1);
        $newUser->setRoles(["ROLE_USER"]);
        $newUser->setCreatedAtUser(new DateTimeImmutable('now'));

        $entityManager->persist($newUser);
        $entityManager->flush();

        return $this->json(
            [],
            Response::HTTP_CREATED,
            [],
            ['groups' => ['show_user']]
        );
    }
}
