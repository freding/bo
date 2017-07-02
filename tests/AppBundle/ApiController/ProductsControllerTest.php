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

    /**
     * {@ignore}
     */    
    public function testGetProductsAction()
    {
        $client = $this->createClient();
        
        $client->request('GET', '/products');
        $this->assertStatusCode(Response::HTTP_OK, $client);
        
        /** @var string $response_content */
        $responseContent = $this->fetchContent('/products', 'GET');
        $responseContentAsArray = json_decode($responseContent);
        $this->assertEquals(count($responseContentAsArray), 3);
    }
    
    /**
     * {@ignore}
     */    
    public function testGetProductAction()
    {
        $client = $this->createClient();
        
        $client->request('GET', '/products/1');
        $this->assertStatusCode(Response::HTTP_OK, $client);
        
        /** @var string $response_content */
        $responseContent = $this->fetchContent('/products/1', 'GET');
        $responseContentAsArray = json_decode($responseContent);
        $this->assertEquals(count($responseContentAsArray), 1);
        
        $client->request('GET', '/products/10');
        $this->assertStatusCode(Response::HTTP_NOT_FOUND, $client);
        
    }
    
    
}
