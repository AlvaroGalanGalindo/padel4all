<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PistaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user')
            ->add('nombre')
            ->add('propietario')
            ->add('direccion', 'text', array('label' => 'Dirección'))
            ->add('localidad')
            ->add('provincia')
            ->add('telefono', 'text', array('label' => 'Teléfono'))
            ->add('horario')
            ->add('precio')
            ->add('tipo')
            ->add('pared')
            ->add('cubierta')
            ->add('climatizada')
            ->add('puertas', 'checkbox', array('label' => 'Permite salida por puertas'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Pista'
        ));
    }
}
