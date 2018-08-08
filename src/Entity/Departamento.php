<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartamentoRepository")
 */
class Departamento
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $descricao;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Funcionario", mappedBy="departamento")
     */
    private $funcionarios;

    public function __construct()
    {
        $this->funcionarios = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * @return Collection|Funcionario[]
     */
    public function getFuncionarios(): Collection
    {
        return $this->funcionarios;
    }

    public function addFuncionario(Funcionario $funcionario): self
    {
        if (!$this->funcionarios->contains($funcionario)) {
            $this->funcionarios[] = $funcionario;
            $funcionario->setDepartamento($this);
        }

        return $this;
    }

    public function removeFuncionario(Funcionario $funcionario): self
    {
        if ($this->funcionarios->contains($funcionario)) {
            $this->funcionarios->removeElement($funcionario);
            // set the owning side to null (unless already changed)
            if ($funcionario->getDepartamento() === $this) {
                $funcionario->setDepartamento(null);
            }
        }

        return $this;
    }
}
