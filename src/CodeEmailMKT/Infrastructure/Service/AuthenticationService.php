<?php
namespace CodeEmailMKT\Infrastructure\Service;

use CodeEmailMKT\Domain\Service\AuthenticationServiceInterface;
use Zend\Authentication\Adapter\ValidatableAdapterInterface;

class AuthenticationService implements AuthenticationServiceInterface
{
    /**
     * @var \Zend\Authentication\AuthenticationService
     */
    private $authService;

    /**
     * AuthenticationService constructor.
     * @param \Zend\Authentication\AuthenticationService $authService
     */
    public function __construct(
        \Zend\Authentication\AuthenticationService $authService
    ) {
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
        // Verificar usuário autenticado
        return $this->getUser() != null;
    }

    public function getUser()
    {
        // Usuário autenticado
        return $this->authService->getIdentity();
    }

    public function destroy()
    {
        // Logout
        $this->authService->clearIdentity();
    }
}