<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Range;

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
                'required' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'video/mp4',
                            'video/x-flv',
                            'application/x-mpegURL',
                            'video/MP2T',
                            'video/3gpp',
                            'video/quicktime',
                            'video/x-msvideo',
                            'video/x-ms-wmv'
                        ]
                    ])
                ]
            ])
            ->add('latitude', NumberType::class, [
                'required' => true,
                'constraints' => [
                    new Range([
                        'min' => -90,
                        'minMessage' => 'latitude.min_message',
                        'max' => 90,
                        'maxMessage' => 'latitude.max_message'
                    ])
                ]
            ])
            ->add('longitude', NumberType::class, [
                'required' => true,
                'constraints' => [
                    new Range([
                        'min' => -180,
                        'minMessage' => 'longitude.min_message',
                        'max' => 180,
                        'maxMessage' => 'longitude.max_message'
                    ])
                ]
            ])
            ->add('scope', ChoiceType::class, [
                'required' => true,
                'choices' => Message::AVAILABLE_SCOPES,
                'invalid_message' => 'scope.invalid'
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
            'csrf_protection' => false
        ]);
    }
}

