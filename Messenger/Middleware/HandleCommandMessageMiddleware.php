<?php

declare(strict_types=1);


namespace AFS\BusBundle\Messenger\Middleware;


use AFS\BusBundle\Messenger\Exception\ChainHandlerForCommandException;
use Symfony\Component\Messenger\Handler\ChainHandler;
use Symfony\Component\Messenger\Handler\Locator\HandlerLocatorInterface;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;

class HandleCommandMessageMiddleware implements MiddlewareInterface
{

    private $messageHandlerResolver;

    public function __construct(HandlerLocatorInterface $messageHandlerResolver)
    {
        $this->messageHandlerResolver = $messageHandlerResolver;
    }

    /**
     * {@inheritdoc}
     */
    public function handle($message, callable $next)
    {
        $handler = $this->messageHandlerResolver->resolve($message);

        if($handler instanceof ChainHandler){
            throw new ChainHandlerForCommandException(sprintf('More than 1 handler for message "%s".', get_class($message)));
        }

        $result = $handler($message);

        $next($message);

        return $result;
    }

}