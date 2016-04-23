<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BeaconHit;
use AppBundle\Entity\Point;
use Dunglas\ApiBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Yohan Giarelli <yohan@un-zero-un.fr>
 */
class PointController extends ResourceController
{
    public function getByMajorMinorAction(Request $request, Point $point)
    {
        $em = $this->getDoctrine()->getManager();
        $beaconHit = new BeaconHit();
        $beaconHit->setMinor($point->getMinor());
        $beaconHit->setMajor($point->getMajor());
        $em->persist($beaconHit);
        $em->flush();

        $resource = $this->getResource($request);

        return $this->getSuccessResponse($resource, $point);
    }
}
