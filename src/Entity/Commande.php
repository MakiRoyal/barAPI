<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Patch;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['commande:read']],
    denormalizationContext: ['groups' => ['commande:write']],
    forceEager: false,
    operations: [
        new GetCollection(security: "is_granted('ROLE_SERVEUR') or is_granted('ROLE_BARMAN')"),
        new Get(security: "is_granted('ROLE_SERVEUR') or is_granted('ROLE_BARMAN')"),
        new Post(security: "is_granted('ROLE_SERVEUR')  or object == user"),
        new Put(),
        new Delete(),
        new Patch(security: "is_granted('ROLE_SERVEUR') or is_granted('ROLE_BARMAN')")
    ]
)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['commande:read', 'user:read'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['commande:read', 'commande:write'])]
    private ?\DateTimeInterface $createdDate = null;

    /**
     * @var Collection<int, Boisson>
     */
    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: Boisson::class, cascade: ['persist', 'remove'])]
    #[Groups(['commande:read', 'commande:write'])]
    private Collection $boissonCommandee;

    #[ORM\Column(length: 255)]
    #[Groups(['commande:read', 'commande:write'])]
    private ?string $numberTable = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['commande:read', 'commande:write'])]
    private ?User $relationServeur = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['commande:read', 'commande:write'])]
    private ?User $relationBarman = null;

    #[ORM\Column(length: 255)]
    #[Groups(['commande:read', 'commande:write'])]
    private ?string $status = null;

    public function __construct()
    {
        $this->boissonCommandee = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): static
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    /**
     * @return Collection<int, Boisson>
     */
    public function getBoissonCommandee(): Collection
    {
        return $this->boissonCommandee;
    }

    public function addBoissonCommandee(Boisson $boissonCommandee): static
    {
        if (!$this->boissonCommandee->contains($boissonCommandee)) {
            $this->boissonCommandee->add($boissonCommandee);
            $boissonCommandee->setCommande($this);
        }

        return $this;
    }

    public function removeBoissonCommandee(Boisson $boissonCommandee): static
    {
        if ($this->boissonCommandee->removeElement($boissonCommandee)) {
            // set the owning side to null (unless already changed)
            if ($boissonCommandee->getCommande() === $this) {
                $boissonCommandee->setCommande(null);
            }
        }

        return $this;
    }

    public function getNumberTable(): ?string
    {
        return $this->numberTable;
    }

    public function setNumberTable(string $numberTable): static
    {
        $this->numberTable = $numberTable;
        return $this;
    }

    public function getRelationServeur(): ?User
    {
        return $this->relationServeur;
    }

    public function setRelationServeur(?User $relationServeur): static
    {
        $this->relationServeur = $relationServeur;
        return $this;
    }

    public function getRelationBarman(): ?User
    {
        return $this->relationBarman;
    }

    public function setRelationBarman(?User $relationBarman): static
    {
        $this->relationBarman = $relationBarman;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;
        return $this;
    }
}
