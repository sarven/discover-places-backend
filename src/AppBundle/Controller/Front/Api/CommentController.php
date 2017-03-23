<?php

namespace AppBundle\Controller\Front\Api;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Message;
use AppBundle\Form\Type\CommentType;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class CommentController
 * @package AppBundle\Controller\Front\Api
 */
class CommentController extends FOSRestController
{
    /**
     * @param Request $request
     * @param Message $message
     * @return Response
     *
     * @ParamConverter("message", class="AppBundle:Message", options={"id" = "message_id"})
     */
    public function createCommentAction(Request $request, Message $message)
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('photo.uploader')->upload($comment, $this->getParameter('comment_uploads_dir'));
            $this->get('video.uploader')->upload($comment, $this->getParameter('comment_uploads_dir'));

            $comment->setMessage($message);

            $comment = $this->get('resource.manager')->save($comment);

            $view = $this->view(null, 201);
            return $this->handleView($view);
        }

        $errors = $this->get('utils.form_error_parser')->getErrors($form);
        $view = $this->view($errors, 400);
        return $this->handleView($view);
    }
}