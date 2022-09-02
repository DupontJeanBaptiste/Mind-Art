<?php

namespace App\Controller;

use App\Entity\Masterpiece;
use App\Form\MasterpieceType;
use App\Repository\MasterpieceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/masterpiece')]
class MasterpieceController extends AbstractController
{
    #[Route('/', name: 'app_masterpiece_index', methods: ['GET'])]
    public function index(MasterpieceRepository $masterpieceRepo): Response
    {
        return $this->render('masterpiece/index.html.twig', [
            'masterpieces' => $masterpieceRepo->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_masterpiece_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MasterpieceRepository $masterpieceRepo): Response
    {
        $masterpiece = new Masterpiece();
        $form = $this->createForm(MasterpieceType::class, $masterpiece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $masterpieceRepo->add($masterpiece, true);

            return $this->redirectToRoute('app_masterpiece_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('masterpiece/new.html.twig', [
            'masterpiece' => $masterpiece,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_masterpiece_show', methods: ['GET'])]
    public function show(Masterpiece $masterpiece): Response
    {
        return $this->render('masterpiece/show.html.twig', [
            'masterpiece' => $masterpiece,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_masterpiece_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Masterpiece $masterpiece,
        MasterpieceRepository $masterpieceRepo
    ): Response {
        $form = $this->createForm(MasterpieceType::class, $masterpiece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $masterpieceRepo->add($masterpiece, true);

            return $this->redirectToRoute('app_masterpiece_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('masterpiece/edit.html.twig', [
            'masterpiece' => $masterpiece,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_masterpiece_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        Masterpiece $masterpiece,
        MasterpieceRepository $masterpieceRepo
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $masterpiece->getId(), $request->request->get('_token'))) {
            $masterpieceRepo->remove($masterpiece, true);
        }

        return $this->redirectToRoute('app_masterpiece_index', [], Response::HTTP_SEE_OTHER);
    }
}
