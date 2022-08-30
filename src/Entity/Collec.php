<?php

namespace App\Entity;

use App\Repository\CollecRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollecRepository::class)]
class Collec
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'collec', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: VideoGame::class, inversedBy: 'collecs')]
    private Collection $video_game;

    public function __construct()
    {
        $this->video_game = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, VideoGame>
     */
    public function getVideoGame(): Collection
    {
        return $this->video_game;
    }

    public function addVideoGame(VideoGame $videoGame): self
    {
        if (!$this->video_game->contains($videoGame)) {
            $this->video_game->add($videoGame);
        }

        return $this;
    }

    public function removeVideoGame(VideoGame $videoGame): self
    {
        $this->video_game->removeElement($videoGame);

        return $this;
    }
}
