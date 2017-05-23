<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Message;
use Doctrine\ORM\EntityRepository;

/**
 * Class MessageRepository
 * @package AppBundle\Repository
 */
class MessageRepository extends EntityRepository
{
    /**
     * @param float $lat
     * @param float $long
     * @return array
     */
    public function findByCoordinates(float $lat, float $long)
    {
        $qb = $this
            ->createQueryBuilder('m')
            ->select('m, 
                (6371 * acos(
                        cos(radians(m.latitude)) 
                        * cos(radians(:lat)) 
                        * cos(
                            radians(:long) - radians(m.longitude)
                        ) 
                        + sin(radians(m.latitude)) 
                        * sin(radians(:lat)) 
                    ) 
                ) 
                AS distance
            ')
            ->setParameters([
                'lat' => $lat,
                'long' => $long
            ])
            ->having('distance <= m.scope')
            ->orderBy('m.id', 'DESC')
        ;

        return $qb->getQuery()->getResult();
    }

    /**
     * @param int $limit
     * @return array
     */
    public function getLatestMessages(int $limit)
    {
        return $this->findBy([], ['id' => 'DESC'], $limit);
    }
}
