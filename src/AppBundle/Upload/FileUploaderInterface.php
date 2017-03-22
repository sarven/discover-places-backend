<?php

namespace AppBundle\Upload;

use AppBundle\Entity\ResourceInterface;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Interface FileUploaderInterface
 * @package AppBundle\Upload
 */
interface FileUploaderInterface
{
    /**
     * @param ResourceInterface $resource
     * @param string $uploadDir
     * @return mixed
     */
    public function upload(ResourceInterface $resource, string $uploadDir);
}