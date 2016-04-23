<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 *
 * @author Yohan Giarelli <yohan@un-zero-un.fr>
 */
class Point
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Path", inversedBy="points")
     *
     * @var string
     */
    private $path;

    /**
     * @ORM\Column(type="float")
     *
     * @var float
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     *
     * @var float
     */
    private $longitude;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var integer
     */
    private $major;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var integer
     */
    private $minor;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var integer
     */
    private $rank;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string
     */
    private $image;

    public function __construct(Path $path)
    {
        $this->path  = $path;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return int
     */
    public function getMajor()
    {
        return $this->major;
    }

    /**
     * @param int $major
     */
    public function setMajor($major)
    {
        $this->major = $major;
    }

    /**
     * @return int
     */
    public function getMinor()
    {
        return $this->minor;
    }

    /**
     * @param int $minor
     */
    public function setMinor($minor)
    {
        $this->minor = $minor;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @param int $rank
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
}
