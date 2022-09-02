<?php

namespace App\Components;

use App\Repository\MasterpieceRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('masterpiece')]
class MasterpieceComponent
{
    public int $id;

    public function __construct(
        private MasterpieceRepository $masterpieceRepo,
    ) {
    }

    public function getMasterpiece(): object
    {

        return $this->masterpieceRepo->find($this->id);
    }
}
