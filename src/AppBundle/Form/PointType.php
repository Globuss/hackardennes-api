<?php

namespace AppBundle\Form;

use AppBundle\Entity\Point;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Yohan Giarelli <yohan@un-zero-un.fr>
 */
class PointType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('major')
            ->add('minor')
            ->add('latitude')
            ->add('longitude')
            ->add('name')
            ->add('description');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(
                [
                    'data_class' => Point::class,
                ]
            );
    }
}
