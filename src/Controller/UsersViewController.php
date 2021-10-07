<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\User\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Users view controller.
 */
class UsersViewController extends BaseController
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
        $userInfo = $this->prepareUserInfo($httpRequest->get('id'));

        return $this->render('index.html.twig', ['error' => null, 'userInfo' => $userInfo]);
    }

    private function prepareUserInfo(string $id): array
    {
        $user = $this->userRepository->findOneById($id);
        $friends = [];

        foreach ($user->getFriends() as $friendId) {
            $friend = $this->userRepository->findOneById($friendId);
            $friends[$friendId] = [
                'login' => $friend->getLogin(),
                'interests' => $friend->getInterests(),
                'sex' => $friend->getSex(),
                'age' => $friend->getAge(),
            ];
        }

        return [
            'id' => $user->getId(),
            'login' => $user->getLogin(),
            'interests' => $user->getInterests(),
            'sex' => $user->getSex(),
            'age' => $user->getAge(),
            'friends' => $friends
        ];
    }
}
