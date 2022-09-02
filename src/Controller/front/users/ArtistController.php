<?php

namespace App\Controller\front\users;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front', name: 'users_artists_')]
class ArtistController extends AbstractController
{
    #[Route('/artists', name: 'index')]
    public function index(UserRepository $userRepository): Response
    {
        $artists = $userRepository->findBySeller('ROLE_SELLER');
        return $this->render(
            'front/users/artists.html.twig',
            [
            'artists' => $artists,
            ]
        );
    }

    /*#[Route('/artist/{id<\d+>}', methods: ['GET'], name: 'show')]
    public function show(UserRepository $userRepository, int $id): Response
    {
        $userRepository->finOneBy(['id' => $id ]);
        return $this->render('front/users/artist.html.twig',
    [
        'artist' => $userRepository,
    ]);
    }*/

    /*#[Route('/artist/{id<\d+>}/masterpiece/{id<\d+>}', methods: ['GET'], name: 'show_masterpiece')]
    public function showOeuvre(): Response
    {
        return $this->render('front/users/masterpiece.html.twig');
    }*/
}
