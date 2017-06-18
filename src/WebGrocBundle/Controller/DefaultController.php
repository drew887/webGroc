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

class DefaultController extends Controller {

    /**
     * @Route("/")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $lists = $em->getRepository("WebGrocBundle:GrocItem")->findAll();

        return $this->render('default/index.html.twig', [
            "lists" => \count($lists),
        ]);
    }

    /**
     * @Route("/list/create")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createListAction(Request $request) {

        $item = (new GrocItem())->setName("Test")->setPrice(12.33);
        $list = (new GrocList())->setWeekDate(new \DateTime())->addItem($item)->addItem(clone $item);

        $form = $this->createForm(GrocListType::class, $list);

        return $this->render('default/createList.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/list/{list}", requirements={"list":"\d+"})
     * @ParamConverter("list", class="WebGrocBundle:GrocList")
     *
     * @param Request $request
     * @param GrocList $list
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewListAction(Request $request, GrocList $list) {

        return $this->render('default/viewList.html.twig', []);
    }

    /**
     * @Route("/item/create")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createItemAction() {
        $item = new GrocItem();

        $form = $this->createForm(GrocItemType::class, $item);

        return $this->render('default/createItem.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}