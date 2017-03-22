<?php

namespace AppBundle\Manager;

use AppBundle\Entity\ResourceInterface;

/**
 * Interface ResourceManagerInterface
 * @package AppBundle\Manager
 */
interface ResourceManagerInterface
{
    /**
     * @param ResourceInterface $resource
     * @return mixed
     */
    public function save(ResourceInterface $resource);

    /**
     * @param ResourceInterface $resource
     * @return mixed
     */
    public function delete(ResourceInterface $resource);
}