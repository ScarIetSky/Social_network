<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\User\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Adds friends.
 */
class AddFriendController extends BaseController
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
        $usersId = $this->getCurrentUser()->getId();
        $friendsId = $httpRequest->get('usersId');

        if ($usersId === $friendsId) {
            throw new \LogicException('Cant make a friend with yourself.');
        }

        $user = $this->userRepository->findOneById($usersId);
        $user->addFriend($friendsId);

        $this->userRepository->update($user);

        return $this->redirectToRoute('usersView', ['id' => $friendsId]);
    }
}
