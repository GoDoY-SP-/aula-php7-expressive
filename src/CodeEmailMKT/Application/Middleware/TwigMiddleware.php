<?php

namespace CodeEmailMKT\Application\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\View\HelperPluginManager;

class TwigMiddleware
{
    /**
     * @var \Twig_Environment
     */
    private $twigEnvironment;
    /**
     * @var HelperPluginManager
     */
    private $helperPluginManager;

    public function __construct(\Twig_Environment $twigEnvironment, HelperPluginManager $helperPluginManager)
    {

        $this->twigEnvironment = $twigEnvironment;
        $this->helperPluginManager = $helperPluginManager;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $helperPluginManager = $this->helperPluginManager;
        $this->twigEnvironment->registerUndefinedFunctionCallback(function ($name) use ($helperPluginManager) {
            if (!$helperPluginManager->has($name)) {
                return false;
            }

            $callable = [$helperPluginManager->get($name), '__invoke'];
            $options = ['is_safe' => ['html']];

            return new \Twig_SimpleFunction(null, $callable, $options);
        });

        return $next($request, $response);
    }

}
