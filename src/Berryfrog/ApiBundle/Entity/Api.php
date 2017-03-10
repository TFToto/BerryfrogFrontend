<?php

namespace Berryfrog\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Api
 *
 * @ORM\Table(name="berryfrog.measurements")
 * @ORM\Entity(repositoryClass="Berryfrog\ApiBundle\Repository\ApiRepository")
 * 
 * @ExclusionPolicy("all") 
 */
class Api
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="transmitter_id", type="integer")
     * @Expose
     */
    private $transmitterId;

    /**
     * @var float
     *
     * @ORM\Column(name="vcc_atmega", type="float", nullable=true)
     * @Expose
     */
    private $vccAtmega;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="add_datetime", type="datetime")
     * @Expose
     */
    private $addDatetime;

    /**
     * @var float
     *
     * @ORM\Column(name="temp_dht_hic", type="float", nullable=true)
     * @Expose
     */
    private $tempDhtHic;

    /**
     * @var float
     *
     * @ORM\Column(name="temp_dht_hif", type="float", nullable=true)
     * @Expose
     */
    private $tempDhtHif;

    /**
     * @var float
     *
     * @ORM\Column(name="humidity_dht", type="float", nullable=true)
     * @Expose
     */
    private $humidityDht;

    /**
     * @var float
     *
     * @ORM\Column(name="pressure_bmp", type="float", nullable=true)
     * @Expose
     */
    private $pressureBmp;

    /**
     * @var float
     *
     * @ORM\Column(name="altitude_bmp", type="float", nullable=true)
     * @Expose
     */
    private $altitudeBmp;

    /**
     * @var float
     *
     * @ORM\Column(name="temp_bmp", type="float", nullable=true)
     * @Expose
     */
    private $tempBmp;

    /**
     * @var int
     *
     * @ORM\Column(name="vis_is", type="integer", nullable=true)
     * @Expose
     */
    private $visIs;

    /**
     * @var float
     *
     * @ORM\Column(name="uvindex_is", type="float", nullable=true)
     * @Expose
     */
    private $uvindexIs;


    /**
     * Get id
     *
     * @return integer
     * @VirtualProperty 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set transmitterId
     *
     * @param integer $transmitterId
     * @return Api
     */
    public function setTransmitterId($transmitterId)
    {
        $this->transmitterId = $transmitterId;

        return $this;
    }

    /**
     * Get transmitterId
     *
     * @return integer
     * @VirtualProperty 
     */
    public function getTransmitterId()
    {
        return $this->transmitterId;
    }

    /**
     * Set vccAtmega
     *
     * @param float $vccAtmega
     * @return Api
     */
    public function setVccAtmega($vccAtmega)
    {
        $this->vccAtmega = $vccAtmega;

        return $this;
    }

    /**
     * Get vccAtmega
     *
     * @return float 
     * @VirtualProperty
     */
    public function getVccAtmega()
    {
        return $this->vccAtmega;
    }

    /**
     * Set addDatetime
     *
     * @param \DateTime $addDatetime
     * @return Api
     */
    public function setAddDatetime($addDatetime)
    {
        $this->addDatetime = $addDatetime;

        return $this;
    }

    /**
     * Get addDatetime
     *
     * @return \DateTime
     * @VirtualProperty 
     */
    public function getAddDatetime()
    {
        return $this->addDatetime;
    }

    /**
     * Set tempDhtHic
     *
     * @param float $tempDhtHic
     * @return Api
     */
    public function setTempDhtHic($tempDhtHic)
    {
        $this->tempDhtHic = $tempDhtHic;

        return $this;
    }

    /**
     * Get tempDhtHic
     *
     * @return float 
     * @VirtualProperty
     */
    public function getTempDhtHic()
    {
        return $this->tempDhtHic;
    }

    /**
     * Set tempDhtHif
     *
     * @param float $tempDhtHif
     * @return Api
     */
    public function setTempDhtHif($tempDhtHif)
    {
        $this->tempDhtHif = $tempDhtHif;

        return $this;
    }

    /**
     * Get tempDhtHif
     *
     * @return float
     * @VirtualProperty 
     */
    public function getTempDhtHif()
    {
        return $this->tempDhtHif;
    }

    /**
     * Set humidityDht
     *
     * @param float $humidityDht
     * @return Api
     */
    public function setHumidityDht($humidityDht)
    {
        $this->humidityDht = $humidityDht;

        return $this;
    }

    /**
     * Get humidityDht
     *
     * @return float
     * @VirtualProperty 
     */
    public function getHumidityDht()
    {
        return $this->humidityDht;
    }

    /**
     * Set pressureBmp
     *
     * @param float $pressureBmp
     * @return Api
     */
    public function setPressureBmp($pressureBmp)
    {
        $this->pressureBmp = $pressureBmp;

        return $this;
    }

    /**
     * Get pressureBmp
     *
     * @return float
     * @VirtualProperty 
     */
    public function getPressureBmp()
    {
        return $this->pressureBmp;
    }

    /**
     * Set altitudeBmp
     *
     * @param float $altitudeBmp
     * @return Api
     */
    public function setAltitudeBmp($altitudeBmp)
    {
        $this->altitudeBmp = $altitudeBmp;

        return $this;
    }

    /**
     * Get altitudeBmp
     *
     * @return float
     * @VirtualProperty 
     */
    public function getAltitudeBmp()
    {
        return $this->altitudeBmp;
    }

    /**
     * Set tempBmp
     *
     * @param float $tempBmp
     * @return Api
     */
    public function setTempBmp($tempBmp)
    {
        $this->tempBmp = $tempBmp;

        return $this;
    }

    /**
     * Get tempBmp
     *
     * @return float
     * @VirtualProperty 
     */
    public function getTempBmp()
    {
        return $this->tempBmp;
    }

    /**
     * Set visIs
     *
     * @param integer $visIs
     * @return Api
     */
    public function setVisIs($visIs)
    {
        $this->visIs = $visIs;

        return $this;
    }

    /**
     * Get visIs
     *
     * @return integer
     * @VirtualProperty 
     */
    public function getVisIs()
    {
        return $this->visIs;
    }

    /**
     * Set uvindexIs
     *
     * @param float $uvindexIs
     * @return Api
     */
    public function setUvindexIs($uvindexIs)
    {
        $this->uvindexIs = $uvindexIs;

        return $this;
    }

    /**
     * Get uvindexIs
     *
     * @return float
     * @VirtualProperty 
     */
    public function getUvindexIs()
    {
        return $this->uvindexIs;
    }
}
