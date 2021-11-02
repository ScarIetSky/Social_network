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
class SearchController extends BaseController
{
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    // ./wrk -t12 -c100 -d10s http://127.0.0.1:8000/search?user=emma
    public function __invoke(Request $httpRequest): Response
    {
        $searchQuery = $httpRequest->getQueryString();
        parse_str($searchQuery, $searchQuery);
        $searchQuery = explode(' ', $searchQuery['user'], 2);
        $user = $this->getCurrentUser();

        $userInfo = [
            'id' => $user->getId(),
            'login' => $user->getLogin(),
            'interests' => $user->getInterests(),
            'sex' => $user->getSex(),
            'age' => $user->getAge(),
        ];

        $users = $this->userRepository->findAll($searchQuery[0] ?? null, $searchQuery[1] ?? null);

        return $this->render('people.html.twig', ['error' => null, 'userInfo' => $userInfo, 'users' => $users]);
    }
}
