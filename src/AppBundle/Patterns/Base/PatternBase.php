<?php

namespace AppBundle\Patterns\Base;

use Symfony\Component\DependencyInjection\Container;

abstract class PatternBase
{
    /** @var Container */
    protected $container;

    /**
     * @var object
     */
    protected $logger;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->logger = $this->container->get('weather.logger');
    }

}