<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Domain\Entity\CustomerEntity;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
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
        // Verificar se foi passado $_POST
        if ($request->getMethod() == 'POST') {
            // Carregar dados do formulário
            $data = $request->getParsedBody();

            // Hidratar entidade
            $entity = new CustomerEntity();
            $entity
                ->setName($data['name'])
                ->setEmail($data['email']);

            // Persistir
            $this->repository->create($entity);
        }

        $data = [
            'headerTitle' => 'Contatos',
            'headerDescription' => 'Cadastro',
            'contentTitle' => 'Novo Contato',
        ];

        return new HtmlResponse($this->template->render('app::customer/create', $data));
    }
}
