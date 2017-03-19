<?php

namespace AppBundle\FormType;

use AppBundle\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

/**
 * Class MessageType
 * @package AppBundle\FormType
 */
class MessageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextType::class, [
                'required' => false
            ])
            ->add('photo', FileType::class, [
                'required' => false,
                'constraints' => [
                    new Image()
                ]
            ])
            ->add('video', FileType::class, [
                'required' => false // TODO: Video constraint
            ])
            ->add('latitude', NumberType::class, [
                'required' => true // TODO: constraints
            ])
            ->add('longitude', NumberType::class, [
                'required' => true // TODO: constraints
            ])
            ->add('scope', ChoiceType::class, [
                'required' => true,
                'choices' => Message::AVAILABLE_SCOPES
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => Message::class
        ]);
    }
}

