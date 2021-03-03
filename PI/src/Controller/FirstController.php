<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{



    /**
     * @Route("/first", name="first")
     */
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }

    /**
     * @Route("/jobs", name="jobs")
     */
    public function jobs(): Response
    {
        return $this->render('jobs.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }
    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('about-us.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }
    /**
     * @Route("/blog", name="blog")
     */
    public function blog(): Response
    {
        return $this->render('blog.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }
    /**
     * @Route("/blogdetails", name="blogdetails")
     */
    public function blog_details(): Response
    {
        return $this->render('blog-details.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('contact.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }
    /**
     * @Route("/jobdetails", name="jobdetails")
     */
    public function job_details(): Response
    {
        return $this->render('job-details.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }
    /**
     * @Route("/team", name="team")
     */
    public function team(): Response
    {
        return $this->render('team.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }
    /**
     * @Route("/terms", name="terms")
     */
    public function terms(): Response
    {
        return $this->render('terms.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }
    /**
     * @Route("/testimonials", name="testimonials")
     */
    public function testimonials(): Response
    {
        return $this->render('testimonials.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }
}
