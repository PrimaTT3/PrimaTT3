<?php

namespace App\Controller;

use App\Entity\Produit;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function createProduit(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $produit = new Produit();
        $produit->setNom('Clavier');
        $produit->setPrix(1999);
        $produit->setDescription('Ergo et Stylé!');
    }
}
