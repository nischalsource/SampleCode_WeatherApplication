<?php

namespace AppBundle\Services\Base;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\DependencyInjection\Container;

abstract class ServiceBase
{

    /** @var EntityManager */
    protected $em;

    /** @var EntityRepository */
    protected $repository;

    /** @var Container */
    protected $container;

    /** @var Request */
    protected $request;

    protected $location;

    /**
     * @var object
     */
    protected $logger;

    public function __construct(EntityManagerInterface $entityManager, Container $container, RequestStack $requestStack)
    {
        $this->container = $container;
        $this->request = $requestStack->getCurrentRequest();
        $this->em = $entityManager;
        $this->logger = $this->container->get('weather.logger');

    }
    
}