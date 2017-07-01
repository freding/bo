<?php

namespace AppBundle\Component\Core\Reflection;

/**
* ClassUtilities
* @author F.Bourbigot
*/
class ClassUtilities
{
    /**
     * @param string $propertyName
     * @return string
     */
    public static function getSetterNameForPropertyName($propertyName)
    {
        return "set".ucfirst($propertyName);
    }
    
    /**
     * @param string $propertyName
     * @return string
     */
    public static function getGetterNameForPropertyName($propertyName)
    {
        return "get".ucfirst($propertyName);
    }
}
