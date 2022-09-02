<?php

namespace App\Components;

use App\Entity\Masterpiece;
use App\Repository\MasterpieceRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('all_masterpiece')]
class AllMasterpieceComponent
{
    public int $id;

    public function __construct(
        private MasterpieceRepository $masterpieceRepo
    ) {
    }

    public function getAllMasterpiece(): array
    {
        return $this->masterpieceRepo->findAll();
    }
}
