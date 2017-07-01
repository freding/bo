<?php

namespace Tests\AppBundle\ApiController;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
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
        $client->request('GET', '/products');
        $this->assertStatusCode(Response::HTTP_OK, $client);
    }
}
