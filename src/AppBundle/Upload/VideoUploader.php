<?php

namespace AppBundle\Upload;

use AppBundle\Entity\ResourceInterface;

/**
 * Class VideoUploader
 * @package AppBundle\Upload
 */
class VideoUploader extends AbstractFileUploader
{
    /**
     * @param ResourceInterface $resource
     * @return ResourceInterface
     */
    protected function getFile(ResourceInterface $resource)
    {
        return $resource->getVideo();
    }

    /**
     * @param ResourceInterface $resource
     * @param string $fileName
     */
    protected function setFileName(ResourceInterface $resource, string $fileName)
    {
        $resource->setVideo($fileName);
    }
}