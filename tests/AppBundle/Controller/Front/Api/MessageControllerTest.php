<?php

namespace Test\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MessageControllerTest
 * @package Test\AppBundle\Controller
 */
class MessageControllerTest extends WebTestCase
{
    public function testGetMessages()
    {
        $client = self::createClient();

        $client->request('GET', '/front/api/message/list/50.0000002/50.0000002');
        $data = json_decode($client->getResponse()->getContent());
        $this->assertGreaterThan(0, count($data->data));

        $client->request('GET', '/front/api/message/list/50.0424706/19.9518421');
        $data = json_decode($client->getResponse()->getContent());
        $this->assertEquals(1, count($data->data));

        $client->request('GET', '/front/api/message/list/43.0456978/13.056275');
        $data = json_decode($client->getResponse()->getContent());
        $this->assertEquals(1, count($data->data));

        $client->request('GET', '/front/api/message/list/43.047051/13.0846577');
        $data = json_decode($client->getResponse()->getContent());
        $this->assertEquals(0, count($data->data));
    }

    public function testCreateMessage()
    {
        $response = $this->createMessage();
        $this->assertEquals(201, $response->getStatusCode());

        $response = $this->createMessage();
        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testGetLatestMessages()
    {
        $client = self::createClient();

        $client->request('GET', '/front/api/message/coordinates/list');
        $data = json_decode($client->getResponse()->getContent());
        $this->assertGreaterThan(0, count($data->data));
    }

    /**
     * @return Response
     */
    protected function createMessage()
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
        ]);

        return $client->getResponse();
    }
}