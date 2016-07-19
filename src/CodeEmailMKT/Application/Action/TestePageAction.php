<?php

namespace CodeEmailMKT\Application\Action;

use CodeEmailMKT\Domain\Entity\CustomerEntity;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;

class TestePageAction
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

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        // Cadastrar clientes
        $costumer = new CustomerEntity();
        $costumer->setName('Teste nome Random #' . rand(0, 100));
        $costumer->setEmail('teste@email.com');

        // Persistir
        $this->repository->create($costumer);

        // Carregar clientes para view
        $costumers = $this->repository->findAll();

        $data = [
            'headerTitle' => 'Aula PHP7',
            'headerDescription' => 'CRUD com DDD',
            'contentTitle' => 'Cadastro de Clientes',
            'clientes' => $costumers
        ];

        return new HtmlResponse($this->template->render('app::teste', $data));
    }
}
