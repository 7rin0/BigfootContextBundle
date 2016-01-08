<?php

namespace Bigfoot\Bundle\ContextBundle;

use Bigfoot\Bundle\ContextBundle\DependencyInjection\Compiler\FormTypeCompilerPass;
use Bigfoot\Bundle\ContextBundle\DependencyInjection\Compiler\LoaderCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BigfootContextBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new LoaderCompilerPass());
    }
}
