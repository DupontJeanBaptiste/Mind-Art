<?php

namespace App\Controller\front\Seller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SubscriptionRepository;

#[Route('/front/seller', name: 'seller_')]
class ManageMyGalleryController extends AbstractController
{
    #[Route('/managemygallery', name: 'managemygallery')]
    public function manageMyGalerie(): Response
    {
        return $this->render('front/seller/manageMyGallery.html.twig', [
            'controller_name' => 'SellerController',
        ]);
    }
}
