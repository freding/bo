<?php

namespace AppBundle\DataFixtures\Mapping;

/**
* SampleDataInterface
* @author F.Bourbigot
*/
interface SampleDataInterface
{
    
    /**
     * @return string
     */
    public static function getFactoryServiceId();
    
    /**
     * @return array
     */
    public static function get();
}
