<?php

namespace CodeEmailMKT\Infrastructure\Service;

use Aura\Session\Segment;
use Aura\Session\Session;
use CodeEmailMKT\Domain\Service\FlashMessageServiceInterface;

class FlashMessageService implements FlashMessageServiceInterface
{

    /**
     * @var Session
     */
    private $session;

    /**
     * @var Segment
     */
    private $segment;

    public function __construct(Session $session)
    {
        $this->session = $session;
        if (!$this->session->isStarted()) {
            $this->session->start();
        }
    }

    public function setNamespace($name = __NAMESPACE__)
    {
        // Setar segmento
        $this->segment = $this->session->getSegment($name);

        // Retornar FlashMessage
        return $this;
    }

    public function setMessage($key, $value)
    {
        // Verificar se o segmento existe
        if (!$this->segment) {
            $this->setNamespace();
        }

        // Setar mensagem
        $this->segment->setFlash($key, $value);

        // Retornar FlashMessage
        return $this;
    }

    public function getMessage($key)
    {
        // Verificar se o segmento existe
        if (!$this->segment) {
            $this->setNamespace();
        }

        // Retornar mensagem
        return $this->segment->getFlash($key);
    }
}