<?php

namespace App\Entity;

use App\Repository\VideoGameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VideoGameRepository::class)]
class VideoGame
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'videoGames')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Console $console = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\ManyToMany(targetEntity: Collec::class, mappedBy: 'video_game')]
    private Collection $collecs;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $name = null;

    public function __construct()
    {
        $this->collecs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConsole(): ?Console
    {
        return $this->console;
    }

    public function setConsole(?Console $console): self
    {
        $this->console = $console;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return Collection<int, Collec>
     */
    public function getCollecs(): Collection
    {
        return $this->collecs;
    }

    public function addCollec(Collec $collec): self
    {
        if (!$this->collecs->contains($collec)) {
            $this->collecs->add($collec);
            $collec->addVideoGame($this);
        }

        return $this;
    }

    public function removeCollec(Collec $collec): self
    {
        if ($this->collecs->removeElement($collec)) {
            $collec->removeVideoGame($this);
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
