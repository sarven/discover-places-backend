<?php

namespace Test\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

    public function testCreateMessage()
    {
        $client = self::createClient();
        $fixturesPath = $client->getContainer()->getParameter('kernel.root_dir').'/../tests/AppBundle/fixtures/';
        copy($fixturesPath.'img.jpg', $fixturesPath.'test.jpg');

        $photo = new UploadedFile(
            $fixturesPath.'test.jpg',
            'test.jpg'
        );

        $client->request(
            'POST',
            '/front/api/message', [
                'message' => [
                    'content' => 'test',
                    'latitude' => 50,
                    'longitude' => 50,
                    'scope' => 1,
                ]
            ], [
                'message' => [
                    'photo' => $photo
                ]
            ]
        );

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }
}