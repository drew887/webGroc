<?php

namespace WebGrocBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use WebGrocBundle\Entity\GrocItem;
use WebGrocBundle\Entity\GrocList;
use WebGrocBundle\Form\GrocItemType;
use WebGrocBundle\Form\GrocListType;

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

        return $this->render('default/index.html.twig', [
            "lists" => $em->getRepository("WebGrocBundle:GrocItem")->getCount(),
            "items" => $em->getRepository("WebGrocBundle:GrocItem")->getCount(),
        ]);
    }

    /**
     * @Route("/item/create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createItemAction(Request $request) {
        $em   = $this->getDoctrine()->getManager();
        $item = new GrocItem();

        $form = $this->createForm(GrocItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($item);
            $em->flush();

            return $this->redirectToRoute('webgroc_default_index');
        }

        return $this->render('default/createItem.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
