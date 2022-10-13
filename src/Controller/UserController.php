<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/profile', 'app_profile')] 
    public function profile() : Response
    {
        return $this->render('user/profile.html.twig');
    }

    #[Route('/change-locale/{locale}', 'app_change_locale', ['locale' => 'en|fr_FR'])] 
    public function changeLocale(Request $request, string $locale) : Response
    {
        if ($request->attributes->get('_locale')) {
            $request->getSession()->set('_locale', $locale);
        } else {
            // if no explicit locale has been set on this request, use one from the session
            $request->setLocale($request->getSession()->get('_locale', $locale));
        }
    
        return $this->redirect($request->headers->get('referer'));
    }
}
