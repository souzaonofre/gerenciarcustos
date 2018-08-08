<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovimentacaoRepository")
 */
class Movimentacao
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $descricao;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Funcionario", inversedBy="movimentacoes", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $funcionario;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $valor;

    public function getId()
    {
        return $this->id;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getFuncionario(): ?Funcionario
    {
        return $this->funcionario;
    }

    public function setFuncionario(Funcionario $funcionario): self
    {
        $this->funcionario = $funcionario;

        return $this;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor): self
    {
        $this->valor = $valor;

        return $this;
    }
}
