<?php

namespace AppBundle\DataFixtures\SampleData;

use AppBundle\DataFixtures\Mapping\SampleDataInterface;

/**
* Products
* @author F.Bourbigot
*/
final class Products implements SampleDataInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getFactoryServiceId()
    {
        return "app.factory.product";
    }
    
    
    /**
     * {@inheritdoc}
     */
    public static function get()
    {
        return [
            [
                'name' => 'Product 1',
                'price' => 100.00,
                'description' => 'Description of first product',
            ],
            [
                'name' => 'Product 2',
                'price' => 120.00,
                'description' => 'Description of second product',
            ],
            [
                'name' => 'Product 3',
                'price' => 140.00,
                'description' => 'Description of third product',
            ],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public static function getValidOne()
    {
        return [
            'name' => 'Product 4',
            'price' => 300.00,
            'description' => 'Description of last product',
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public static function getUnvalidOne()
    {
        return [
            'name' => 'Product 5',
            'price' => 300.00,
            'description' => '',
        ];
    }
    
}
