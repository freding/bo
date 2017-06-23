<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
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
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     */
    private $description;
    
    
    /**
     * @ManyToMany(targetEntity="Label", inversedBy="products")
     * @JoinTable(name="products_labels")
     */
    private $labels;
    
    
    function __construct() {
        $this->labels = new ArrayCollection();
    }

     /**
     * @return int
     */
    function getId() {
        return $this->id;
    }

    /**
     * @return string
     */    
    function getName() {
        return $this->name;
    }

    /**
     * @return float
     */
    function getPrice() {
        return $this->price;
    }

    /**
     * @return string
     */
    function getDescription() {
        return $this->description;
    }

    /**
     * @param int $id
     * @return Product
     */    
    function setId($id) {
        $this->id = $id;
        
        return $this;        
    }

    /**
     * @param string $name
     * @return Product
     */
    function setName($name) {
        $this->name = $name;

        return $this;        
    }

    /**
     * @param float $price
     * @return Product
     */
    function setPrice($price) {
        $this->price = $price;
        
        return $this;
    }

    /**
     * @param string $description
     * @return Product
     */
    function setDescription($description) {
        $this->description = $description;
        
        return $this;
    }



    
}