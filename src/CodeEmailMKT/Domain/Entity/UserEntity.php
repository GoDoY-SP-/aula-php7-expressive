<?php
namespace CodeEmailMKT\Domain\Entity;

/**
 * Usuário
 */
class UserEntity
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $passwordPlain;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return UserEntity
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return UserEntity
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return UserEntity
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getPasswordPlain()
    {
        return $this->passwordPlain;
    }

    /**
     * @param string $passwordPlain
     * @return UserEntity
     */
    public function setPasswordPlain($passwordPlain)
    {
        $this->passwordPlain = $passwordPlain;
        return $this;
    }

    /**
     * Gerar senha/criptografar
     */
    public function generatePassword()
    {
        // Pegar o password puro ou gerar um novo
        $password = $this->getPasswordPlain() ? $this->getPasswordPlain() : uniqid();

        // Criptografar
        $this->setPassword(password_hash($password, PASSWORD_BCRYPT));
    }
}