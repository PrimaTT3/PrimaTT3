<?php

namespace App\Controller;

use App\Entity\Produit;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'create_produit')]
    public function createProduit(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        
        $produit = new Produit();
        $produit->setNom('Clavier');
        $produit->setPrix(1999);
        $produit->setDescription('Ergo et Stylé!');

        $entityManager->persist($produit);

        $entityManager->flush();

        return new Response('Nouveau produit enregistrer avec l\'id ' . $produit->getId());
    }

    #[Route('/produit/{id}', name: 'produit_show')]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $produit = $doctrine->getRepository(produit::class)->find($id);

        if (!$produit) {
            throw $this->createNotFoundException(
                'No produit found for id '.$id
            );
        }

        return new Response('Check out this great produit: '.$produit->getName());

        // or render a template
        // in the template, print things with {{ produit.name }}
        // return $this->render('produit/show.html.twig', ['produit' => $produit]);
    }
}
