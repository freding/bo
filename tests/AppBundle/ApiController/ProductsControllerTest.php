<?php

namespace Tests\AppBundle\ApiController;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
* ProductsControllerTest
* @author F.Bourbigot
*/
class ProductsControllerTest extends WebTestCase
{
    public function setUp()
    {
        parent::setup();
        $fixtures = array(
          'AppBundle\DataFixtures\ORM\LoadProductData',
        );
        $this->loadFixtures($fixtures);
    }
    
    public function testGetProductAction()
    {
        $client = $this->createClient();
        $this->execQuery($client, 'GET', null, '/products');
        $response = $client->getResponse();
        $this->assertJsonResponse($response, 200);
    }
}
