<?php

namespace AppBundle\Controller\Front\Api;

use AppBundle\Entity\Message;
use AppBundle\Form\Type\MessageType;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MessageController
 * @package AppBundle\Controller\Front\Api
 */
class MessageController extends FOSRestController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getMessagesAction()
    {
        $view = $this->view('test', 200);
        return $this->handleView($view);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createMessageAction(Request $request)
    {
        $message = new Message();

        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('photo.uploader')->upload($message, $this->getParameter('message_uploads_dir'));
            $this->get('video.uploader')->upload($message, $this->getParameter('message_uploads_dir'));

            $this->get('resource.manager')->save($message);

            $view = $this->view($message, 201);
            return $this->handleView($view);
        }

        $errors = $this->get('utils.form_error_parser')->getErrors($form);
        $view = $this->view($errors, 400);
        return $this->handleView($view);
    }
}