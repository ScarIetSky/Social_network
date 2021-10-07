<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 */
class LogoutController extends BaseController
{
    public function __invoke(Request $httpRequest): Response
    {
        $httpRequest->getSession()->invalidate();

        return $this->redirect('login');
    }
}
