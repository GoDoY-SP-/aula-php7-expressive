<?php
namespace CodeEmailMKT\Infrastructure\Storage;

use Aura\Session\Segment;
use Aura\Session\Session;
use CodeEmailMKT\Domain\Storage\AuthenticationStorageInterface;
use Zend\Authentication\Storage\StorageInterface;

class AuthenticationStorage implements StorageInterface, AuthenticationStorageInterface
{
    /**
     * Default session namespace
     */
    const NAMESPACE_DEFAULT = 'Zend_Auth';

    /**
     * Default session object member name
     */
    const MEMBER_DEFAULT = 'storage';

    /**
     * @var Session
     */
    private $session;

    /**
     * @var Segment
     */
    private $segment;

    /**
     * Session object member
     *
     * @var mixed
     */
    protected $member = self::MEMBER_DEFAULT;


    /**
     * AuthenticationService constructor.
     * @param Session $session
     */
    public function __construct(
        Session $session
    ) {
        // Setar container de sessão
        $this->session = $session;

        // Iniciar sessão
        if (!$this->session->isStarted()) {
            $this->session->start();
        }

        // Setar segmento
        $this->setNamespace();
    }

    public function setNamespace(
        $name = self::NAMESPACE_DEFAULT
    ) {
        // Verificar se o segmento existe
        if (!$this->segment || $name != self::NAMESPACE_DEFAULT) {
            // Setar segmento
            $this->segment = $this->session->getSegment($name);
        }

        // Retornar storage
        return $this;
    }

    /**
     * Returns the name of the session object member
     *
     * @return string
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * Returns true if and only if storage is empty
     *
     * @throws \Zend\Authentication\Exception\ExceptionInterface If it is impossible to determine whether storage is empty
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->segment->get($this->member));
    }

    /**
     * Returns the contents of storage
     *
     * Behavior is undefined when storage is empty.
     *
     * @throws \Zend\Authentication\Exception\ExceptionInterface If reading contents from storage is impossible
     * @return mixed
     */
    public function read()
    {
        return $this->segment->get($this->member);
    }

    /**
     * Writes $contents to storage
     *
     * @param  mixed $contents
     * @throws \Zend\Authentication\Exception\ExceptionInterface If writing $contents to storage is impossible
     * @return void
     */
    public function write(
        $contents
    ) {
        // Setar mensagem
        $this->segment->set($this->member, $contents);
    }

    /**
     * Clears contents from storage
     *
     * @throws \Zend\Authentication\Exception\ExceptionInterface If clearing contents from storage is impossible
     * @return void
     */
    public function clear()
    {
        $this->segment->clear();
    }
}