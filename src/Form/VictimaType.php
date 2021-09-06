<?php

namespace App\Form;

use App\Entity\Victima;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VictimaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellido')
            ->add('tipo_documento', ChoiceType::class, [
                'choices' => [
                    'DNI' => 'DNI',
                    'LC' => 'LC',
                    'PASAPORTE' => 'PASAPORTE',
                    'Sin datos' => 'Sin datos',
                    'Sin determinar' => 'Sin determinar',
                ],
                'preferred_choices' => ['Sin datos', 'Sin determinar'],
            ])
            ->add('nro_documento')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Victima::class,
        ]);
    }
}
