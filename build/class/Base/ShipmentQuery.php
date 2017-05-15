<?php

namespace Base;

use \Shipment as ChildShipment;
use \ShipmentQuery as ChildShipmentQuery;
use \Exception;
use \PDO;
use Map\ShipmentTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'shipment' table.
 *
 *
 *
 * @method     ChildShipmentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildShipmentQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildShipmentQuery orderByAmountHt($order = Criteria::ASC) Order by the amount_ht column
 * @method     ChildShipmentQuery orderByAmountTtc($order = Criteria::ASC) Order by the amount_ttc column
 * @method     ChildShipmentQuery orderByShipmentMethodId($order = Criteria::ASC) Order by the shipment_method_id column
 *
 * @method     ChildShipmentQuery groupById() Group by the id column
 * @method     ChildShipmentQuery groupByStatus() Group by the status column
 * @method     ChildShipmentQuery groupByAmountHt() Group by the amount_ht column
 * @method     ChildShipmentQuery groupByAmountTtc() Group by the amount_ttc column
 * @method     ChildShipmentQuery groupByShipmentMethodId() Group by the shipment_method_id column
 *
 * @method     ChildShipmentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildShipmentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildShipmentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildShipmentQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildShipmentQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildShipmentQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildShipmentQuery leftJoinShipmentMethod($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShipmentMethod relation
 * @method     ChildShipmentQuery rightJoinShipmentMethod($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShipmentMethod relation
 * @method     ChildShipmentQuery innerJoinShipmentMethod($relationAlias = null) Adds a INNER JOIN clause to the query using the ShipmentMethod relation
 *
 * @method     ChildShipmentQuery joinWithShipmentMethod($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ShipmentMethod relation
 *
 * @method     ChildShipmentQuery leftJoinWithShipmentMethod() Adds a LEFT JOIN clause and with to the query using the ShipmentMethod relation
 * @method     ChildShipmentQuery rightJoinWithShipmentMethod() Adds a RIGHT JOIN clause and with to the query using the ShipmentMethod relation
 * @method     ChildShipmentQuery innerJoinWithShipmentMethod() Adds a INNER JOIN clause and with to the query using the ShipmentMethod relation
 *
 * @method     ChildShipmentQuery leftJoinOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Order relation
 * @method     ChildShipmentQuery rightJoinOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Order relation
 * @method     ChildShipmentQuery innerJoinOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the Order relation
 *
 * @method     ChildShipmentQuery joinWithOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Order relation
 *
 * @method     ChildShipmentQuery leftJoinWithOrder() Adds a LEFT JOIN clause and with to the query using the Order relation
 * @method     ChildShipmentQuery rightJoinWithOrder() Adds a RIGHT JOIN clause and with to the query using the Order relation
 * @method     ChildShipmentQuery innerJoinWithOrder() Adds a INNER JOIN clause and with to the query using the Order relation
 *
 * @method     \ShipmentMethodQuery|\OrderQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildShipment findOne(ConnectionInterface $con = null) Return the first ChildShipment matching the query
 * @method     ChildShipment findOneOrCreate(ConnectionInterface $con = null) Return the first ChildShipment matching the query, or a new ChildShipment object populated from the query conditions when no match is found
 *
 * @method     ChildShipment findOneById(int $id) Return the first ChildShipment filtered by the id column
 * @method     ChildShipment findOneByStatus(int $status) Return the first ChildShipment filtered by the status column
 * @method     ChildShipment findOneByAmountHt(string $amount_ht) Return the first ChildShipment filtered by the amount_ht column
 * @method     ChildShipment findOneByAmountTtc(string $amount_ttc) Return the first ChildShipment filtered by the amount_ttc column
 * @method     ChildShipment findOneByShipmentMethodId(int $shipment_method_id) Return the first ChildShipment filtered by the shipment_method_id column *

 * @method     ChildShipment requirePk($key, ConnectionInterface $con = null) Return the ChildShipment by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipment requireOne(ConnectionInterface $con = null) Return the first ChildShipment matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipment requireOneById(int $id) Return the first ChildShipment filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipment requireOneByStatus(int $status) Return the first ChildShipment filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipment requireOneByAmountHt(string $amount_ht) Return the first ChildShipment filtered by the amount_ht column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipment requireOneByAmountTtc(string $amount_ttc) Return the first ChildShipment filtered by the amount_ttc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipment requireOneByShipmentMethodId(int $shipment_method_id) Return the first ChildShipment filtered by the shipment_method_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipment[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildShipment objects based on current ModelCriteria
 * @method     ChildShipment[]|ObjectCollection findById(int $id) Return ChildShipment objects filtered by the id column
 * @method     ChildShipment[]|ObjectCollection findByStatus(int $status) Return ChildShipment objects filtered by the status column
 * @method     ChildShipment[]|ObjectCollection findByAmountHt(string $amount_ht) Return ChildShipment objects filtered by the amount_ht column
 * @method     ChildShipment[]|ObjectCollection findByAmountTtc(string $amount_ttc) Return ChildShipment objects filtered by the amount_ttc column
 * @method     ChildShipment[]|ObjectCollection findByShipmentMethodId(int $shipment_method_id) Return ChildShipment objects filtered by the shipment_method_id column
 * @method     ChildShipment[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ShipmentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ShipmentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ecom', $modelName = '\\Shipment', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildShipmentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildShipmentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildShipmentQuery) {
            return $criteria;
        }
        $query = new ChildShipmentQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $shipment_method_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildShipment|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ShipmentTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ShipmentTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildShipment A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, status, amount_ht, amount_ttc, shipment_method_id FROM shipment WHERE id = :p0 AND shipment_method_id = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildShipment $obj */
            $obj = new ChildShipment();
            $obj->hydrate($row);
            ShipmentTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildShipment|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildShipmentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ShipmentTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ShipmentTableMap::COL_SHIPMENT_METHOD_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildShipmentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ShipmentTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ShipmentTableMap::COL_SHIPMENT_METHOD_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildShipmentQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ShipmentTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ShipmentTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildShipmentQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(ShipmentTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(ShipmentTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the amount_ht column
     *
     * Example usage:
     * <code>
     * $query->filterByAmountHt(1234); // WHERE amount_ht = 1234
     * $query->filterByAmountHt(array(12, 34)); // WHERE amount_ht IN (12, 34)
     * $query->filterByAmountHt(array('min' => 12)); // WHERE amount_ht > 12
     * </code>
     *
     * @param     mixed $amountHt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentQuery The current query, for fluid interface
     */
    public function filterByAmountHt($amountHt = null, $comparison = null)
    {
        if (is_array($amountHt)) {
            $useMinMax = false;
            if (isset($amountHt['min'])) {
                $this->addUsingAlias(ShipmentTableMap::COL_AMOUNT_HT, $amountHt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amountHt['max'])) {
                $this->addUsingAlias(ShipmentTableMap::COL_AMOUNT_HT, $amountHt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentTableMap::COL_AMOUNT_HT, $amountHt, $comparison);
    }

    /**
     * Filter the query on the amount_ttc column
     *
     * Example usage:
     * <code>
     * $query->filterByAmountTtc(1234); // WHERE amount_ttc = 1234
     * $query->filterByAmountTtc(array(12, 34)); // WHERE amount_ttc IN (12, 34)
     * $query->filterByAmountTtc(array('min' => 12)); // WHERE amount_ttc > 12
     * </code>
     *
     * @param     mixed $amountTtc The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentQuery The current query, for fluid interface
     */
    public function filterByAmountTtc($amountTtc = null, $comparison = null)
    {
        if (is_array($amountTtc)) {
            $useMinMax = false;
            if (isset($amountTtc['min'])) {
                $this->addUsingAlias(ShipmentTableMap::COL_AMOUNT_TTC, $amountTtc['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amountTtc['max'])) {
                $this->addUsingAlias(ShipmentTableMap::COL_AMOUNT_TTC, $amountTtc['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentTableMap::COL_AMOUNT_TTC, $amountTtc, $comparison);
    }

    /**
     * Filter the query on the shipment_method_id column
     *
     * Example usage:
     * <code>
     * $query->filterByShipmentMethodId(1234); // WHERE shipment_method_id = 1234
     * $query->filterByShipmentMethodId(array(12, 34)); // WHERE shipment_method_id IN (12, 34)
     * $query->filterByShipmentMethodId(array('min' => 12)); // WHERE shipment_method_id > 12
     * </code>
     *
     * @see       filterByShipmentMethod()
     *
     * @param     mixed $shipmentMethodId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentQuery The current query, for fluid interface
     */
    public function filterByShipmentMethodId($shipmentMethodId = null, $comparison = null)
    {
        if (is_array($shipmentMethodId)) {
            $useMinMax = false;
            if (isset($shipmentMethodId['min'])) {
                $this->addUsingAlias(ShipmentTableMap::COL_SHIPMENT_METHOD_ID, $shipmentMethodId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shipmentMethodId['max'])) {
                $this->addUsingAlias(ShipmentTableMap::COL_SHIPMENT_METHOD_ID, $shipmentMethodId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentTableMap::COL_SHIPMENT_METHOD_ID, $shipmentMethodId, $comparison);
    }

    /**
     * Filter the query by a related \ShipmentMethod object
     *
     * @param \ShipmentMethod|ObjectCollection $shipmentMethod The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildShipmentQuery The current query, for fluid interface
     */
    public function filterByShipmentMethod($shipmentMethod, $comparison = null)
    {
        if ($shipmentMethod instanceof \ShipmentMethod) {
            return $this
                ->addUsingAlias(ShipmentTableMap::COL_SHIPMENT_METHOD_ID, $shipmentMethod->getId(), $comparison);
        } elseif ($shipmentMethod instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ShipmentTableMap::COL_SHIPMENT_METHOD_ID, $shipmentMethod->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByShipmentMethod() only accepts arguments of type \ShipmentMethod or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ShipmentMethod relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildShipmentQuery The current query, for fluid interface
     */
    public function joinShipmentMethod($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ShipmentMethod');

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
            $this->addJoinObject($join, 'ShipmentMethod');
        }

        return $this;
    }

    /**
     * Use the ShipmentMethod relation ShipmentMethod object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ShipmentMethodQuery A secondary query class using the current class as primary query
     */
    public function useShipmentMethodQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShipmentMethod($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ShipmentMethod', '\ShipmentMethodQuery');
    }

    /**
     * Filter the query by a related \Order object
     *
     * @param \Order|ObjectCollection $order the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildShipmentQuery The current query, for fluid interface
     */
    public function filterByOrder($order, $comparison = null)
    {
        if ($order instanceof \Order) {
            return $this
                ->addUsingAlias(ShipmentTableMap::COL_ID, $order->getShipmentId(), $comparison);
        } elseif ($order instanceof ObjectCollection) {
            return $this
                ->useOrderQuery()
                ->filterByPrimaryKeys($order->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOrder() only accepts arguments of type \Order or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Order relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildShipmentQuery The current query, for fluid interface
     */
    public function joinOrder($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Order');

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
            $this->addJoinObject($join, 'Order');
        }

        return $this;
    }

    /**
     * Use the Order relation Order object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrderQuery A secondary query class using the current class as primary query
     */
    public function useOrderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Order', '\OrderQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildShipment $shipment Object to remove from the list of results
     *
     * @return $this|ChildShipmentQuery The current query, for fluid interface
     */
    public function prune($shipment = null)
    {
        if ($shipment) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ShipmentTableMap::COL_ID), $shipment->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ShipmentTableMap::COL_SHIPMENT_METHOD_ID), $shipment->getShipmentMethodId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the shipment table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ShipmentTableMap::clearInstancePool();
            ShipmentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ShipmentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ShipmentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ShipmentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ShipmentQuery
