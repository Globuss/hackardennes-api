<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Path;
use AppBundle\Form\PathType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(path="/admin/paths")
 *
 * @author Yohan Giarelli <yohan@un-zero-un.fr>
 */
class PathController extends Controller
{
    /**
     * @Route(path="/", name="admin_paths")
     * @Template()
     */
    public function indexAction()
    {
        return [
            'paths' => $this->getDoctrine()->getRepository(Path::class)->findAll()
        ];
    }

    /**
     * @Route(path="/{id}/edit", name="admin_paths_edit")
     * @Template()
     */
    public function editAction(Path $path, Request $request)
    {
        $form = $this->createForm(PathType::class, $path);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_paths_edit', ['id' => $path->getId()]);
        }

        return ['path' => $path, 'form' => $form->createView()];
    }
}
