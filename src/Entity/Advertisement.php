<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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

    public function getFromCountry(): ?string
    {
        return $this->fromCountry;
    }

    public function setFromCountry(string $fromCountry): self
    {
        $this->fromCity = $fromCountry;

        return $this;
    }

    public function getToCountry(): ?string
    {
        return $this->toCountry;
    }

    public function setToCountry(string $toCountry): self
    {
        $this->toCity = $toCountry;

        return $this;
    }


    public function getFromCity(): ?string
    {
        return $this->fromCity;
    }

    public function setFromCity(string $fromCity): self
    {
        $this->fromCity = $fromCity;

        return $this;
    }

    public function getToCity(): ?string
    {
        return $this->toCity;
    }

    public function setToCity(string $toCity): self
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
     * @param User $user
     * @return Advertisement
     */
    public function setUser( User $user): self
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




}
