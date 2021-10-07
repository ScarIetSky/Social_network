<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\User\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * All users controller.
 */
class PeopleController extends BaseController
{
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $httpRequest
     *
     * @return Response
     */
    public function __invoke(Request $httpRequest): Response
    {
        $users = $this->prepareUserInfo();
        $user = $this->getCurrentUser();

        $userInfo = [
            'id' => $user->getId(),
            'login' => $user->getLogin(),
            'interests' => $user->getInterests(),
            'sex' => $user->getSex(),
            'age' => $user->getAge(),
        ];

        return $this->render('people.html.twig', ['error' => null, 'userInfo' => $userInfo, 'users' => $users]);
    }

    private function prepareUserInfo(): array
    {
        $users = $this->userRepository->findAll();

        $data = [];

        foreach ($users as $user) {
            $data[] = [
                'id' => $user->getId(),
                'login' => $user->getLogin(),
                'sex' => $user->getSex(),
            ];
        }
        return $data;
    }
}
