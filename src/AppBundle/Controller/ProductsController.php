<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\ViewHandler;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductsController extends Controller
{

    /**
     * @Rest\View()
     * @Rest\Get("/products/{id}")
     */
    public function getProductAction(Request $request)
    {
        $product =  $this->getDoctrine()->getManager()->getRepository("AppBundle:Product")->findOneById($request->get('id'));
        return $product;
    }
    
    
    /**
     * @Rest\View()
     * @Rest\Get("/products")
     */
    public function getProductsAction(Request $request)
    {
        $products =  $this->getDoctrine()->getManager()->getRepository("AppBundle:Product")->findAll();
        return $products;
    }
    
}
