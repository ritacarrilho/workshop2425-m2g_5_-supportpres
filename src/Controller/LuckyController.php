<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LuckyController extends AbstractController
{
    public function number(): Response
    {
        $number = random_int(0, 100);

        return $this->render('lucky/foo.html.twig', [
            'foo' => "number",
            'bar' => $number,
        ]);
    }


    public function numberMd5(): Response
    {
        $number = md5("Lucky"); // fonction de hachage cryptographique

        return $this->render('lucky/foo.html.twig', [
            'foo' => "md5",
            'bar' => $number,
        ]);
    }
}