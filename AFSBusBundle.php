<?php

declare(strict_types=1);


namespace AFS\BusBundle;


use AFS\BusBundle\DependencyInjection\Compiler\CreateBussesPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AFSBusBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CreateBussesPass());
    }

}