<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Main page controller.
 */
class IndexController extends AbstractController
{
    /**
     * @param Request $httpRequest
     *
     * @return Response
     */
    public function __invoke(Request $httpRequest): Response
    {
        return $this->render('security/login.html.twig', ['error' => null, 'lastName' => 'test']);
    }
}
