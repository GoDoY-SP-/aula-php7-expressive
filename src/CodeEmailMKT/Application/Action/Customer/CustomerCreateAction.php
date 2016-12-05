<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Application\Form\CustomerForm;
use CodeEmailMKT\Application\Form\HttpMethodElement;
use CodeEmailMKT\Domain\Entity\CustomerEntity;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use CodeEmailMKT\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template;

class CustomerCreateAction
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
        // Form
        $form = new CustomerForm();
        $form->add(new HttpMethodElement('POST'));

        // Verificar se foi passado $_POST
        if ($request->getMethod() == 'POST') {
            /** @var FlashMessageInterface $flashMessage */
            $flashMessage = $request->getAttribute('flashMessage');

            // Carregar dados do formulário
            $data = $request->getParsedBody();

            // Setar dados no formulário
            $form->setData($data);

            // Validar formulário
            if ($form->isValid()) {
                // Hidratar entidade
                $entity = $form->getData();

                // Persistir
                $this->repository->create($entity);

                // Setar mensagem de sucesso
                $flashMessage->setMessage(FlashMessageInterface::NAMESPACE_SUCCESS, 'Registro inserido com sucesso!');

                // Redirecionar para listagem
                return new RedirectResponse('/admin/customers');
            }
        }

        $data = [
            'headerTitle' => 'Contatos',
            'headerDescription' => 'Cadastro',
            'contentTitle' => 'Novo Contato',
            'myForm' => $form,
        ];

        return new HtmlResponse($this->template->render('app::customer/create', $data));
    }
}
