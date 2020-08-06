<?php

namespace App\Factory;

use App\Entity\BlogPost;
use App\Repository\BlogPostRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static BlogPost|Proxy findOrCreate(array $attributes)
 * @method static BlogPost|Proxy random()
 * @method static BlogPost[]|Proxy[] randomSet(int $number)
 * @method static BlogPost[]|Proxy[] randomRange(int $min, int $max)
 * @method static BlogPostRepository|RepositoryProxy repository()
 * @method BlogPost|Proxy create($attributes = [])
 * @method BlogPost[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class BlogPostFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'title' => self::faker()->sentence
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->beforeInstantiate(function(BlogPost $blogPost) {})
        ;
    }

    protected static function getClass(): string
    {
        return BlogPost::class;
    }
}
