<?php

namespace Bigfoot\Bundle\ContextBundle\Form\Extension;

use Bigfoot\Bundle\ContextBundle\Entity\ContextRepository;
use Symfony\Bridge\Doctrine\Form\ChoiceList\ORMQueryBuilderLoader;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContextExtension extends AbstractTypeExtension
{
    /**
     * @var ContextRepository
     */
    protected $contextRepository;

    /**
     * Construct ContextExtension
     */
    public function __construct(ContextRepository $contextRepository)
    {
        $this->contextRepository = $contextRepository;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $loader = function (Options $options) {
            if ($options['contextualize'] === true || $options['query_builder'] !== null) {
                $queryBuilder = ($options['contextualize'] === true) ? $this->contextRepository->createContextQueryBuilder($options['class']) : $options['query_builder'];

                return new ORMQueryBuilderLoader(
                    $queryBuilder,
                    $options['em'],
                    $options['class']
                );
            }

            return null;
        };

        $resolver->setDefined(array('contextualize'));
    }

    public function getExtendedType()
    {
        return 'entity';
    }
}