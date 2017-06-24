<?php

namespace WebGrocBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 * @package WebGrocBundle\Controller
 */
class DefaultController extends Controller {

    /**
     * @Route("/")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $weekList = $em->getRepository("WebGrocBundle:GrocList")->findForWeek();


        return $this->render('default/index.html.twig', [
            'weekList' => is_array($weekList) ? $weekList[0] : null,
            "lists"    => $em->getRepository("WebGrocBundle:GrocItem")->getCount(),
            "items"    => $em->getRepository("WebGrocBundle:GrocItem")->getCount(),
        ]);
    }

}
