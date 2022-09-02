<?php

namespace App\Controller\front\users;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front', name: 'users_payment_')]
class PaymentController extends AbstractController
{
    #[Route('/payment', name: 'index')]
    public function index(): Response
    {
        return $this->render('front/users/payment.html.twig');
    }
}
