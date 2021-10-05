<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Main page controller.
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

        return $this->render('index.html.twig', ['error' => null, 'userName' => $user->getLogin()]);
    }
}
