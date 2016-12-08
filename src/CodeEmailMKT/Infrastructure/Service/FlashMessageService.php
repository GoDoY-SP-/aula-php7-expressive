<?php

namespace CodeEmailMKT\Infrastructure\Service;

use Aura\Session\Segment;
use Aura\Session\Session;
use CodeEmailMKT\Domain\Service\FlashMessageServiceInterface;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class FlashMessageService implements FlashMessageServiceInterface
{
    /**
     * @var FlashMessenger
     */
    private $flashMessenger;

    /**
     * FlashMessageService constructor.
     * @param FlashMessenger $flashMessenger
     */
    public function __construct(FlashMessenger $flashMessenger)
    {

        $this->flashMessenger = $flashMessenger;
    }

    public function setNamespace($name = __NAMESPACE__)
    {
        $this->flashMessenger->setNamespace($name);

        // Retornar FlashMessage
        return $this;
    }

    public function setMessage($key, $value)
    {
        // Setar mensagem
        switch ($key) {
            case FlashMessenger::NAMESPACE_ERROR:
                $this->flashMessenger->addErrorMessage($value);
                break;
            case FlashMessenger::NAMESPACE_SUCCESS:
                $this->flashMessenger->addSuccessMessage($value);
                break;
            case FlashMessenger::NAMESPACE_INFO:
                $this->flashMessenger->addInfoMessage($value);
                break;
            case FlashMessenger::NAMESPACE_WARNING:
                $this->flashMessenger->addWarningMessage($value);
                break;
            default:
                $this->flashMessenger->addMessage($value);
                break;
        }

        // Retornar FlashMessage
        return $this;
    }

    public function getMessage($key)
    {

        // Retornar mensagem
        $result = [];
        switch ($key) {
            case FlashMessenger::NAMESPACE_ERROR:
                $result = $this->flashMessenger->getCurrentErrorMessages();
                break;
            case FlashMessenger::NAMESPACE_SUCCESS:
                $result = $this->flashMessenger->getCurrentSuccessMessages();
                break;
            case FlashMessenger::NAMESPACE_INFO:
                $result = $this->flashMessenger->getCurrentInfoMessages();
                break;
            case FlashMessenger::NAMESPACE_WARNING:
                $result = $this->flashMessenger->getCurrentWarningMessages();
                break;
            default:
                $result = $this->flashMessenger->getCurrentMessages();
                break;

        }
        return count($result) ? $result[0] : null;
    }
}