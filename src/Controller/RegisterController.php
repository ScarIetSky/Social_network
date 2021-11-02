<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\User\Factory\UserFactory;
use App\Domain\User\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 */
class RegisterController extends BaseController
{
    private UserFactory $userFactory;
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     * @param UserFactory    $userFactory
     */
    public function __construct(UserRepository $userRepository, UserFactory $userFactory)
    {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
    }


    public function __invoke(Request $httpRequest): Response
    {
        if ($httpRequest->getMethod() === Request::METHOD_POST) {
            $this->registerUser($httpRequest);

            return $this->redirectToRoute('login');
        }

        return $this->render('register.html.twig');
    }

    private function registerUser(Request $httpRequest): void
    {
        $login = $httpRequest->get('login');
        $password = $httpRequest->get('password');
        $name = $httpRequest->get('name');
        $surname = $httpRequest->get('surname');
        $age = (int) $httpRequest->get('age');
        $sex = $httpRequest->get('sex');
        $interests = $httpRequest->get('interests');

        $user = $this->userFactory->create(
            $login,
            $name,
            $surname,
            $password,
            $sex,
            $age,
            $interests
        );

        $this->userRepository->add($user);
    }
}
