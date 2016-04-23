<?php

namespace AppBundle\Filter;

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

        if ($lat & $long) {
            $queryBuilder
                ->addOrderBy('GEO(o.latitude = :lat, o.longitude = :long)')
                ->setParameter('lat', $lat)
                ->setParameter('long', $long);
        }
    }

    public function getDescription(ResourceInterface $resource)
    {
        return [];
    }
}
