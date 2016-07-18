<?php

namespace CodeEmailMKT\Action;

use CodeEmailMKT\Entity\ClienteEntity;
use CodeEmailMKT\Entity\EnderecoEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\Twig\TwigRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;

class TestePageAction
{
    /**
     * @var null|Template\TemplateRendererInterface
     */
    private $template;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * TestePageAction constructor.
     * @param EntityManager                           $entityManager
     * @param Template\TemplateRendererInterface|null $template
     */
    public function __construct(EntityManager $entityManager, Template\TemplateRendererInterface $template = null)
    {
        $this->entityManager = $entityManager;
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        // Cadastrar endereços
        $endereco1 = new EnderecoEntity();
        $endereco1->setCep(rand(10000000, 99999999));
        $endereco1->setLogradouro('Teste de logradouro');
        $endereco1->setCidade('Teste de cidade');
        $endereco1->setEstado('SP');

        $endereco2 = new EnderecoEntity();
        $endereco2->setCep(rand(10000000, 99999999));
        $endereco2->setLogradouro('Teste de logradouro');
        $endereco2->setCidade('Teste de cidade');
        $endereco2->setEstado('SP');

        // Gravar DB
        $this->entityManager->persist($endereco1);
        $this->entityManager->persist($endereco2);
        $this->entityManager->flush();

        // Criar collection para cliente
        $enderecos = new ArrayCollection();
        $enderecos->add($endereco1);
        $enderecos->add($endereco2);

        // Cadastrar clientes
        $cliente = new ClienteEntity();
        $cliente->setNome('Teste nome Random #' . rand(0, 100));
        $cliente->setEmail('teste@email.com');
        $cliente->setCpf('12345678912');
        $cliente->setEnderecos($enderecos);

        $this->entityManager->persist($cliente);
        $this->entityManager->flush();

        // Carregar clientes para view
        $clientes = $this->entityManager->getRepository(ClienteEntity::class)->findAll();

        $data = [
            'pageContent' => 'Minha primeira aplicação',
            'clientes' => $clientes
        ];

        return new HtmlResponse($this->template->render('app::teste', $data));
    }
}
