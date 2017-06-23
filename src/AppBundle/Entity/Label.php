<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="label")
 */
class Label
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $color;

    /**
     * @ManyToMany(targetEntity="Product", mappedBy="labels")
     */
    private $products;
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param int $id
     * @return Label
     */
    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }

    /**
     * @param string $name
     * @return Label
     */
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }

    /**
     * @param string $color
     * @return Label
     */
    public function setColor($color)
    {
        $this->color = $color;
        
        return $this;
    }
}
