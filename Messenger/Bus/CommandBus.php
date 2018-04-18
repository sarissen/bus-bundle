<?php

declare(strict_types=1);


namespace AFS\BusBundle\Messenger\Bus;


use Symfony\Component\Messenger\MessageBus;

class CommandBus extends MessageBus implements CommandBusInterface
{

}