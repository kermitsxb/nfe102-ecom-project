<?php

namespace Base;

use \ShipmentWeightGrid as ChildShipmentWeightGrid;
use \ShipmentWeightGridQuery as ChildShipmentWeightGridQuery;
use \Exception;
use \PDO;
use Map\ShipmentWeightGridTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'shipment_weight_grid' table.
 *
 *
 *
 * @method     ChildShipmentWeightGridQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildShipmentWeightGridQuery orderByMaxWeight($order = Criteria::ASC) Order by the max_weight column
 * @method     ChildShipmentWeightGridQuery orderByPriceHt($order = Criteria::ASC) Order by the price_ht column
 * @method     ChildShipmentWeightGridQuery orderByPricettc($order = Criteria::ASC) Order by the pricettc column
 * @method     ChildShipmentWeightGridQuery orderByShipmentMethodId($order = Criteria::ASC) Order by the shipment_method_id column
 * @method     ChildShipmentWeightGridQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method     ChildShipmentWeightGridQuery groupById() Group by the id column
 * @method     ChildShipmentWeightGridQuery groupByMaxWeight() Group by the max_weight column
 * @method     ChildShipmentWeightGridQuery groupByPriceHt() Group by the price_ht column
 * @method     ChildShipmentWeightGridQuery groupByPricettc() Group by the pricettc column
 * @method     ChildShipmentWeightGridQuery groupByShipmentMethodId() Group by the shipment_method_id column
 * @method     ChildShipmentWeightGridQuery groupByStatus() Group by the status column
 *
 * @method     ChildShipmentWeightGridQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildShipmentWeightGridQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildShipmentWeightGridQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildShipmentWeightGridQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildShipmentWeightGridQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildShipmentWeightGridQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildShipmentWeightGridQuery leftJoinShipmentMethod($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShipmentMethod relation
 * @method     ChildShipmentWeightGridQuery rightJoinShipmentMethod($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShipmentMethod relation
 * @method     ChildShipmentWeightGridQuery innerJoinShipmentMethod($relationAlias = null) Adds a INNER JOIN clause to the query using the ShipmentMethod relation
 *
 * @method     ChildShipmentWeightGridQuery joinWithShipmentMethod($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ShipmentMethod relation
 *
 * @method     ChildShipmentWeightGridQuery leftJoinWithShipmentMethod() Adds a LEFT JOIN clause and with to the query using the ShipmentMethod relation
 * @method     ChildShipmentWeightGridQuery rightJoinWithShipmentMethod() Adds a RIGHT JOIN clause and with to the query using the ShipmentMethod relation
 * @method     ChildShipmentWeightGridQuery innerJoinWithShipmentMethod() Adds a INNER JOIN clause and with to the query using the ShipmentMethod relation
 *
 * @method     \ShipmentMethodQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildShipmentWeightGrid findOne(ConnectionInterface $con = null) Return the first ChildShipmentWeightGrid matching the query
 * @method     ChildShipmentWeightGrid findOneOrCreate(ConnectionInterface $con = null) Return the first ChildShipmentWeightGrid matching the query, or a new ChildShipmentWeightGrid object populated from the query conditions when no match is found
 *
 * @method     ChildShipmentWeightGrid findOneById(int $id) Return the first ChildShipmentWeightGrid filtered by the id column
 * @method     ChildShipmentWeightGrid findOneByMaxWeight(string $max_weight) Return the first ChildShipmentWeightGrid filtered by the max_weight column
 * @method     ChildShipmentWeightGrid findOneByPriceHt(string $price_ht) Return the first ChildShipmentWeightGrid filtered by the price_ht column
 * @method     ChildShipmentWeightGrid findOneByPricettc(string $pricettc) Return the first ChildShipmentWeightGrid filtered by the pricettc column
 * @method     ChildShipmentWeightGrid findOneByShipmentMethodId(int $shipment_method_id) Return the first ChildShipmentWeightGrid filtered by the shipment_method_id column
 * @method     ChildShipmentWeightGrid findOneByStatus(int $status) Return the first ChildShipmentWeightGrid filtered by the status column *

 * @method     ChildShipmentWeightGrid requirePk($key, ConnectionInterface $con = null) Return the ChildShipmentWeightGrid by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentWeightGrid requireOne(ConnectionInterface $con = null) Return the first ChildShipmentWeightGrid matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipmentWeightGrid requireOneById(int $id) Return the first ChildShipmentWeightGrid filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentWeightGrid requireOneByMaxWeight(string $max_weight) Return the first ChildShipmentWeightGrid filtered by the max_weight column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentWeightGrid requireOneByPriceHt(string $price_ht) Return the first ChildShipmentWeightGrid filtered by the price_ht column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentWeightGrid requireOneByPricettc(string $pricettc) Return the first ChildShipmentWeightGrid filtered by the pricettc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentWeightGrid requireOneByShipmentMethodId(int $shipment_method_id) Return the first ChildShipmentWeightGrid filtered by the shipment_method_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipmentWeightGrid requireOneByStatus(int $status) Return the first ChildShipmentWeightGrid filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipmentWeightGrid[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildShipmentWeightGrid objects based on current ModelCriteria
 * @method     ChildShipmentWeightGrid[]|ObjectCollection findById(int $id) Return ChildShipmentWeightGrid objects filtered by the id column
 * @method     ChildShipmentWeightGrid[]|ObjectCollection findByMaxWeight(string $max_weight) Return ChildShipmentWeightGrid objects filtered by the max_weight column
 * @method     ChildShipmentWeightGrid[]|ObjectCollection findByPriceHt(string $price_ht) Return ChildShipmentWeightGrid objects filtered by the price_ht column
 * @method     ChildShipmentWeightGrid[]|ObjectCollection findByPricettc(string $pricettc) Return ChildShipmentWeightGrid objects filtered by the pricettc column
 * @method     ChildShipmentWeightGrid[]|ObjectCollection findByShipmentMethodId(int $shipment_method_id) Return ChildShipmentWeightGrid objects filtered by the shipment_method_id column
 * @method     ChildShipmentWeightGrid[]|ObjectCollection findByStatus(int $status) Return ChildShipmentWeightGrid objects filtered by the status column
 * @method     ChildShipmentWeightGrid[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ShipmentWeightGridQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ShipmentWeightGridQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ecom', $modelName = '\\ShipmentWeightGrid', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildShipmentWeightGridQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildShipmentWeightGridQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildShipmentWeightGridQuery) {
            return $criteria;
        }
        $query = new ChildShipmentWeightGridQuery();
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
     * @return ChildShipmentWeightGrid|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ShipmentWeightGridTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ShipmentWeightGridTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildShipmentWeightGrid A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, max_weight, price_ht, pricettc, shipment_method_id, status FROM shipment_weight_grid WHERE id = :p0 AND shipment_method_id = :p1';
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
            /** @var ChildShipmentWeightGrid $obj */
            $obj = new ChildShipmentWeightGrid();
            $obj->hydrate($row);
            ShipmentWeightGridTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildShipmentWeightGrid|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildShipmentWeightGridQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ShipmentWeightGridTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ShipmentWeightGridTableMap::COL_SHIPMENT_METHOD_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildShipmentWeightGridQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ShipmentWeightGridTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ShipmentWeightGridTableMap::COL_SHIPMENT_METHOD_ID, $key[1], Criteria::EQUAL);
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
     * @return $this|ChildShipmentWeightGridQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ShipmentWeightGridTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ShipmentWeightGridTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentWeightGridTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the max_weight column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxWeight(1234); // WHERE max_weight = 1234
     * $query->filterByMaxWeight(array(12, 34)); // WHERE max_weight IN (12, 34)
     * $query->filterByMaxWeight(array('min' => 12)); // WHERE max_weight > 12
     * </code>
     *
     * @param     mixed $maxWeight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentWeightGridQuery The current query, for fluid interface
     */
    public function filterByMaxWeight($maxWeight = null, $comparison = null)
    {
        if (is_array($maxWeight)) {
            $useMinMax = false;
            if (isset($maxWeight['min'])) {
                $this->addUsingAlias(ShipmentWeightGridTableMap::COL_MAX_WEIGHT, $maxWeight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxWeight['max'])) {
                $this->addUsingAlias(ShipmentWeightGridTableMap::COL_MAX_WEIGHT, $maxWeight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentWeightGridTableMap::COL_MAX_WEIGHT, $maxWeight, $comparison);
    }

    /**
     * Filter the query on the price_ht column
     *
     * Example usage:
     * <code>
     * $query->filterByPriceHt(1234); // WHERE price_ht = 1234
     * $query->filterByPriceHt(array(12, 34)); // WHERE price_ht IN (12, 34)
     * $query->filterByPriceHt(array('min' => 12)); // WHERE price_ht > 12
     * </code>
     *
     * @param     mixed $priceHt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentWeightGridQuery The current query, for fluid interface
     */
    public function filterByPriceHt($priceHt = null, $comparison = null)
    {
        if (is_array($priceHt)) {
            $useMinMax = false;
            if (isset($priceHt['min'])) {
                $this->addUsingAlias(ShipmentWeightGridTableMap::COL_PRICE_HT, $priceHt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($priceHt['max'])) {
                $this->addUsingAlias(ShipmentWeightGridTableMap::COL_PRICE_HT, $priceHt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentWeightGridTableMap::COL_PRICE_HT, $priceHt, $comparison);
    }

    /**
     * Filter the query on the pricettc column
     *
     * Example usage:
     * <code>
     * $query->filterByPricettc(1234); // WHERE pricettc = 1234
     * $query->filterByPricettc(array(12, 34)); // WHERE pricettc IN (12, 34)
     * $query->filterByPricettc(array('min' => 12)); // WHERE pricettc > 12
     * </code>
     *
     * @param     mixed $pricettc The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentWeightGridQuery The current query, for fluid interface
     */
    public function filterByPricettc($pricettc = null, $comparison = null)
    {
        if (is_array($pricettc)) {
            $useMinMax = false;
            if (isset($pricettc['min'])) {
                $this->addUsingAlias(ShipmentWeightGridTableMap::COL_PRICETTC, $pricettc['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pricettc['max'])) {
                $this->addUsingAlias(ShipmentWeightGridTableMap::COL_PRICETTC, $pricettc['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentWeightGridTableMap::COL_PRICETTC, $pricettc, $comparison);
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
     * @return $this|ChildShipmentWeightGridQuery The current query, for fluid interface
     */
    public function filterByShipmentMethodId($shipmentMethodId = null, $comparison = null)
    {
        if (is_array($shipmentMethodId)) {
            $useMinMax = false;
            if (isset($shipmentMethodId['min'])) {
                $this->addUsingAlias(ShipmentWeightGridTableMap::COL_SHIPMENT_METHOD_ID, $shipmentMethodId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shipmentMethodId['max'])) {
                $this->addUsingAlias(ShipmentWeightGridTableMap::COL_SHIPMENT_METHOD_ID, $shipmentMethodId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentWeightGridTableMap::COL_SHIPMENT_METHOD_ID, $shipmentMethodId, $comparison);
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
     * @return $this|ChildShipmentWeightGridQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(ShipmentWeightGridTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(ShipmentWeightGridTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentWeightGridTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related \ShipmentMethod object
     *
     * @param \ShipmentMethod|ObjectCollection $shipmentMethod The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildShipmentWeightGridQuery The current query, for fluid interface
     */
    public function filterByShipmentMethod($shipmentMethod, $comparison = null)
    {
        if ($shipmentMethod instanceof \ShipmentMethod) {
            return $this
                ->addUsingAlias(ShipmentWeightGridTableMap::COL_SHIPMENT_METHOD_ID, $shipmentMethod->getId(), $comparison);
        } elseif ($shipmentMethod instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ShipmentWeightGridTableMap::COL_SHIPMENT_METHOD_ID, $shipmentMethod->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildShipmentWeightGridQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildShipmentWeightGrid $shipmentWeightGrid Object to remove from the list of results
     *
     * @return $this|ChildShipmentWeightGridQuery The current query, for fluid interface
     */
    public function prune($shipmentWeightGrid = null)
    {
        if ($shipmentWeightGrid) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ShipmentWeightGridTableMap::COL_ID), $shipmentWeightGrid->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ShipmentWeightGridTableMap::COL_SHIPMENT_METHOD_ID), $shipmentWeightGrid->getShipmentMethodId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the shipment_weight_grid table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentWeightGridTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ShipmentWeightGridTableMap::clearInstancePool();
            ShipmentWeightGridTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentWeightGridTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ShipmentWeightGridTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ShipmentWeightGridTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ShipmentWeightGridTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ShipmentWeightGridQuery
