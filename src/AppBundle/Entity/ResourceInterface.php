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
     * @return string
     */
    public function getVideo();

    /**
     * @param $video
     * @return ResourceInterface
     */
    public function setVideo($video);

    /**
     * @return \DateTime
     */
    public function getDate();

    /**
     * @param \DateTime $date
     * @return ResourceInterface
     */
    public function setDate(\DateTime $date);

    /**
     * @return string
     */
    public function getIp();

    /**
     * @param string $ip
     * @return ResourceInterface
     */
    public function setIp(string $ip);
}