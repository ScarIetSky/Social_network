<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\User\Factory\UserFactory;
use App\Domain\User\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 */
class RegisterController extends BaseController
{
    private UserRepository $userRepository;
    private UserFactory $userFactory;

    /**
     * @param UserRepository $userRepository
     * @param UserFactory    $userFactory
     */
    public function __construct(UserRepository $userRepository, UserFactory $userFactory)
    {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
    }


    public function __invoke(Request $httpRequest)
    {
        if ($httpRequest->getMethod() === Request::METHOD_POST) {
            $this->registerUser($httpRequest);
        }

        return $this->render('register.html.twig');
    }

    private function registerUser(Request $httpRequest)
    {
        $login = $httpRequest->get('login');
        $password = $httpRequest->get('password');

        $user = $this->userFactory->create($login, $password);
        $this->userRepository->add($user);
    }
}
