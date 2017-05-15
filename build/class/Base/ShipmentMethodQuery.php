<?php

namespace Base;

use \ShipmentMethod as ChildShipmentMethod;
use \ShipmentMethodQuery as ChildShipmentMethodQuery;
use \Exception;
use \PDO;
use Map\ShipmentMethodTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'shipment_method' table.
 *
 *
 *
 * @method     ChildShipmentMethodQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildShipmentMethodQuery orderByLabel($order = Criteria::ASC) Order by the label column
 * @method     ChildShipmentMethodQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method     ChildShipmentMethodQuery groupById() Group by the id column
 * @method     ChildShipmentMethodQuery groupByLabel() Group by the label column
 * @method     ChildShipmentMethodQuery groupByStatus() Group by the status column
 *
 * @method     ChildShipmentMethodQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildShipmentMethodQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildShipmentMethodQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildShipmentMethodQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildShipmentMethodQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildShipmentMethodQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildShipmentMethodQuery leftJoinShipment($relationAlias = null) Adds a LEFT JOIN clause to the query using the Shipment relation
 * @method     ChildShipmentMethodQuery rightJoinShipment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Shipment relation
 * @method     ChildShipmentMethodQuery innerJoinShipment($relationAlias = null) Adds a INNER JOIN clause to the query using the Shipment relation
 *
 * @method     ChildShipmentMethodQuery joinWithShipment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Shipment relation
 *
 * @method     ChildShipmentMethodQuery leftJoinWithShipment() Adds a LEFT JOIN clause and with to the query using the Shipment relation
 * @method     ChildShipmentMethodQuery rightJoinWithShipment() Adds a RIGHT JOIN clause and with to the query using the Shipment relation
 * @method     ChildShipmentMethodQuery innerJoinWithShipment() Adds a INNER JOIN clause and with to the query using the Shipment relation
 *
 * @method     ChildShipmentMethodQuery leftJoinShipmentWeightGrid($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShipmentWeightGrid relation
 * @method     ChildShipmentMethodQuery rightJoinShipmentWeightGrid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShipmentWeightGrid relation
 * @method     ChildShipmentMethodQuery innerJoinShipmentWeightGrid($relationAlias = null) Adds a INNER JOIN clause to the query using the ShipmentWeightGrid relation
 *
 * @method     ChildShipmentMethodQuery joinWithShipmentWeightGrid($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ShipmentWeightGrid relation
 *
 * @method     ChildShipmentMethodQuery leftJoinWithShipmentWeightGrid() Adds a LEFT JOIN clause and with to the query using the ShipmentWeightGrid relation
 * @method     ChildShipmentMethodQuery rightJoinWithShipmentWeightGrid() Adds a RIGHT JOIN clause and with to the query using the ShipmentWeightGrid relation
 * @method     ChildShipmentMethodQuery innerJoinWithShipmentWeightGrid() Adds a INNER JOIN clause and with to the query using the ShipmentWeightGrid relation
 *
 * @method     \ShipmentQuery|\ShipmentWeightGridQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildShipmentMethod findOne(ConnectionInterface $con = null) Return the first ChildShipmentMethod matching the query
 * @method     ChildShipmentMethod findOneOrCreate(ConnectionInterface $con = null) Return the first ChildShipmentMethod matching the query, or a new ChildShipmentMethod object populated from the query conditions when no match is found
 *
 * @method     ChildShipmentMethod findOneById(int $id) Return the first ChildShipmentMethod filtered by the id column
 * @method     ChildShipmentMethod findOneByLabel(string $label) Return the first ChildShipmentMethod filtered by the label column
 * @method     ChildShipmentMethod findOneByStatus(int $status) Return the first ChildShipmentMethod filtered by the status column *

 * @method     ChildShipmentMethod requirePk($key, ConnectionInterface $con = null) Return the ChildShipmentMethod by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentMethod requireOne(ConnectionInterface $con = null) Return the first ChildShipmentMethod matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipmentMethod requireOneById(int $id) Return the first ChildShipmentMethod filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentMethod requireOneByLabel(string $label) Return the first ChildShipmentMethod filtered by the label column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentMethod requireOneByStatus(int $status) Return the first ChildShipmentMethod filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipmentMethod[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildShipmentMethod objects based on current ModelCriteria
 * @method     ChildShipmentMethod[]|ObjectCollection findById(int $id) Return ChildShipmentMethod objects filtered by the id column
 * @method     ChildShipmentMethod[]|ObjectCollection findByLabel(string $label) Return ChildShipmentMethod objects filtered by the label column
 * @method     ChildShipmentMethod[]|ObjectCollection findByStatus(int $status) Return ChildShipmentMethod objects filtered by the status column
 * @method     ChildShipmentMethod[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ShipmentMethodQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ShipmentMethodQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ecom', $modelName = '\\ShipmentMethod', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildShipmentMethodQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildShipmentMethodQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildShipmentMethodQuery) {
            return $criteria;
        }
        $query = new ChildShipmentMethodQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildShipmentMethod|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ShipmentMethodTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ShipmentMethodTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildShipmentMethod A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, label, status FROM shipment_method WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildShipmentMethod $obj */
            $obj = new ChildShipmentMethod();
            $obj->hydrate($row);
            ShipmentMethodTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildShipmentMethod|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildShipmentMethodQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ShipmentMethodTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildShipmentMethodQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ShipmentMethodTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentMethodQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ShipmentMethodTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ShipmentMethodTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentMethodTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the label column
     *
     * Example usage:
     * <code>
     * $query->filterByLabel('fooValue');   // WHERE label = 'fooValue'
     * $query->filterByLabel('%fooValue%', Criteria::LIKE); // WHERE label LIKE '%fooValue%'
     * </code>
     *
     * @param     string $label The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentMethodQuery The current query, for fluid interface
     */
    public function filterByLabel($label = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($label)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentMethodTableMap::COL_LABEL, $label, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param     mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentMethodQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(ShipmentMethodTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(ShipmentMethodTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentMethodTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related \Shipment object
     *
     * @param \Shipment|ObjectCollection $shipment the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildShipmentMethodQuery The current query, for fluid interface
     */
    public function filterByShipment($shipment, $comparison = null)
    {
        if ($shipment instanceof \Shipment) {
            return $this
                ->addUsingAlias(ShipmentMethodTableMap::COL_ID, $shipment->getShipmentMethodId(), $comparison);
        } elseif ($shipment instanceof ObjectCollection) {
            return $this
                ->useShipmentQuery()
                ->filterByPrimaryKeys($shipment->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByShipment() only accepts arguments of type \Shipment or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Shipment relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildShipmentMethodQuery The current query, for fluid interface
     */
    public function joinShipment($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Shipment');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Shipment');
        }

        return $this;
    }

    /**
     * Use the Shipment relation Shipment object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ShipmentQuery A secondary query class using the current class as primary query
     */
    public function useShipmentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShipment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Shipment', '\ShipmentQuery');
    }

    /**
     * Filter the query by a related \ShipmentWeightGrid object
     *
     * @param \ShipmentWeightGrid|ObjectCollection $shipmentWeightGrid the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildShipmentMethodQuery The current query, for fluid interface
     */
    public function filterByShipmentWeightGrid($shipmentWeightGrid, $comparison = null)
    {
        if ($shipmentWeightGrid instanceof \ShipmentWeightGrid) {
            return $this
                ->addUsingAlias(ShipmentMethodTableMap::COL_ID, $shipmentWeightGrid->getShipmentMethodId(), $comparison);
        } elseif ($shipmentWeightGrid instanceof ObjectCollection) {
            return $this
                ->useShipmentWeightGridQuery()
                ->filterByPrimaryKeys($shipmentWeightGrid->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByShipmentWeightGrid() only accepts arguments of type \ShipmentWeightGrid or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ShipmentWeightGrid relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildShipmentMethodQuery The current query, for fluid interface
     */
    public function joinShipmentWeightGrid($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ShipmentWeightGrid');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ShipmentWeightGrid');
        }

        return $this;
    }

    /**
     * Use the ShipmentWeightGrid relation ShipmentWeightGrid object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ShipmentWeightGridQuery A secondary query class using the current class as primary query
     */
    public function useShipmentWeightGridQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShipmentWeightGrid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ShipmentWeightGrid', '\ShipmentWeightGridQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildShipmentMethod $shipmentMethod Object to remove from the list of results
     *
     * @return $this|ChildShipmentMethodQuery The current query, for fluid interface
     */
    public function prune($shipmentMethod = null)
    {
        if ($shipmentMethod) {
            $this->addUsingAlias(ShipmentMethodTableMap::COL_ID, $shipmentMethod->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the shipment_method table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentMethodTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ShipmentMethodTableMap::clearInstancePool();
            ShipmentMethodTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentMethodTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ShipmentMethodTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ShipmentMethodTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ShipmentMethodTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ShipmentMethodQuery
