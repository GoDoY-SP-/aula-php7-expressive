<?php

namespace CodeEmailMKT\Infrastructure\Service;

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
            case FlashMessageServiceInterface::NAMESPACE_ERROR:
                $this->flashMessenger->addErrorMessage($value);
                break;
            case FlashMessageServiceInterface::NAMESPACE_SUCCESS:
                $this->flashMessenger->addSuccessMessage($value);
                break;
            case FlashMessageServiceInterface::NAMESPACE_INFO:
                $this->flashMessenger->addInfoMessage($value);
                break;
            case FlashMessageServiceInterface::NAMESPACE_WARNING:
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
            case FlashMessageServiceInterface::NAMESPACE_ERROR:
                $result = $this->flashMessenger->getCurrentErrorMessages();
                break;
            case FlashMessageServiceInterface::NAMESPACE_SUCCESS:
                $result = $this->flashMessenger->getCurrentSuccessMessages();
                break;
            case FlashMessageServiceInterface::NAMESPACE_INFO:
                $result = $this->flashMessenger->getCurrentInfoMessages();
                break;
            case FlashMessageServiceInterface::NAMESPACE_WARNING:
                $result = $this->flashMessenger->getCurrentWarningMessages();
                break;
            default:
                $result = $this->flashMessenger->getCurrentMessages();
                break;

        }
        return count($result) ? $result[0] : null;
    }
}