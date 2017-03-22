<?php

namespace AppBundle\Manager;

use AppBundle\Entity\ResourceInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ResourceManager
 * @package AppBundle\Manager
 */
class ResourceManager implements ResourceManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * ResourceManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param ResourceInterface $resource
     * @return ResourceInterface
     */
    public function save(ResourceInterface $resource)
    {
        $this->em->persist($resource);
        $this->em->flush();

        return $resource;
    }

    /**
     * @param ResourceInterface $resource
     * @return ResourceInterface
     */
    public function delete(ResourceInterface $resource)
    {
        $this->em->remove($resource);
        $this->em->flush();

        return $resource;
    }
}