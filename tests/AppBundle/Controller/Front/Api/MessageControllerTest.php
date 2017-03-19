<?php

namespace Test\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class MessageControllerTest
 * @package Test\AppBundle\Controller
 */
class MessageControllerTest extends WebTestCase
{
    public function testGetMessages()
    {
        $client = self::createClient();

        $client->request('GET', '/front/api/message/list');

        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}