<?php

namespace App\Entity;

use App\Repository\BoissonRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;



#[ORM\Entity(repositoryClass: BoissonRepository::class)]
#[UniqueEntity('name')]
#[ApiResource(
    normalizationContext: ['groups' => ['user:read'], 'groups' => ['boisson:read']],
    denormalizationContext: ['groups' => ['user:write'], 'groups' => ['boisson:read']],
    forceEager: false,
    operations: [
        new GetCollection(),
        new Get(),
        new Post(security: "is_granted('ROLE_BARMAN')"),
        new Delete(security: "is_granted('ROLE_BARMAN')"),
        new Patch(security: "is_granted('ROLE_BARMAN')")
    ]
)]
class Boisson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['boisson:read', 'boisson:write'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Groups(['boisson:read', 'boisson:write'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['boisson:read', 'boisson:write'])]
    private ?string $price = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups(['boisson:read', 'boisson:write'])]
    private ?Media $photo = null;

    #[ORM\ManyToOne(inversedBy: 'boissonCommandée')]
    private ?Commande $commande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPhoto(): ?Media
    {
        return $this->photo;
    }

    public function setPhoto(?Media $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this->commande = $commande;

        return $this;
    }
}
