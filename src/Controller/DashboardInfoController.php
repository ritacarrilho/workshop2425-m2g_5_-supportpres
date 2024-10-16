<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardInfoController extends AbstractController
{
    #[Route('/dashboard/enfants', name: 'app_dashboard_info')]
    public function index(): Response
    {
        // get parent info : firstname, lastaname, email, phone, birthday, address
        // get child

        return $this->render('dashboard_info/dashboardinfo.html.twig', [
            'controller_name' => 'DashboardInfoController',
        ]);
    }
}
