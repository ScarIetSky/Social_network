<?php

declare(strict_types=1);

namespace App\Controller;

use App\Persistency\Repository\TestRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 */
class RunController
{
    private TestRepository $testRepository;

    /**
     * @param TestRepository $testRepository
     */
    public function __construct(TestRepository $testRepository)
    {
        $this->testRepository = $testRepository;
    }


    public function __invoke(Request $httpRequest): Response
    {
        $this->testRepository->add();

        return new Response();
    }
}
