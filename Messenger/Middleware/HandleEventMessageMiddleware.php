<?php

declare(strict_types=1);


namespace AFS\BusBundle\Messenger\Middleware;


use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\Locator\HandlerLocatorInterface;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;

class HandleEventMessageMiddleware implements MiddlewareInterface
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
        try {
            $handler = $this->messageHandlerResolver->resolve($message);
        }catch (NoHandlerForMessageException $exception){
            $next($message);

            return null;
        }

        $result = $handler($message);

        $next($message);

        return $result;
    }

}