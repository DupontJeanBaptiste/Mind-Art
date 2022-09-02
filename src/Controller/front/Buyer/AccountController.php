<?php

namespace App\Controller\front\Buyer;

use App\Entity\User;
use App\Form\BuyerType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front/buyer', name: 'buyer_')]
class AccountController extends AbstractController
{
    #[Route('/account', name: 'account')]
    public function account(UserRepository $userRepository): Response
    {


        $buyer = $userRepository->findAll();
        return $this->render('front/buyer/account.html.twig', [
            'buyer' => $buyer,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {

        $form = $this->createForm(BuyerType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);

            return $this->redirectToRoute('buyer_account', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/buyer/edit.html.twig', [
            'buyer' => $user,
            'form' => $form,
        ]);
    }
}
