<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Message;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadUserData
 * @package AppBundle\DataFixtures\ORM
 */
class LoadUserData implements FixtureInterface
{
    const DATA = [
        [
            'content' => 'test',
            'lat' => 50,
            'long' => 50,
            'scope' => 1
        ],
        [
            'content' => 'test2',
            'lat' => 50.0444706,
            'long' => 19.9573029,
            'scope' => 10
        ],
        [
            'content' => 'test2',
            'lat' => 43.0444706,
            'long' => 12.9573029,
            'scope' => 10
        ]
    ];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::DATA as $dataMessage) {
            $manager->persist($this->createMessage($dataMessage));
        }
        $manager->flush();
    }

    /**
     * @param array $data
     * @return Message
     */
    public function createMessage(array $data)
    {
        return (new Message())
            ->setContent($data['content'])
            ->setLatitude($data['lat'])
            ->setLongitude($data['long'])
            ->setScope($data['scope'])
            ->setIp('127.0.0.1')
        ;
    }
}