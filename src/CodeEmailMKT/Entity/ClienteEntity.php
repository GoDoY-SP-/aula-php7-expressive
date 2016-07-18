<?php
namespace CodeEmailMKT\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cliente
 *
 * @ORM\Table(name="clientes")
 * @ORM\Entity
 */
class ClienteEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cli_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="EnderecoEntity")
     * @ORM\JoinTable(name="clientes_enderecos",
     *      joinColumns={@ORM\JoinColumn(name="cli_id", referencedColumnName="cli_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="end_id", referencedColumnName="end_id", unique=true)}
     *      )
     */
    private $enderecos;

    /**
     * @var string
     *
     * @ORM\Column(name="cli_nome", type="string", length=100, nullable=false)
     */
    private $nome;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="cli_email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="cli_cpf", type="string", length=11, nullable=false)
     */
    private $cpf;

    public function __construct()
    {
        $this->enderecos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ClienteEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnderecos()
    {
        return $this->enderecos;
    }

    /**
     * @param mixed $enderecos
     * @return ClienteEntity
     */
    public function setEnderecos(\Doctrine\Common\Collections\ArrayCollection $enderecos)
    {
        $this->enderecos = $enderecos;
        return $this;
    }

    /**
     * @param $enderecos
     */
    public function addEnderecos($enderecos)
    {
        foreach ($enderecos as $endereco) {
            $this->enderecos->add($endereco);
        }
    }

    /**
     * @param $enderecos
     */
    public function removeEnderecos($enderecos)
    {
        foreach ($enderecos as $endereco) {
            $this->enderecos->removeElement($endereco);
        }
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return ClienteEntity
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return ClienteEntity
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     * @return ClienteEntity
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }
}