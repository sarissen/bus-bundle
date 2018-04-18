<?php

declare(strict_types=1);


namespace AFS\BusBundle\Messenger\Exception;


use Symfony\Component\Messenger\Exception\ExceptionInterface;

class ChainHandlerForCommandException extends \LogicException implements ExceptionInterface
{

}