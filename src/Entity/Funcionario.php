<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FuncionarioRepository")
 */
class Funcionario
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $senha;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Departamento", inversedBy="funcionarios")
     */
    private $departamento;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Movimentacao", mappedBy="funcionario", cascade={"persist", "remove"})
     */
    private $movimentacoes;

    public function __construct()
    {
        $this->movimentacoes = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(?string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    public function getDepartamento(): ?Departamento
    {
        return $this->departamento;
    }

    public function setDepartamento(?Departamento $departamento): self
    {
        $this->departamento = $departamento;

        return $this;
    }

    public function getMovimentacoes(): Collection
    {
        return $this->movimentacoes;
    }

    public function addMovimentacao(Movimentacao $movimentacao): self
    {
        if (!$this->movimentacoes->contains($movimentacao)) {
            $movimentacao->setFuncionario($this);
            $this->movimentacoes[] = $movimentacao;
        }

        return $this;
    }

    public function removeMovimentacao(Movimentacao $movimentacao): self
    {
        if ($this->movimentacoes->contains($movimentacao)) {
            $this->movimentacoes->removeElement($movimentacao);
            // set the owning side to null (unless already changed)
            if ($movimentacao->getDepartamento() === $this) {
                $movimentacao->setDepartamento(null);
            }
        }

        return $this;
    }
}
