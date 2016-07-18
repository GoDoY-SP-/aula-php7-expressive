<?php
namespace CodeEmailMKT\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Endereço
 *
 * @ORM\Table(name="enderecos")
 * @ORM\Entity
 */
class EnderecoEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="end_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="end_cep", type="string", length=8, nullable=false)
     */
    private $cep;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="end_logradouro", type="string", length=100, nullable=false)
     */
    private $logradouro;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="end_cidade", type="string", length=100, nullable=false)
     */
    private $cidade;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="end_estado", type="string", length=2, nullable=false)
     */
    private $estado;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return EnderecoEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param string $cep
     * @return EnderecoEntity
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * @param string $logradouro
     * @return EnderecoEntity
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
        return $this;
    }

    /**
     * @return string
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @param string $cidade
     * @return EnderecoEntity
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
        return $this;
    }

    /**
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param string $estado
     * @return EnderecoEntity
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
        return $this;
    }

}