<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/wish/add", name="wish_add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        // on initialise une instance de wish
        $wish = new Wish();
        $wish->setIsPublished(true);
        $wish->setDateCreated(new \DateTime());

        // on instancie notre formulaire
        $wishForm = $this->createForm(WishType::class, $wish);

        // on recupere les données du formulaire
        $wishForm->handleRequest($request);
        // Si on as reçu le formulaire
        if($wishForm->isSubmitted() && $wishForm->isValid()){

            //enregistre en base de données
            $entityManager->persist($wish);
            $entityManager->flush();

            //ajoute un message flash
            $this->addFlash('success','Souhait bien ajouter !');

            // redirection si le formulaire est bien remplis
            return $this->redirectToRoute('wish_detail',['id' => $wish->getId()]);
        }

        // on affiche la page en lui fournissant le formulaire
        return $this->render('wish/add.html.twig',[
            'wishForm' => $wishForm->createView()
        ]);
    }
}
