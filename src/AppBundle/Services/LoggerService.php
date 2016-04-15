<?php

namespace AppBundle\Services;


use Symfony\Component\DependencyInjection\Container;

class LoggerService 
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
        $this->logger = $this->container->get('logger');
    }

    public function log($message, array $params = [])
    {
        $this->logger->info($message, $params);
    }

    public function logParams($message, array $params = [])
    {
        $params = ['params' => $params];
        $this->logger->info($message, $params);
    }

    public function debug($message, array $params = [])
    {
        $this->logger->debug($message, $params);
    }

    public function debugParams($message, array $params = [])
    {
        $params = ['params' => $params];
        $this->logger->debug($message, $params);
    }

    public function error($message, array $params = [])
    {
        $this->logger->error($message, $params);
    }

    public function errorParams($message, array $params = [])
    {
        $params = ['params' => $params];
        $this->logger->error($message, $params);
    }

    public function warning($message, array $params = [])
    {
        $this->logger->warning($message, $params);
    }

    public function warningParams($message, array $params = [])
    {
        $params = ['params' => $params];
        $this->logger->warning($message, $params);
    }

    public function notice($message, array $params = [])
    {
        $this->logger->notice($message, $params);
    }

    public function noticeParams($message, array $params = [])
    {
        $params = ['params' => $params];
        $this->logger->notice($message, $params);
    }
}