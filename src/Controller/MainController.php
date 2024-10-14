<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
// Autres méthodes du contrôleur...

/**
* @Route("/vente-future/{idVente}/lot/{idLot}", name="app_main_route")
*/
    public function mainController( int $idLot): Response
    {
        return $this->forward('App\Controller\LotController::detailLot', [
            'id' => $idLot,
        ]);
    }
}
