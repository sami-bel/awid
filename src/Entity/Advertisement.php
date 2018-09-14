<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Intl\Intl;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdvertisementRepository")
 */
class Advertisement
{

    CONST AIR_TRANSPORT_MODE      = 1;
    CONST TRAIN_TRANSPORT_MODE    = 2;
    CONST MARITIME_TRANSPORT_MODE = 3;
    CONST ROAD_TRANSPORT_MODE     = 4;


    CONST DOCUMENT_TYPE          = 1 ;
    CONST CLOTHES_ACCESSORY_TYPE = 2 ;
    CONST MEDICINE_TYPE          = 3 ;
    CONST OTHER_TYPE             = 4 ;


    CONST WEIGHT_LOWER_1  = 1 ;
    CONST WEIGHT_1_3      = 2 ;
    CONST WEIGHT_3_5      = 3 ;
    CONST WEIGHT_HIGHER_5 = 4 ;

    CONST ADVERTISEMENT_TAKE = 1;
    CONST ADVERTISEMENT_SEND = 2;

    CONST ADVERTISEMENT_TAKE_TYPE = "take";
    CONST ADVERTISEMENT_SEND_TYPE = "send";



    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="integer", length=255, nullable=true)
     */
    private $transportMode;

    /**
     * @ORM\Column(type="integer", length=255, nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="integer", length=255, nullable=true)
     */
    private $packageType;

    /**
     * @ORM\Column(type="integer", length=255, nullable=true)
     */
    private $advertisementType;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fromCountry;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $toCountry;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fromCity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $toCity;


    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;


    /**
     * Advertisement constructor.
     *
     *
     */
    public function __construct() {
        $this->createAt = new \DateTime();
    }


    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }


    /**
     * @param string $title
     *
     * @return Advertisement
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getFromCountry()
    {
        if ($this->fromCountry)
            $this->fromCountry = Intl::getRegionBundle()->getCountryNames()[$this->fromCountry];
        return $this->fromCountry;
    }


    /**
     * @param mixed $fromCountry
     *
     * @return Advertisement
     */
    public function setFromCountry($fromCountry)
    {
        $this->fromCountry = $fromCountry;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getToCountry()
    {   if ($this->toCountry)
            $this->toCountry = Intl::getRegionBundle()->getCountryNames()[$this->toCountry];
        return $this->toCountry;
    }


    /**
     * @param mixed $toCountry
     *
     * @return Advertisement
     */
    public function setToCountry($toCountry)
    {
        $this->toCountry = $toCountry;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getFromCity()
    {
        return $this->fromCity;
    }


    /**
     * @param mixed $fromCity
     *
     * @return Advertisement
     */
    public function setFromCity($fromCity)
    {
        $this->fromCity = $fromCity;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getToCity()
    {
        return $this->toCity;
    }


    /**
     * @param mixed $toCity
     *
     * @return Advertisement
     */
    public function setToCity($toCity)
    {
        $this->toCity = $toCity;

        return $this;
    }


    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getTransportMode()
    {
        return $this->transportMode;
    }


    /**
     * @param mixed $transportMode
     *
     * @return Advertisement
     */
    public function setTransportMode($transportMode)
    {
        $this->transportMode = $transportMode;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }


    /**
     * @param mixed $weight
     *
     * @return Advertisement
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->Description;
    }


    /**
     * @param mixed $Description
     *
     * @return Advertisement
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param UserInterface $user
     * @return Advertisement
     */
    public function setUser( UserInterface $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPackageType()
    {
        return $this->packageType;
    }

    /**
     * @param mixed $packageType
     */
    public function setPackageType($packageType)
    {
        $this->packageType = $packageType;
    }

    /**
     * @return integer
     */
    public function getAdvertisementType(): ?integer
    {
        return $this->advertisementType;
    }

    /**
     * @param mixed $advertisementType
     * @return Advertisement
     */
    public function setAdvertisementType($advertisementType): self
    {
        $this->advertisementType = $advertisementType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreateAt(): \DateTime
    {
        return $this->createAt;
    }

    /**
     * @param mixed $createAt
     * @return Advertisement
     */
    public function setCreateAt( \DateTime $createAt): Advertisement
    {
        $this->createAt = $createAt;
        return $this;
    }





}
