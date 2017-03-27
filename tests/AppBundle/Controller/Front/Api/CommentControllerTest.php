<?php

namespace Test\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class CommentControllerTest
 * @package Test\AppBundle\Controller
 */
class CommentControllerTest extends WebTestCase
{
    public function testCreateComment()
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
            '/front/api/message/1/comment', [
                'comment' => [
                    'content' => 'test'
                ]
            ], [
                'comment' => [
                    'photo' => $photo
                ]
        ]
        );

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }
}