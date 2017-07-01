<?php

namespace AppBundle\EntityFactory;

use AppBundle\Entity\Product;
use AppBundle\EntityFactory\EntityFactoryInterface;

/**
* ProductFactory
* @author F.Bourbigot
*/
class ProductFactory implements EntityFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public static function create()
    {
        return new Product();
    }
}
