<?php

namespace AppBundle\Upload;

use AppBundle\Entity\ResourceInterface;

/**
 * Class PhotoUploader
 * @package AppBundle\Upload
 */
class PhotoUploader extends AbstractFileUploader
{
    /**
     * @param ResourceInterface $resource
     * @return string
     */
    protected function getFile(ResourceInterface $resource)
    {
        return $resource->getPhoto();
    }

    /**
     * @param ResourceInterface $resource
     * @param string $fileName
     */
    protected function setFileName(ResourceInterface $resource, string $fileName)
    {
        $resource->setPhoto($fileName);
    }
}