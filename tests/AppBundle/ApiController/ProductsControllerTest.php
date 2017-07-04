<?php

namespace Tests\AppBundle\ApiController;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\DataFixtures\SampleData\Products;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Client;


/**
* ProductsControllerTest
* @author F.Bourbigot
*/
class ProductsControllerTest extends WebTestCase
{
    /**
     * @var Client 
     */
    private $client;
    
    public function setUp()
    {
        parent::setup();
        $fixtures = array(
          'AppBundle\DataFixtures\ORM\LoadProductData',
        );
        $this->loadFixtures($fixtures);
        
        $this->client = $this->createClient();
    }

    /**
     * {@ignore}
     */    
    public function testGetProductsAction()
    {
        $this->client->request(Request::METHOD_GET, '/api/products');
        $this->assertStatusCode(Response::HTTP_OK, $this->client);
        
        /** @var string $response_content */
        $responseContent = $this->fetchContent('/api/products', Request::METHOD_GET);
        $responseContentAsArray = json_decode($responseContent);
        $this->assertEquals(count($responseContentAsArray), 3);
    }
    
    /**
     * {@ignore}
     */    
    public function testGetProductAction()
    {
        $this->client->request(Request::METHOD_GET, '/api/products/1');
        $this->assertStatusCode(Response::HTTP_OK, $this->client);
        
        /** @var string $response_content */
        $responseContent = $this->fetchContent('/api/products/1', Request::METHOD_GET);
        $responseContentAsArray = json_decode($responseContent);
        $this->assertEquals(count($responseContentAsArray), 1);
        
        $this->client->request(Request::METHOD_GET, '/api/products/10');
        $this->assertStatusCode(Response::HTTP_NOT_FOUND, $this->client);
    }
    
    /**
     * {@ignore}
     */
    public function testPostProductAction()
    {
        $server = ['CONTENT_TYPE' => 'application/json'];        

        $sampleDataValid = Products::getValidOne();
        $jsonSampleDataValid = json_encode($sampleDataValid);
        $this->client->request(Request::METHOD_POST, "/api/products", array(), array(), $server, $jsonSampleDataValid);
        $response = $this->client->getResponse();
        $this->assertStatusCode(Response::HTTP_CREATED, $this->client);

        $sampleDataInResponse = json_decode($response->getContent());
        $this->assertEquals($sampleDataInResponse->name,$sampleDataValid["name"]);
        $this->assertEquals($sampleDataInResponse->description,$sampleDataValid["description"]);
        $this->assertEquals($sampleDataInResponse->price,$sampleDataValid["price"]);
        
        $jsonSampleDataUnvalid = json_encode(Products::getUnvalidOne());
        $this->client->request(Request::METHOD_POST, "/api/products", array(), array(), $server, $jsonSampleDataUnvalid);
        $this->assertStatusCode(Response::HTTP_BAD_REQUEST, $this->client);       
    }
 
    /**
     * {@ignore}
     */
    public function testPutProductAction()
    {
        $server = ['CONTENT_TYPE' => 'application/json'];        

        $sampleDataUpdateable = Products::get()[0];
        $jsonSampleDataUpdateable = json_encode($sampleDataUpdateable);
        $this->client->request(Request::METHOD_PUT, "/api/products/1", array(), array(), $server, $jsonSampleDataUpdateable);
        $this->assertStatusCode(Response::HTTP_ACCEPTED, $this->client);
        
        $this->client->request(Request::METHOD_PUT, "/api/products/100", array(), array(), $server, $jsonSampleDataUpdateable);
        $this->assertStatusCode(Response::HTTP_NOT_FOUND, $this->client);
        
    }
    
    /**
     * {@ignore}
     */
    public function testRemovePlaceAction()
    {
        $this->client->request(Request::METHOD_DELETE, '/api/products/1');
        $this->assertStatusCode(Response::HTTP_NO_CONTENT, $this->client);
        
        $this->client->request(Request::METHOD_DELETE, '/api/products/100');
        $this->assertStatusCode(Response::HTTP_NOT_FOUND, $this->client);  
    }        
    
}
