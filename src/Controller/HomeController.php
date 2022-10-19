<?php

namespace App\Controller;

use App\Repository\PlantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PlantRepository $plantRepository, TranslatorInterface $translator): Response
    {
        $ctaRedirection = 'app_register';
        $ctaRedirectionLabel = $translator->trans('Create an account');

        if($this->getUser()) {
            $ctaRedirection = 'app_plant_new';
            $ctaRedirectionLabel = $translator->trans('Plante_create');
        } 
        return $this->render('home.html.twig', [
            'plants' => $plantRepository->findAll(),
            'ctaRedirection' => $ctaRedirection,
            'ctaRedirectionLabel' => $ctaRedirectionLabel,
            'ctaTitle' => $translator->trans('Plant_add')
        ]);
    }
}
