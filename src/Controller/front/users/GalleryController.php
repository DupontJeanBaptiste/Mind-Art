<?php

namespace App\Controller\front\users;

use App\Repository\MasterpieceRepository;
use App\Entity\Masterpiece;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front', name: 'users_gallery_')]
class GalleryController extends AbstractController
{
    #[Route('/gallery', name: 'index')]
    public function search(MasterpieceRepository $masterpieceRepo): Response
    {
        return $this->render(
            'front/users/gallerySearch.html.twig'
        );
    }

    #[Route('/gallery/{masterpieceId<\d+>}/likelist/{userId<\d+>}', name: 'add_likelist')]
    public function addLikelist(
        MasterpieceRepository $masterpieceRepo,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        int $masterpieceId,
        int $userId,
    ): Response {
        $masterpiece = $masterpieceRepo->findOneBy(['id' => $masterpieceId]);

        $user = $userRepository->findOneBy(['id' => $userId]);

        if ($user->isInLikelist($masterpiece)) {
            $user->removeFromLikelist($masterpiece);
        } else {
            $user->addToLikelist($masterpiece);
        }

        $entityManager->flush();

        return $this->json([
            'isInLikelist' => $user->isInLikelist($masterpiece)
        ]);
        //return $this->redirectToRoute('users_gallery_index');
        /*return $this->render(
            'front/users/gallerySearch.html.twig'
        );*/
    }
}
