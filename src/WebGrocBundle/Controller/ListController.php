<?php

namespace WebGrocBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WebGrocBundle\Entity\GrocItem;
use WebGrocBundle\Entity\GrocList;
use WebGrocBundle\Form\GrocListType;

/**
 * Class ListController
 *
 * @Route("/list")
 * @package WebGrocBundle\Controller
 */
class ListController extends Controller {

    /**
     * @Route("")
     */
    public function listAction() {
        $em = $this->getDoctrine()->getManager();

        return $this->render('default/listList.html.twig', [
            'items' => [],
        ]);
    }

    /**
     * @Route("/create")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request) {
        $em   = $this->getDoctrine()->getManager();
        $list = new GrocList();

        $form = $this->createForm(GrocListType::class, $list);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($list);
            $em->flush();

            return $this->redirectToRoute('webgroc_list_view', [
                'list' => $list->getId(),
            ]);
        }

        return $this->render('default/createList.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{list}", requirements={"list":"\d+"})
     * @ParamConverter("list", class="WebGrocBundle:GrocList")
     *
     * @param Request $request
     * @param GrocList $list
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Request $request, GrocList $list) {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(GrocListType::class, $list);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
        }

        return $this->render('default/createList.html.twig', [
            'form'  => $form->createView(),
            'items' => $em->getRepository('WebGrocBundle:GrocItem')->findNewForList($list),
        ]);
    }

    /**
     * @Route("/{list}/link/{item}", requirements={"list"="\d+","item"="\d+"})
     * @ParamConverter(name="list", class="WebGrocBundle:GrocList")
     * @ParamConverter(name="item", class="WebGrocBundle:GrocItem")
     *
     * @param Request $request
     * @param GrocItem $item
     * @param GrocList $list
     * @return RedirectResponse | Response
     */
    public function linkItemAction(Request $request, GrocList $list, GrocItem $item) {
        $em       = $this->getDoctrine()->getManager();
        $response = (new Response())->setStatusCode(200);

        switch ($request->getMethod()) {
            case "PUT":
            case "POST":
                if (!$list->getItems()->contains($item)) {
                    $list->addItem($item);
                    $response->setStatusCode(201);
                }
                break;
            case "DELETE":
                if ($list->getItems()->contains($item)) {
                    $list->removeItem($item);
                } else {
                    $response->setStatusCode(404);
                }
                break;
            case "GET":
                return $this->redirectToRoute('webgroc_list_view', [
                    "list" => $list,
                ]);
                break;
        }

        $em->flush();

        return $response;
    }
}
