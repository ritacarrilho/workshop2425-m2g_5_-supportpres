<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StatisticController extends AbstractController
{
    #[Route('/statistic', name: 'app_statistic')]
    public function index(): Response
    {
        return $this->render('statistic/statistic.html.twig', [
            'controller_name' => 'StatisticController',
        ]);
    }
}
