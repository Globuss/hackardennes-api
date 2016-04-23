<?php

namespace AppBundle\Form;

use AppBundle\Entity\Path;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Yohan Giarelli <yohan@un-zero-un.fr>
 */
class PathType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(
                [
                    'data_class' => Path::class,
                ]
            );
    }
}
