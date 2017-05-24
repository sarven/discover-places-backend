<?php

namespace AppBundle\Entity;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Comment
 */
class Comment implements ResourceInterface
{
    /**
     * @var int
     *
     * @Groups({"api"})
     */
    private $id;

    /**
     * @var string
     *
     * @Groups({"api"})
     */
    private $content;

    /**
     * @var string
     *
     * @Groups({"api"})
     */
    private $photo;

    /**
     * @var string
     *
     * @Groups({"api"})
     */
    private $video;

    /**
     * @var \DateTime
     *
     * @Groups({"api"})
     */
    private $date;

    /**
     * @var Message
     */
    private $message;

    /**
     * @var string
     */
    private $ip;

    /**
     * Comment constructor.
     */
    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Comment
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set video
     *
     * @param string $video
     *
     * @return Comment
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Comment
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set message
     *
     * @param Message $message
     *
     * @return Comment
     */
    public function setMessage(Message $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get Message
     *
     * @return Message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     * @return $this
     */
    public function setIp(string $ip)
    {
        $this->ip = $ip;

        return $this;
    }
}

