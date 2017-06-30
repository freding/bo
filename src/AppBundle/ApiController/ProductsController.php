<?php

namespace AppBundle\ApiController;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\ViewHandler;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Product;
use AppBundle\Form\Type\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Exception\ApiValidationException;

class ProductsController extends Controller
{

    /**
     * @Rest\View()
     * @Rest\Get("/products/{id}")
     * @ParamConverter("product", class="AppBundle:Product")
     */
    public function getProductAction(Product $product)
    {
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
    
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/products")
     */
    public function postProductAction(Request $request){
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($product);
            $em->flush();
            return $product;
        } else {
            throw new ApiValidationException($form->getErrors(true, false));
        }
        
    }
    
    
    
    /**
     * @Rest\View(statusCode=Response::HTTP_ACCEPTED)
     * @Rest\Put("/products/{id}")
     * @ParamConverter("product", class="AppBundle:Product")
     */
    public function putProductAction(Request $request, Product $product){
        $form = $this->createForm(ProductType::class, $product);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($product);
            $em->flush();
            return $product;
        } else {
            throw new ApiValidationException($form->getErrors(true, false));
        }
        
    }
    
     /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/products/{id}")
     * @ParamConverter("product", class="AppBundle:Product")
     */
    public function removePlaceAction(Product $product)
    {
        $this->getDoctrine()->getManager()->remove($product);
        $this->getDoctrine()->getManager()->flush();
    }
    
    
}
