<?php

namespace App\Controller\front\Seller;

use App\Entity\User;
use App\Form\SellerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SubscriptionRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

#[Route('/front/seller', name: 'seller_')]
class AccountController extends AbstractController
{
    #[Route('/account', name: 'account')]
    public function account(): Response
    {
        return $this->render('front/seller/account.html.twig', [
            'controller_name' => 'SellerController',
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {

        $form = $this->createForm(SellerType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);

            return $this->redirectToRoute('seller_account', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/seller/edit.html.twig', [
            'seller' => $user,
            'form' => $form,
        ]);
    }
}
