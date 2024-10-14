<?php
namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// Entités
use App\Entity\Vente; // Importez la classe de l'entité Vente
use App\Entity\Lot;
use App\Entity\Cheval;
use App\Entity\LieuVente;
use App\Entity\CategorieLot;

// Repository
use App\Repository\VenteRepository;

class VenteController extends AbstractController
{
    public function venteFuture(): Response
    {
        $venteRepository = $this->getDoctrine()->getRepository(Vente::class);
        $ventes = $venteRepository->findAll();

        $lotRepository = $this->getDoctrine()->getRepository(Lot::class);
        $chevalRepository = $this->getDoctrine()->getRepository(Cheval::class);

        foreach ($ventes as $vente) {
            $venteId = $vente->getId();
            $lots = $lotRepository->findBy(['idVente' => $venteId]);

            foreach ($lots as $lot) {
                $chevalId = $lot->getIdCheval();
                $cheval = $chevalRepository->find($chevalId);
                $lot->getIdCheval($cheval);
            }

            $vente->getLots($lots);
        }

        return $this->render('home/home.html.twig', [
            'ventes' => $ventes,
        ]);
    }

    public function ventePasse(VenteRepository $venteRepository): Response
    {
        $ventes = $venteRepository->createQueryBuilder('v')
            ->orderBy('v.dateVente', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('historique/historique.html.twig', [
            'ventes' => $ventes,
        ]);
    }

    public function detailsVente(int $id, EntityManagerInterface $entityManager): Response
    {
        $venteRepository = $entityManager->getRepository(Vente::class);
        $vente = $venteRepository->findOneBy(['id' => $id]);

        if (!$vente) {
            throw $this->createNotFoundException('Vente non trouvée');
        }

        // Récupérer tous les lots associés à la vente
        $lotRepository = $entityManager->getRepository(Lot::class);
        $lots = $lotRepository->findBy(['idVente' => $vente->getId()]);

        // Récupérer les informations de la catégorie du lot
        $categorieLotRepository = $entityManager->getRepository(CategorieLot::class);
        $categorieLots = [];

        foreach ($lots as $lot) {
            $categorieLot = $categorieLotRepository->findOneBy(['id' => $lot->getIdCategorieLot()->getId()]);
            $categorieLots[] = $categorieLot;
        }

        // Récupérer les informations du cheval associé à chaque lot
        $chevalRepository = $entityManager->getRepository(Cheval::class);
        $chevaux = [];

        foreach ($lots as $lot) {
            $cheval = $chevalRepository->findOneBy(['id' => $lot->getIdCheval()]);
            $chevaux[] = $cheval;
        }

        // Récupérer les informations du lieu de vente
        $lieuVenteRepository = $entityManager->getRepository(LieuVente::class);
        $lieuVente = $lieuVenteRepository->findOneBy(['id' => $vente->getIdLieuVente()]);


        return $this->render('ventes/ventes.html.twig', [
            'vente' => $vente,
            'lots' => $lots,
            'chevaux' => $chevaux,
            'categorieLots' => $categorieLots,
            'lieuVente' => $lieuVente,
        ]);
    }

}