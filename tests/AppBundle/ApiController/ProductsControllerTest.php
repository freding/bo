<?php

namespace Tests\AppBundle\ApiController;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\DataFixtures\SampleData\Products;
use Symfony\Component\HttpFoundation\Request;

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
        
        $client->request(Request::METHOD_GET, '/products');
        $this->assertStatusCode(Response::HTTP_OK, $client);
        
        /** @var string $response_content */
        $responseContent = $this->fetchContent('/products', Request::METHOD_GET);
        $responseContentAsArray = json_decode($responseContent);
        $this->assertEquals(count($responseContentAsArray), 3);
    }
    
    /**
     * {@ignore}
     */    
    public function testGetProductAction()
    {
        $client = $this->createClient();
        
        $client->request(Request::METHOD_GET, '/products/1');
        $this->assertStatusCode(Response::HTTP_OK, $client);
        
        /** @var string $response_content */
        $responseContent = $this->fetchContent('/products/1', Request::METHOD_GET);
        $responseContentAsArray = json_decode($responseContent);
        $this->assertEquals(count($responseContentAsArray), 1);
        
        $client->request(Request::METHOD_GET, '/products/10');
        $this->assertStatusCode(Response::HTTP_NOT_FOUND, $client);
    }
    
    /**
     * {@ignore}
     */
    public function testPostProductAction()
    {
        $server = ['CONTENT_TYPE' => 'application/json'];        
        $client = $this->createClient();
        
        $sampleDataValid = Products::getValidOne();
        $jsonSampleDataValid = json_encode($sampleDataValid);
        $client->request(Request::METHOD_POST, "/products", array(), array(), $server, $jsonSampleDataValid);
        $response = $client->getResponse();
        $this->assertStatusCode(Response::HTTP_CREATED, $client);

        $sampleDataInResponse = json_decode($response->getContent());
        $this->assertEquals($sampleDataInResponse->name,$sampleDataValid["name"]);
        $this->assertEquals($sampleDataInResponse->description,$sampleDataValid["description"]);
        $this->assertEquals($sampleDataInResponse->price,$sampleDataValid["price"]);
        
        $jsonSampleDataUnvalid = json_encode(Products::getUnvalidOne());
        $client->request(Request::METHOD_POST, "/products", array(), array(), $server, $jsonSampleDataUnvalid);
        $this->assertStatusCode(Response::HTTP_BAD_REQUEST, $client);       
    }
    
}
