<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\User\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Index controller.
 */
class IndexController extends BaseController
{
    /**
     * @param Request $httpRequest
     *
     * @return Response
     */
    public function __invoke(Request $httpRequest): Response
    {
        $user = $this->getCurrentUser();

        if ($user) {
            $this->redirectToRoute('usersView', ['id' => $user->getId()]);
        }


        return $this->redirectToRoute('login');
    }
}
