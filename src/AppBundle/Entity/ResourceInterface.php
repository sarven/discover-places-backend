<?php

namespace AppBundle\Entity;

/**
 * Interface ResourceInterface
 * @package AppBundle\Entity
 */
interface ResourceInterface
{
    /**
     * @return string
     */
    public function getPhoto();

    /**
     * @param $photo
     * @return ResourceInterface
     */
    public function setPhoto($photo);

    /**
     * @return ResourceInterface
     */
    public function getVideo();

    /**
     * @param $video
     * @return string
     */
    public function setVideo($video);

}