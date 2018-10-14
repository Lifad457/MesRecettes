<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngredientRepository")
 */
class Ingredient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_ingredient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recette", inversedBy="ingredients")
     */
    private $recette;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomIngredient(): ?string
    {
        return $this->nom_ingredient;
    }

    public function setNomIngredient(string $nom_ingredient): self
    {
        $this->nom_ingredient = $nom_ingredient;

        return $this;
    }

    public function getRecette(): ?Recette
    {
        return $this->recette;
    }

    public function setRecette(?Recette $recette): self
    {
        $this->recette = $recette;

        return $this;
    }
}
