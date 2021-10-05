<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\User\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 *
 */
abstract class BaseController extends AbstractController
{
    protected function getCurrentUser(): User
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }
}
