<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Message
 */
class Message implements ResourceInterface
{
    /**
     * Available scopes in kilometers
     */
    const AVAILABLE_SCOPES = [1, 2, 5];

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
     * @var float
     *
     * @Groups({"api", "coordinates"})
     */
    private $latitude;

    /**
     * @var float
     *
     * @Groups({"api", "coordinates"})
     */
    private $longitude;

    /**
     * @var int
     *
     * @Groups({"api"})
     */
    private $scope;

    /**
     * @var \DateTime
     *
     * @Groups({"api"})
     */
    private $date;

    /**
     * @var Comment[]
     *
     * @Groups({"api"})
     */
    private $comments;

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
        $this->comments = new ArrayCollection();
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
     * @return Message
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
     * @return Message
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
     * @return Message
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
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Message
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Message
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set scope
     *
     * @param integer $scope
     *
     * @return Message
     */
    public function setScope($scope)
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * Get scope
     *
     * @return int
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Message
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
     * Get comments
     *
     * @return Comment[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add comment
     *
     * @param Comment $comment
     *
     * @return Message
     */
    public function addComment(Comment $comment)
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
        }

        return $this;
    }

    /**
     * Remove comment
     *
     * @param Comment $comment
     *
     * @return Message
     */
    public function removeComment(Comment $comment)
    {
        if ($this->comments->contains($comment)) {
            $this->removeComment($comment);
        }

        return $this;
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

