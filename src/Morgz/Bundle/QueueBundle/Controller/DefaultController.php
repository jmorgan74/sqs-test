<?php

namespace Morgz\Bundle\QueueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Morgz\Bundle\QueueBundle\Entity\BlogPost;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $blogPost = new BlogPost();
        $blogPost->setTitle('Test - ' . rand());
        $blogPost->setContent('Content - ' . rand());

        $manager = $this->getDoctrine()->getManager();

        $manager->persist($blogPost);

        $manager->flush();

        return $this->render('MorgzQueueBundle:Default:index.html.twig');
    }
}
