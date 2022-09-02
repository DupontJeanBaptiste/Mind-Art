<?php

namespace App\Controller\front\Buyer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front/buyer', name: 'buyer_')]
class MessageController extends AbstractController
{
    #[Route('/messages', name: 'messages')]
    public function messages(): Response
    {
        return $this->render('front/buyer/messages.html.twig', [
            'controller_name' => 'BayerController',
        ]);
    }
}
