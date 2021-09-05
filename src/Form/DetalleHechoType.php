<?php

namespace App\Form;

use App\Entity\DetalleHecho;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class DetalleHechoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('victima')
            ->add('autor')
            ->add('mecanismo', ChoiceType::class, [
                'choices' => [
                    'Asfixia' => 'Asfixia',
                    'Golpes de puño' => 'Golpes de puño',
                    'Empujar al vacio' => 'Empujar al vacio',
                    'Sin datos' => 'Sin datos',
                    'Sin determinar' => 'Sin determinar',
                ],
                'preferred_choices' => ['Sin datos', 'Sin determinar'],
            ]);
            //->add('hechoNro')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DetalleHecho::class,
        ]);
    }
}
