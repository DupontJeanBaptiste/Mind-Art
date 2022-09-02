<?php

namespace App\Components;

use App\Repository\MasterpieceRepository;
use App\Repository\UserRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use App\Services\ShuffleService;

use function PHPUnit\Framework\isEmpty;

#[AsLiveComponent('masterpiece_search')]
class MasterpieceSearchComponent
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public ?string $query = null;

    #[LiveProp(writable: true)]
    public ?string $query2 = null;

    public function __construct(
        private MasterpieceRepository $masterpieceRepo,
        private UserRepository $userRepository
    ) {
    }

    public function getMasterpieces(): array
    {
        $service = new ShuffleService();

        if (isset($this->query) && $this->query != "") {
            $array = $this->masterpieceRepo->findByQueryName($this->query);
            return $service->shuffleArray($array);
        }

        if (isset($this->query2) && $this->query2 != "") {
            $user = $this->userRepository->findByQueryUser($this->query2);
            if (count($user) === 1) {
                $array = $this->masterpieceRepo->findBy(['user' => $user[0]->getId()]);
                return $service->shuffleArray($array);
            } else {
                return [];
            }
        }

        return $service ->shuffleArray($this->masterpieceRepo->findAll());
    }
}
