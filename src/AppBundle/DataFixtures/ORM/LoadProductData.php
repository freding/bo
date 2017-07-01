<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\DataFixtures\Converter\JsonSampleDataArrayToEntityArrayConverter;
use AppBundle\DataFixtures\SampleData\Products;
use AppBundle\Component\Core\DataFixtures\AbstractDataFixture;

class LoadProductData extends AbstractDataFixture
{
    public function load(ObjectManager $manager)
    {
        $jsonSampleDataArrayToEntityArrayConverter = new JsonSampleDataArrayToEntityArrayConverter(new Products(), $this->container);
        $entities = $jsonSampleDataArrayToEntityArrayConverter->converter();
        foreach ($entities as $entity) {
            $manager->persist($entity);
        }
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 1;
    }
}
