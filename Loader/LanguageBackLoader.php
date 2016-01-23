<?php

namespace Bigfoot\Bundle\ContextBundle\Loader;

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
        if($this->getRequestStack()) {
            $getLocale = $this->getRequestStack()->getLocale();
            return $this->getValueForKey($getLocale);
        }
    }
}
