<?php
namespace CodeEmailMKT\Infrastructure\Service;

use Aura\Session\Session;
use CodeEmailMKT\Domain\Service\AuthenticationServiceInterface;
use Zend\Authentication\Adapter\ValidatableAdapterInterface;

class AuthenticationService implements AuthenticationServiceInterface
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var \Zend\Authentication\AuthenticationService
     */
    private $authService;

    /**
     * AuthenticationService constructor.
     * @param Session                                    $session
     * @param \Zend\Authentication\AuthenticationService $authService
     */
    public function __construct(
        Session $session,
        \Zend\Authentication\AuthenticationService $authService
    ) {
        $this->session = $session;
        $this->authService = $authService;
    }

    public function authenticate($login, $password)
    {
        // Instanciar adaptador
        /** @var ValidatableAdapterInterface $adapter */
        $adapter = $this->authService->getAdapter();

        // Setar credenciais
        $adapter->setIdentity($login);
        $adapter->setCredential($password);

        // Autenticar
        $result = $this->authService->authenticate();

        return $result->isValid();
    }

    public function isAuth()
    {
        return $this->getUser() != null;
    }

    public function getUser()
    {
        return $this->authService->getIdentity();
    }

    public function destroy()
    {
        // Logout
        $this->authService->clearIdentity();
    }
}