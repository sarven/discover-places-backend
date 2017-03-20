<?php

namespace AppBundle\Utils;

use Symfony\Component\Form\FormInterface;

/**
 * Class FormErrorParser
 * @package AppBundle\Utils
 */
class FormErrorParser
{
    /**
     * @param FormInterface $form
     * @return array
     */
    public function getErrors(FormInterface $form)
    {
        $errorMessages = [];

        foreach($form->getErrors(true) as $error) {
            $errorMessages[] = $error->getMessage();
        }

        return $errorMessages;
    }
}