<?php

namespace CodeEmailMKT\Application\Middleware;

use CodeEmailMKT\Domain\Service\BootstrapServiceInterface;
use CodeEmailMKT\Domain\Service\FlashMessageServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BootstrapMiddleware
{
    private $bootstrap;
    /**
     * @var FlashMessageServiceInterface
     */
    private $flashMessage;

    public function __construct(BootstrapServiceInterface $bootstrap, FlashMessageServiceInterface $flashMessage)
    {
        $this->bootstrap = $bootstrap;
        $this->flashMessage = $flashMessage;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $this->bootstrap->create();
        $request = $request->withAttribute('flashMessage', $this->flashMessage);
        $request = $this->spoofingMethod($request);

        return $next($request, $response);
    }

    protected function spoofingMethod(ServerRequestInterface $request)
    {
        $data = $request->getParsedBody();
        $method = (isset($data['_method'])) ? strtoupper($data['_method']) : '';
        if (in_array($method, ['PUT', 'DELETE'])) {
            $request = $request->withMethod($method);
        }

        return $request;
    }
}
