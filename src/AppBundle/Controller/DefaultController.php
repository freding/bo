<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use AppBundle\Entity\Label;

class DefaultController extends Controller
{
    /**
     * @Route("/sample", name="sample")
     */
    public function indexAction(Request $request)
    {
        /** @var Product $product */
        $product = $this->getDoctrine()->getManager()->getRepository('AppBundle:Product')->findOneById(1);
        
        $label = new Label();
        $label->setColor("000000");
        $label->setName("Errrr");
        $this->getDoctrine()->getManager()->persist($label);
        $product->addLabel($label);
        $this->getDoctrine()->getManager()->flush();
        
        /** @var Label[] $labels */
        $labels = $product->getLabels();
        foreach ($labels as $label) {
            echo $label->getColor();
        }
        
        
        
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
