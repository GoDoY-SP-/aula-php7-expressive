<?php

namespace CodeEmailMKT\Application\Action\Authentication;

use CodeEmailMKT\Application\Form\HttpMethodElement;
use CodeEmailMKT\Application\Form\LoginForm;
use CodeEmailMKT\Domain\Service\AuthenticationServiceInterface;
use CodeEmailMKT\Domain\Service\FlashMessageServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;

class LoginPageAction
{

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var null|Template\TemplateRendererInterface
     */
    private $template;

    /**
     * @var LoginForm
     */
    private $form;

    /**
     * @var AuthenticationServiceInterface
     */
    private $authService;


    /**
     * TestePageAction constructor.
     * @param RouterInterface                         $router
     * @param Template\TemplateRendererInterface|null $template
     * @param LoginForm                               $form
     * @param AuthenticationServiceInterface                 $authService
     * @internal param CustomerRepositoryInterface $repository
     * @internal param EntityManager $entityManager
     */
    public function __construct(
        RouterInterface $router,
        Template\TemplateRendererInterface $template = null,
        LoginForm $form = null,
        AuthenticationServiceInterface $authService = null
    ) {
        $this->router = $router;
        $this->template = $template;
        $this->form = $form;
        $this->authService = $authService;
    }

    /**
     * Listagem
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     * @return HtmlResponse
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        // Method Spof
        $this->form->add(new HttpMethodElement('POST'));

        // FlashMessage
        $flashMessages[FlashMessageServiceInterface::NAMESPACE_SUCCESS] = $request->getAttribute('flashMessage')->getMessage(FlashMessageServiceInterface::NAMESPACE_SUCCESS);
        $flashMessages[FlashMessageServiceInterface::NAMESPACE_ERROR] = $request->getAttribute('flashMessage')->getMessage(FlashMessageServiceInterface::NAMESPACE_ERROR);

        // Verificar se foi passado $_POST
        if ($request->getMethod() == 'POST') {

            // Carregar dados do formulário
            $data = $request->getParsedBody();

            // Setar dados no formulário
            $this->form->setData($data);

            // Validar formulário
            if ($this->form->isValid()) {
                // Usuário
                $user = $this->form->getData();

                if ($this->authService->authenticate($user['email'], $user['passwordPlain'])) {
                    // Redirecionar para listagem
                    $uri = $this->router->generateUri('customer.list');
                    return new RedirectResponse($uri);
                }

                /** @var FlashMessageServiceInterface $flashMessage */
                $flashMessage = $request->getAttribute('flashMessage');

                // Setar mensagem de sucesso
                $flashMessage->setMessage(FlashMessageServiceInterface::NAMESPACE_ERROR, 'Dados de acesso inválidos!');

                // Redirecionar para listagem
                $uri = $this->router->generateUri('authentication.login');
                return new RedirectResponse($uri);
            }
        }

        $data = [
            'flashMessages' => $flashMessages,
            'headerTitle' => 'Autenticação',
            'headerDescription' => 'Login',
            'contentTitle' => 'Login',
            'myForm' => $this->form,
        ];

        return new HtmlResponse($this->template->render('app::authentication/login', $data));
    }
}
