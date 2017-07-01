<?php
namespace AppBundle\DataFixtures\Converter;

use AppBundle\DataFixtures\Mapping\SampleDataInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\EntityFactory\EntityFactoryInterface;
use AppBundle\Component\Core\Reflection\ClassUtilities;

class JsonSampleDataArrayToEntityArrayConverter
{
    /**
     * @var ContainerInterface
     */
    private $container;
    
    /**
     * @var SampleDataInterface
     */
    private $sampleDataInterface;

    public function __construct(SampleDataInterface $sampleDataInterface, ContainerInterface $container)
    {
        $this->sampleDataInterface = $sampleDataInterface;
        $this->container = $container;
    }    
        
    /**
     * @return array object[]
     */
    public function converter()
    {
        $entities = array();
        $sampleDatas = $this->sampleDataInterface->get();
        /** @var EntityFactoryInterface $entityFactory */
        $entityFactory = $this->container->get($this->sampleDataInterface->getFactoryServiceId());
        foreach ($sampleDatas as $sampleDataAsArray) {
            /** @var object $entity */
            $entity = $entityFactory::create();
            foreach ($sampleDataAsArray as $key => $value) {
                $this->mapArrayRowToEntityProperty($entity, $key, $value);
            }
            $entities[] = $entity;
        }
        return $entities;
    }

    /**
     * @return SampleDataInterface
     */
    function getSampleDataInterface(): SampleDataInterface
    {
        return $this->sampleDataInterface;
    }

    /**
     * @param SampleDataInterface $sampleDataInterface
     * @return JsonSampleDataArrayToEntityArrayConverter
     */
    function setSampleDataInterface(SampleDataInterface $sampleDataInterface)
    {
        $this->sampleDataInterface = $sampleDataInterface;
        return $this;
    }
    
    /**
     * @param object $entity
     * @param string $key
     * @param string $value
     * @return object
     */
    private function mapArrayRowToEntityProperty(&$entity, $key, $value)
    {
        $entityClass = new \ReflectionObject($entity);
        $setterName = ClassUtilities::getSetterNameForPropertyName($key);
        if ($entityClass->hasMethod($setterName))
        {
            $reflectionMethod = new \ReflectionMethod(get_class($entity), $setterName);
            $reflectionMethod->invoke($entity, $value);
        }else{
            throw new \BadMethodCallException("Setter '".$setterName."' not found on ".get_class($entity));
        }
        return $entity;
    }
    
}