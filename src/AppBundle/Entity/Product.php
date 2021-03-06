<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation as Serializer;
use AppBundle\Component\Doctrine\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Products
 * @author F.Bourbigot
 * @Serializer\ExclusionPolicy("all")
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @Serializer\Expose
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Serializer\Expose
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @Serializer\Expose
     * @Assert\NotBlank()
     * @Assert\Type("float")
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;

    /**
     * @Serializer\Expose
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */
    private $description;
    
    
    /**
     * @ORM\ManyToMany(targetEntity="Label", inversedBy="products")
     * @ORM\JoinTable(name="products_labels")
     */
    private $labels;
    
    use TimestampableEntity;
    
    /**
     * {@ignore}
     */
    public function __construct()
    {
        $this->labels = new ArrayCollection();
    }

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
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param int $id
     * @return Product
     */
    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }

    /**
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param float $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;
        
        return $this;
    }

    /**
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;
        
        return $this;
    }
    
    /**
     * @param Label $label
     * @return Product
     */
    public function addLabel(Label $label)
    {
        if (!$this->labels->contains($label)) {
            $label->addProduct($this);
            $this->labels[] = $label;
        }
            
        return $this;
    }
    
    /**
     * @return Collection|Label[]
     */
    public function getLabels()
    {
        return $this->labels;
    }
    
    /**
     * @param Label $label
     * @return Product
     */
    public function removeLabel(Label $label)
    {
        if ($this->labels->contains($label)) {
            $this->labels->removeElement($label);
        }
        
        return $this;
    }
}
