<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wish", name="wish_list")
     */
    public function list(WishRepository $wishRepository): Response
    {
        $wishList = $wishRepository->findAll();
        return $this->render('wish/list.html.twig',[
            'wishList' => $wishList
        ]);
    }

    /**
     * @Route("/wish/detail/{id}", name="wish_detail")
     */
    public function detail($id, WishRepository $wishRepository): Response
    {
        $wish = $wishRepository->find($id);
        return $this->render('wish/detail.html.twig',[
            "wish" => $wish
        ]);
    }
}
