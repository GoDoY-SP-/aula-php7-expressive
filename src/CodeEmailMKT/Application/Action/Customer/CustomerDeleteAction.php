<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Application\Form\CustomerForm;
use CodeEmailMKT\Application\Form\HttpMethodElement;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use CodeEmailMKT\Domain\Service\FlashMessageServiceInterface;
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
     * @var CustomerForm
     */
    private $form;


    /**
     * TestePageAction constructor.
     * @param EntityManager                           $entityManager
     * @param Template\TemplateRendererInterface|null $template
     */
    public function __construct(
        CustomerRepositoryInterface $repository,
        Template\TemplateRendererInterface $template = null,
        CustomerForm $form = null
    ) {
        $this->repository = $repository;
        $this->template = $template;
        $this->form = $form;
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

        // Method Spof
        $this->form->add(new HttpMethodElement('DELETE'));

        // Setando dados
        $this->form->bind($customer);

        // Verificar se foi passado DELETE (spoof)
        if ($request->getMethod() == 'DELETE') {
            /** @var FlashMessageServiceInterface $flashMessage */
            $flashMessage = $request->getAttribute('flashMessage');

            // Apagar
            $this->repository->remove($customer);

            // Setar mensagem de sucesso
            $flashMessage->setMessage(FlashMessageServiceInterface::NAMESPACE_SUCCESS, 'Registro apagado com sucesso!');

            // Redirecionar para listagem
            return new RedirectResponse('/admin/customers');
        }

        $data = [
            'headerTitle' => 'Contatos',
            'headerDescription' => 'Exclusão',
            'contentTitle' => 'Apagar Contato',
            'customer' => $customer,
            'myForm' => $this->form,
        ];

        return new HtmlResponse($this->template->render('app::customer/delete', $data));
    }
}
