<?php

namespace Bigfoot\Bundle\ContextBundle\Loader;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class LanguageBackLoader
 *
 * @package Bigfoot\Bundle\ContextBundle\Loader
 */
class LanguageBackLoader extends AbstractLoader
{
    /**
     * @return string
     */
    public function getContextName()
    {
        return 'language_back';
    }

    /**
     * @return string
     */
    public function getValue()
    {
        $requestStack = new RequestStack();
        if($requestStack->getCurrentRequest()) {
            $getLocale = $requestStack->getCurrentRequest()->getLocale();
            return $this->getValueForKey($getLocale);
        }
    }
}
