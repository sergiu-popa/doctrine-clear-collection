<?php

namespace App\Tests;

use App\AuthorManager;
use App\Factory\AuthorFactory;
use App\Factory\BlogPostFactory;
use App\Repository\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class AuthorManagerTest extends KernelTestCase
{
    use ResetDatabase, Factories;

    /** @var AuthorManager|object|null */
    private $manager;

    public function setUp()
    {
        self::bootKernel();

        $this->manager =  self::$container->get(AuthorManager::class);
    }

    /**
     * @test
     */
    public function test_views_by_date_foreach_author()
    {
        $author = AuthorFactory::new()->create(['name' => 'Sergio']);
        $yesterday = new \DateTime('yesterday');
        $today = new \DateTime();

        BlogPostFactory::new()->create([
            'author' => $author,
            'publishedAt' => $yesterday,
            'views' => 100
        ]);

        BlogPostFactory::new()->create([
            'author' => $author,
            'publishedAt' => $today,
            'views' => 200
        ]);

        $author->refresh();

        //self::$container->get('doctrine')->reset(); // TODO uncomment

        $viewsPerDay = $this->manager->getAuthors();
        $yesterdayViews = $viewsPerDay[$yesterday->format('Y-m-d')];
        $todayViews = $viewsPerDay[$today->format('Y-m-d')];

        // Check yesterday's views are 100 for the only author
        static::assertSame(100, $yesterdayViews[0]->totalViews());
        //static::assertSame(100, $yesterdayViews[0]['blogPosts'][0]['views']); // used with AbstractQuery::HYDRATE_ARRAY

        // Check today's views are 200 for the only author
        static::assertSame(200, $todayViews[0]->totalViews());
        //static::assertSame(200, $todayViews[0]['blogPosts'][0]['views']); // used with AbstractQuery::HYDRATE_ARRAY
    }
}
