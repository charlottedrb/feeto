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
        $ctaRedirection = 'app_register';
        $ctaRedirectionLabel = 'Create an account';

        if($this->getUser()) {
            $ctaRedirection = 'app_plant_new';
            $ctaRedirectionLabel = "Create a plant";
        } 
        return $this->render('home.html.twig', [
            'plants' => $plantRepository->findAll(),
            'ctaRedirection' => $ctaRedirection,
            'ctaRedirectionLabel' => $ctaRedirectionLabel,
        ]);
    }
}
