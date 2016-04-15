<?php

namespace AppBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class ExceptionListener
{

    /**
     * teplating service
     * @var
     */
    private $templating;

    /**
     * Kernel object
     * @var
     */
    private $kernel;

    /**
     * @param $templating
     */
    public function setTemplating($templating)
    {
        $this->templating = $templating;
    }

    /**
     * @param $kernel
     */
    public function setKernel($kernel)
    {
        $this->kernel = $kernel;
    }


    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        $response = new Response();
        $env = $this->kernel->getEnvironment();

        $response->setContent(
            $this->templating->render(
                'Exception/exception.html.twig',
                array(
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'trace' => $exception->getTraceAsString(),
                    'env' => $env,
                )
            )
        );
        $event->setResponse($response);
    }
}
