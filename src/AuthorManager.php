<?php

namespace App;

use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;

class AuthorManager
{
    /** @var AuthorRepository */
    private $repository;

    public function __construct(AuthorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAuthors(): array
    {
        $viewsByDay = [];

        $dates = [
            new \DateTime('yesterday'),
            new \DateTime()
        ];

        foreach($dates as $date) {
            $viewsByDay[$date->format('Y-m-d')] = $this->repository->findByDay($date);

            //$this->repository->clear(); // TODO uncomment
        }

        return $viewsByDay;
    }
}
