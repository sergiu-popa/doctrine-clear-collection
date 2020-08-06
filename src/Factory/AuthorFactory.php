<?php

namespace App\Factory;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Author|Proxy findOrCreate(array $attributes)
 * @method static Author|Proxy random()
 * @method static Author[]|Proxy[] randomSet(int $number)
 * @method static Author[]|Proxy[] randomRange(int $min, int $max)
 * @method static AuthorRepository|RepositoryProxy repository()
 * @method Author|Proxy create($attributes = [])
 * @method Author[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class AuthorFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://github.com/zenstruck/foundry#model-factories)
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->beforeInstantiate(function(Author $author) {})
        ;
    }

    protected static function getClass(): string
    {
        return Author::class;
    }
}
