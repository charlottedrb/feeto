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
    #[Route('/profile', 'app_profile', methods: ['GET', 'POST'])] 
    public function profile(Request $request, UserRepository $userRepository) : Response
    {
        $form = $this->createForm(UserType::class, $this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($this->getUser(), true);

            return $this->redirectToRoute('app_plant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/profile.html.twig', [
            'user' => $this->getUser(),
            'form' => $form,
        ]);
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
