<?php

namespace WebGrocBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use WebGrocBundle\Entity\GrocItem;
use WebGrocBundle\Form\GrocItemType;

/**
 * Class ItemController
 *
 * @Route("/item")
 * @package WebGrocBundle\Controller
 */
class ItemController extends Controller {

    /**
     * @Route("")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction() {
        $em = $this->getDoctrine()->getManager();

        return $this->render('list/list.html.twig', [
            'items' => $em->getRepository('WebGrocBundle:GrocItem')->findAll(),
        ]);
    }

    /**
     * @Route("/create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request) {
        $em   = $this->getDoctrine()->getManager();
        $item = new GrocItem();

        $form = $this->createForm(GrocItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($item);
            $em->flush();

            return $this->redirectToRoute('webgroc_item_view', [
                'item' => $item->getId(),
            ]);
        }

        return $this->render('item/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/view/{item}", requirements={"item":"\d+"})
     * @ParamConverter("item", class="WebGrocBundle:GrocItem")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Request $request, GrocItem $item) {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(GrocItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
        }

        return $this->render('item/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
