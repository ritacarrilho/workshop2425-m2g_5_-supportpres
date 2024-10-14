<?php
namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// Entités
use App\Entity\Lot;
use App\Entity\Cheval;
use App\Entity\CategorieLot;
use App\Entity\Vente;
use App\Entity\LieuVente;

class LotController extends AbstractController
{
    public function detailLot(int $id, EntityManagerInterface $entityManager): Response
    {
        $lotRepository = $entityManager->getRepository(Lot::class);
        $lot = $lotRepository->findOneBy(['id' => $id]);

        if (!$lot) {
            throw $this->createNotFoundException('Lot non trouvé');
        }

        // Récupérer les informations de la vente associée au lot
        $venteRepository = $entityManager->getRepository(Vente::class);
        $vente = $venteRepository->findOneBy(['id' => $lot->getIdVente()]);

        if (!$vente) {
            throw $this->createNotFoundException('Vente non trouvée');
        }

        // Récupérer les informations du cheval associé au lot
        $chevalRepository = $entityManager->getRepository(Cheval::class);
        $cheval = $chevalRepository->findOneBy(['id' => $lot->getIdCheval()]);

        // Récupérer les informations de la catégorie du lot
        $categorieLotRepository = $entityManager->getRepository(CategorieLot::class);
        $categorieLot = $categorieLotRepository->findOneBy(['id' => $lot->getIdCategorieLot()]);

        // Récupérer les informations du lieu de vente
        $lieuVenteRepository = $entityManager->getRepository(LieuVente::class);
        $lieuVente = $lieuVenteRepository->findOneBy(['id' => $vente->getIdLieuVente()]);

        return $this->render('lot/lot.html.twig', [
            'lot' => $lot,
            'vente' => $vente,
            'cheval' => $cheval,
            'categorieLot' => $categorieLot,
            'lieuVente' => $lieuVente,
        ]);
    }
}