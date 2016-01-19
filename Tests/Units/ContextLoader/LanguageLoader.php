<?php

namespace Bigfoot\Bundle\ContextBundle\Tests\Units\ContextLoader;

use atoum\AtoumBundle\Test\Units;

/**
 * Class Context
 * @package Bigfoot\Bundle\ContextBundle\ContextLoader
 */
class LanguageLoader extends Units\Test
{
    public function testGetValue()
    {
        $loader = new \Bigfoot\Bundle\ContextBundle\ContextLoader\LanguageLoader($this->getMockContainer());

        $secondReturn = array(
            'label' => 'English',
            'value' => 'en',
        );
        $thirdReturn = array(
            'label' => 'French',
            'value' => 'fr',
        );

        $this
            ->variable($loader->getValue())
                ->isNull()
            ->array($loader->getValue())
                ->isEqualTo($secondReturn)
            ->array($loader->getValue())
                ->isEqualTo($thirdReturn);
    }

    private function getMockContainer()
    {
        $container = new \mock\Symfony\Component\DependencyInjection\Container;
        $this->calling($container)->getParameter = function ($name) {
            return array(
                'language' => array(
                    'loaders' => array(
                        'primary' => 'language_loader',
                    ),
                    'values' => array(
                        'fr' => array(
                            'label' => 'French',
                            'value' => 'fr',
                        ),
                        'en' => array(
                            'label' => 'English',
                            'value' => 'en',
                        ),
                        'default' => array(
                            'label' => 'Default',
                            'value' => 'default',
                        ),
                    ),
                    'default_value' => 'default',
                ),
            );
        };

        $request = new \mock\Symfony\Component\HttpFoundation\Request();
        $this->calling($this->getRequestStack())->getPathInfo[0] = '/admin';
        $this->calling($this->getRequestStack())->getPathInfo[1] = '/foo/bar';
        $this->calling($this->getRequestStack())->getLocale[0] = 'en';
        $this->calling($this->getRequestStack())->getLocale[2] = 'fr';

        $this->calling($container)->get = function () use ($this->getRequestStack()) {
            return $request;
        };

        return $container;
    }
}
