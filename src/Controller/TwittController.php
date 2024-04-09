<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TwittController extends AbstractController
{
    #[Route('/twitt', name: 'app_twitt')]
    public function index(): Response
    {
        return $this->render('twitt/index.html.twig', [
            'controller_name' => 'TwittController',
        ]);
    }
}
