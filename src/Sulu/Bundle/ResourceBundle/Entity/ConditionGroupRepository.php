<?php
/*
 * This file is part of the Sulu CMS.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\ResourceBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * Repository for condition groups
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ConditionGroupRepository extends EntityRepository implements ConditionGroupRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findById($id)
    {
        try {
            $queryBuilder = $this->createQueryBuilder('conditionGroup')
                ->andWhere('conditionGroup.id = :conditionGroupId')
                ->addSelect('conditions')
                ->leftJoin('conditionGroup.conditions', 'conditions')
                ->setParameter('conditionGroupId', $id);
            return $queryBuilder->getQuery()->getSingleResult();
        } catch (NoResultException $exc) {
            return null;
        }
    }
}