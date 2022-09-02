<?php

namespace App\Controller\back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\MasterpieceRepository;

/**
 * Require ROLE_ADMIN for all the actions of this controller
 *
 * @IsGranted("ROLE_ADMIN")
 */
#[Route('/back', name: 'back_gallery_')]
class GalleryController extends AbstractController
{
        #[Route('/gallery', name: 'index')]
    public function search(MasterpieceRepository $masterpieceRepo): Response
    {
        return $this->render(
            'back/gallerySearch.html.twig'
        );
    }
}
