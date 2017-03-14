<?php

namespace AppBundle\Controller\Front\Api;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Message;
use FOS\RestBundle\Controller\FOSRestController;

/**
 * Class MessageController
 * @package AppBundle\Controller\Front\Api
 */
class MessageController extends FOSRestController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction()
    {
        $view = $this->view('test', 200);

        return $this->handleView($view);
    }
}