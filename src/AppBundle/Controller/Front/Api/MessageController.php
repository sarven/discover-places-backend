<?php

namespace AppBundle\Controller\Front\Api;

use AppBundle\Entity\Message;
use AppBundle\Form\Type\MessageType;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\View;

/**
 * Class MessageController
 * @package AppBundle\Controller\Front\Api
 */
class MessageController extends FOSRestController
{
    /**
     * @param float $lat
     * @param float $long
     * @return Response
     */
    public function getMessagesAction(float $lat, float $long)
    {
        $messageRepository = $this->getDoctrine()->getRepository('AppBundle:Message');
        $messages = $messageRepository->findByCoordinates($lat, $long);

        $view = $this->view([
            'data' => $messages
        ],
        200);
        return $this->handleView($view);
    }

    /**
     * @param Request $request
     * @return Response
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

            $view = $this->view(null, 201);
            return $this->handleView($view);
        }

        $errors = $this->get('utils.form_error_parser')->getErrors($form);
        $view = $this->view($errors, 400);
        return $this->handleView($view);
    }

    /**
     * @return Response
     */
    public function getLatestMessagesCoordinatesAction()
    {
        $messageRepository = $this->getDoctrine()->getRepository('AppBundle:Message');
        $messages = $messageRepository->getLatestMessages(1000);

        $view = $this->view([
            'data' => $messages
        ], 200);
        $view->setContext((new Context())->setGroups(['coordinates']));
        return $this->handleView($view);
    }
}