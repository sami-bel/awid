<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var User $fromUser
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $fromUser;

    /**
     * @var User $toUser
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $toUser;


    /**
     * @var string $title
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string $content
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @var \DateTime $createAt
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    /**
     * @var boolean $archived
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $archived = false;

    /**
     * @var boolean $seen
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $seen = false;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getFromUser(): ?User
    {
        return $this->fromUser;
    }

    /**
     * @param User $fromUser
     * @return Message
     */
    public function setFromUser(User $fromUser): Message
    {
        $this->fromUser = $fromUser;
        return $this;
    }

    /**
     * @return User
     */
    public function getToUser(): ?User
    {
        return $this->toUser;
    }

    /**
     * @param User $toUser
     * @return Message
     */
    public function setToUser(User $toUser): Message
    {
        $this->toUser = $toUser;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Message
     */
    public function setTitle(string $title): Message
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return Message
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreateAt(): ?\DateTime
    {
        return $this->createAt;
    }

    /**
     * @param \DateTime $createAt
     * @return Message
     */
    public function setCreateAt(\DateTime $createAt): Message
    {
        $this->createAt = $createAt;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isArchived(): bool
    {
        return $this->archived;
    }

    /**
     * @param boolean $archived
     * @return Message
     */
    public function setArchived(bool $archived)
    {
        $this->archived = $archived;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isSeen(): ?bool
    {
        return $this->seen;
    }

    /**
     * @param boolean $seen
     * @return Message
     */
    public function setSeen(bool $seen)
    {
        $this->seen = $seen;
        return $this;
    }





}
