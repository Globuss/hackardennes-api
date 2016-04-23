<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BeaconHit;
use AppBundle\Entity\Path;
use AppBundle\Entity\Point;
use Dunglas\ApiBundle\Controller\ResourceController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Yohan Giarelli <yohan@un-zero-un.fr>
 */
class PathController extends Controller
{
    public function getThemesAction(Request $request)
    {
        $themes = $this->getDoctrine()->getManager()->getRepository(Path::class)
            ->createQueryBuilder('p')
            ->select('DISTINCT p.theme')
            ->getQuery()
            ->getResult();

        return new Response(
            $this->get('serializer')->serialize($themes, 'json'),
            200,
            ['Content-Type' => 'application/json']
        );
    }
}
