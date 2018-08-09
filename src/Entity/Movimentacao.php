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
     * @ORM\Column(type="datetime")
     */
    private $data;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $fornecedor;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $descricao;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $valor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Funcionario", inversedBy="movimentacoes", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $funcionario;



    public function getId()
    {
        return $this->id;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): self
    {
        if ($data) {
            $this->data = $data;
        } else {
            $this->data = new \DateTime("now");
        }

        return $this;
    }

    public function getFornecedor(): ?string
    {
        return $this->fornecedor;
    }

    public function setFornecedor(string $fornecedor): self
    {
        $this->fornecedor = $fornecedor;

        return $this;
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

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor): self
    {
        $this->valor = $valor;

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

}
