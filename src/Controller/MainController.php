<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_home")
     */
    public function home(){
        return $this->render('main/home.html.twig');
    }

    /**
     * @Route("/aboutUs", name="main_aboutUs")
     */
    public function aboutUs(){
        return $this->render('main/aboutUs.html.twig');
    }
}