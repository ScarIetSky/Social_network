<?php

declare(strict_types=1);

namespace App\Persistency\Repository;

use App\Domain\User\Entity\User;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ManagerRegistry;

/**
 *
 */
class TestRepository
{
    private const EXPECTED_TRANSACTIONS = 1000;

    private Connection $masterConnection;

    /**
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->masterConnection = $managerRegistry->getConnection('primary');
    }

    public function add(): void
    {
        $successfully = 0;
        for ($number = 0; $number <= self::EXPECTED_TRANSACTIONS; $number++) {
            try {
                $this->masterConnection->beginTransaction();

                $query = $this->masterConnection->prepare(
                    "INSERT INTO digits (number) VALUES (:number);"
                );
                $query->bindValue('number', $number);
                $query->execute();

                $this->masterConnection->commit();

                $successfully++;
            } catch (\Throwable $e) {
                break;
            }
        }

        echo "Recorded: $successfully out of " . self::EXPECTED_TRANSACTIONS;
    }
}
