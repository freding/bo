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
        
        /** @var string $response_content */
        $responseContent = $this->fetchContent('/products', 'GET');
        $responseContentAsArray = json_decode($responseContent);
        $this->assertEquals(count($responseContentAsArray), 3);
    }
}
