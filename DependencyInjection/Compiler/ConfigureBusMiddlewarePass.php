<?php

declare(strict_types=1);


namespace AFS\BusBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ConfigureBusMiddlewarePass implements CompilerPassInterface
{

    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        $loggingMiddleware = $container->getDefinition('messenger.middleware.logging');
        $loggingMiddleware->addTag('messenger.commandbus_middleware', [ 'priority' => 10 ]);
        $loggingMiddleware->addTag('messenger.eventbus_middleware', [ 'priority' => 10 ]);

        $sendMessageMiddleware = $container->getDefinition('messenger.asynchronous.middleware.send_message_to_producer');
        $sendMessageMiddleware->addTag('messenger.commandbus_middleware', [ 'priority' => -5 ]);
        $sendMessageMiddleware->addTag('messenger.eventbus_middleware', [ 'priority' => -5 ]);

        $dataCollectorMiddleware = $container->getDefinition('data_collector.messenger');
        $dataCollectorMiddleware->addTag('messenger.commandbus_middleware');
        $dataCollectorMiddleware->addTag('messenger.eventbus_middleware');
    }

}