<?php

namespace AppBundle\Upload;

use AppBundle\Entity\ResourceInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class AbstractFileUploader
 * @package AppBundle\Upload
 */
abstract class AbstractFileUploader implements FileUploaderInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ResourceInterface $resource
     * @return File
     */
    abstract protected function getFile(ResourceInterface $resource);

    /**
     * @param ResourceInterface $resource
     * @param string $fileName
     */
    abstract protected function setFileName(ResourceInterface $resource, string $fileName);

    /**
     * AbstractFileUploader constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @inheritdoc
     */
    public function upload(ResourceInterface $resource, string $uploadDir)
    {
        $file = $this->getFile($resource);

        if (!$file) {
            return false;
        }

        $fileName = $this->generateName($file);
        $file->move($uploadDir, $fileName);
        $this->setFileName($resource, $fileName);

        return true;
    }

    /**
     * @param File $file
     * @return string
     */
    private function generateName(File $file)
    {
        return md5(uniqid()).'.'.$file->guessExtension();
    }
}