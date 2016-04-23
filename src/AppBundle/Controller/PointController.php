<?php

namespace AppBundle\Controller;

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
        $resource = $this->getResource($request);

        return $this->getSuccessResponse($resource, $point);
    }
}
