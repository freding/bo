<?php

namespace AppBundle\EntityFactory;

/**
* EntityFactoryInterface
* @author F.Bourbigot
*/
interface EntityFactoryInterface
{
    /**
     * @return object
     */
    public static function create();
}
