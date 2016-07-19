<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Domain\Entity\CustomerEntity;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use CodeEmailMKT\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;

class CustomerListAction
{

    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;
    /**
     * @var null|Template\TemplateRendererInterface
     */
    private $template;


    /**
     * TestePageAction constructor.
     * @param EntityManager                           $entityManager
     * @param Template\TemplateRendererInterface|null $template
     */
    public function __construct(
        CustomerRepositoryInterface $repository,
        Template\TemplateRendererInterface $template = null
    ) {
        $this->repository = $repository;
        $this->template = $template;
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
        // FlashMessage
        $flashMessages[FlashMessageInterface::NAMESPACE_SUCCESS] = $request->getAttribute('flashMessage')->getMessage(FlashMessageInterface::NAMESPACE_SUCCESS);

        // Carregar clientes para view
        $costumers = $this->repository->findAll();

        $data = [
            'flashMessages' => $flashMessages,
            'headerTitle' => 'Contatos',
            'headerDescription' => 'Listagem',
            'customers' => $costumers
        ];

        return new HtmlResponse($this->template->render('app::customer/list', $data));
    }
}
