<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return User::class;
    }

    // buscar usuario por email 
    public function findOneByEmailOrFail(string $email): User
    {
        // objectRepository que se extiende de baseRepository 
        if (null === $user = $this->objectRepository->findOneBy(['email' => $email])) {
            throw new NotFoundHttpException(\sprintf('User %s not found', $email));
        }

        return $user;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    // guardar usuario, haciendo uso de saveEntity en BaseRepository
    public function save(User $user): void
    {
        $this->saveEntity($user);
    }
}