<?php

namespace AppBundle\Filter;

use AppBundle\Entity\Path;
use AppBundle\Entity\Point;
use Doctrine\ORM\QueryBuilder;
use Dunglas\ApiBundle\Api\ResourceInterface;
use Dunglas\ApiBundle\Doctrine\Orm\Filter\AbstractFilter;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Yohan Giarelli <yohan@un-zero-un.fr>
 */
class SortByNearestFilter extends AbstractFilter
{
    public function apply(ResourceInterface $resource, QueryBuilder $queryBuilder, Request $request)
    {
        $lat = $request->query->get('lat', null);
        $long = $request->query->get('long', null);

        if ($lat & $long && $resource->getEntityClass() === Point::class) {
            $queryBuilder
                ->addSelect('GEO(o.latitude = :lat, o.longitude = :long) AS distance')
                ->addOrderBy('distance')
                ->setParameter('lat', $lat)
                ->setParameter('long', $long);
        }

        if ($lat & $long && $resource->getEntityClass() === Path::class) {
            $queryBuilder
                ->innerJoin('o.points', 'points')
                ->addSelect('GEO(points.latitude = :lat, points.longitude = :long) AS distance')
                ->groupBy('o.id')
                ->addOrderBy('distance')
                ->setParameter('lat', $lat)
                ->setParameter('long', $long);
        }
    }

    public function getDescription(ResourceInterface $resource)
    {
        return [];
    }
}
