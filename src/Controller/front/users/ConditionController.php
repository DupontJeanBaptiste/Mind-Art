<?php

namespace App\Controller\front\users;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front', name: 'users_condition_')]
class ConditionController extends AbstractController
{
    #[Route('/condition', name: 'index')]
    public function index(): Response
    {
        return $this->render('front/users/condition.html.twig');
    }
}
