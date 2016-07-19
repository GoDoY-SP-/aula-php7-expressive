<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use CodeEmailMKT\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template;

class CustomerDeleteAction
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
        // Carregar entidade
        $id = $request->getAttribute('id');
        $customer = $this->repository->find($id);

        // Verificar se foi passado DELETE (spoof)
        if ($request->getMethod() == 'DELETE') {
            /** @var FlashMessageInterface $flashMessage */
            $flashMessage = $request->getAttribute('flashMessage');

            // Apagar
            $this->repository->remove($customer);

            // Setar mensagem de sucesso
            $flashMessage->setMessage(FlashMessageInterface::NAMESPACE_SUCCESS, 'Registro apagado com sucesso!');

            // Redirecionar para listagem
            return new RedirectResponse('/admin/customers');
        }

        $data = [
            'headerTitle' => 'Contatos',
            'headerDescription' => 'Exclusão',
            'contentTitle' => 'Apagar Contato',
            'customer' => $customer,
        ];

        return new HtmlResponse($this->template->render('app::customer/delete', $data));
    }
}
