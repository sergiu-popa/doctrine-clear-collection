<?php

namespace App\Controller;

use App\AuthorManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogPostController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(AuthorManager $manager)
    {
        return $this->render('blog_post/index.html.twig', [
            'viewsByDay' => $manager->getAuthors()
        ]);
    }
}
