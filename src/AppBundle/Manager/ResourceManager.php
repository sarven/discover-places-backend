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
     * @var int
     */
    private $timeConstraintInSec;

    /**
     * ResourceManager constructor.
     * @param EntityManagerInterface $em
     * @param int $timeConstraintInSec
     */
    public function __construct(EntityManagerInterface $em, int $timeConstraintInSec = 5)
    {
        $this->em = $em;
        $this->timeConstraintInSec = $timeConstraintInSec;
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

    /**
     * @param ResourceInterface $resource
     * @param string $ip
     * @return bool
     */
    public function isPossibleToAdd(ResourceInterface $resource, string $ip)
    {
        dump($this->em->createQueryBuilder()
            ->select('COUNT(r)')
            ->from(get_class($resource), 'r')
            ->where('r.ip = :ip')
            ->andWhere('timestampdiff(SECOND, r.date, :today) < :timeConstraint')
            ->setParameters([
                'ip' => $ip,
                'today' => new \DateTime(),
                'timeConstraint' => $this->timeConstraintInSec
            ])
            ->getQuery()
            ->getSingleScalarResult() );
        return $this->em->createQueryBuilder()
            ->select('COUNT(r)')
            ->from(get_class($resource), 'r')
            ->where('r.ip = :ip')
            ->andWhere('timestampdiff(SECOND, r.date, :today) < :timeConstraint')
            ->setParameters([
                'ip' => $ip,
                'today' => new \DateTime(),
                'timeConstraint' => $this->timeConstraintInSec
            ])
            ->getQuery()
            ->getSingleScalarResult() == 0;
    }
}