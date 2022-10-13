<?php

namespace App\Controller;

use App\Repository\PlantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PlantRepository $plantRepository): Response
    {
        return $this->render('home.html.twig', [
            'plants' => $plantRepository->findAll(),
            'ctaRedirection' => 'app_plant_new',
        ]);
    }
}
