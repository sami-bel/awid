<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',null, array(
                'label' => false,

                'attr' =>[
                    'placeholder'=> 'Titre'
                ]))
            ->add('content',null, array(
                'label' => false,

                'attr' =>[
                    'placeholder'=> 'Message'
                ]))
            ->add('Envoyer', SubmitType::class, array())
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
