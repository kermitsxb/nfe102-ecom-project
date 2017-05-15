<?php

namespace Base;

use \Product as ChildProduct;
use \ProductQuery as ChildProductQuery;
use \Exception;
use \PDO;
use Map\ProductTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'product' table.
 *
 *
 *
 * @method     ChildProductQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProductQuery orderByLabel($order = Criteria::ASC) Order by the label column
 * @method     ChildProductQuery orderByDateCreation($order = Criteria::ASC) Order by the date_creation column
 * @method     ChildProductQuery orderByDateModification($order = Criteria::ASC) Order by the date_modification column
 * @method     ChildProductQuery orderByStartPublicationDate($order = Criteria::ASC) Order by the start_publication_date column
 * @method     ChildProductQuery orderByEndPublicationDate($order = Criteria::ASC) Order by the end_publication_date column
 * @method     ChildProductQuery orderBySku($order = Criteria::ASC) Order by the sku column
 * @method     ChildProductQuery orderByWeight($order = Criteria::ASC) Order by the weight column
 * @method     ChildProductQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildProductQuery orderByProductShelfId($order = Criteria::ASC) Order by the product_shelf_id column
 * @method     ChildProductQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method     ChildProductQuery groupById() Group by the id column
 * @method     ChildProductQuery groupByLabel() Group by the label column
 * @method     ChildProductQuery groupByDateCreation() Group by the date_creation column
 * @method     ChildProductQuery groupByDateModification() Group by the date_modification column
 * @method     ChildProductQuery groupByStartPublicationDate() Group by the start_publication_date column
 * @method     ChildProductQuery groupByEndPublicationDate() Group by the end_publication_date column
 * @method     ChildProductQuery groupBySku() Group by the sku column
 * @method     ChildProductQuery groupByWeight() Group by the weight column
 * @method     ChildProductQuery groupByStatus() Group by the status column
 * @method     ChildProductQuery groupByProductShelfId() Group by the product_shelf_id column
 * @method     ChildProductQuery groupByDescription() Group by the description column
 *
 * @method     ChildProductQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductQuery leftJoinProductShelf($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductShelf relation
 * @method     ChildProductQuery rightJoinProductShelf($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductShelf relation
 * @method     ChildProductQuery innerJoinProductShelf($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductShelf relation
 *
 * @method     ChildProductQuery joinWithProductShelf($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductShelf relation
 *
 * @method     ChildProductQuery leftJoinWithProductShelf() Adds a LEFT JOIN clause and with to the query using the ProductShelf relation
 * @method     ChildProductQuery rightJoinWithProductShelf() Adds a RIGHT JOIN clause and with to the query using the ProductShelf relation
 * @method     ChildProductQuery innerJoinWithProductShelf() Adds a INNER JOIN clause and with to the query using the ProductShelf relation
 *
 * @method     ChildProductQuery leftJoinMedia($relationAlias = null) Adds a LEFT JOIN clause to the query using the Media relation
 * @method     ChildProductQuery rightJoinMedia($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Media relation
 * @method     ChildProductQuery innerJoinMedia($relationAlias = null) Adds a INNER JOIN clause to the query using the Media relation
 *
 * @method     ChildProductQuery joinWithMedia($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Media relation
 *
 * @method     ChildProductQuery leftJoinWithMedia() Adds a LEFT JOIN clause and with to the query using the Media relation
 * @method     ChildProductQuery rightJoinWithMedia() Adds a RIGHT JOIN clause and with to the query using the Media relation
 * @method     ChildProductQuery innerJoinWithMedia() Adds a INNER JOIN clause and with to the query using the Media relation
 *
 * @method     ChildProductQuery leftJoinOrderLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderLine relation
 * @method     ChildProductQuery rightJoinOrderLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderLine relation
 * @method     ChildProductQuery innerJoinOrderLine($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderLine relation
 *
 * @method     ChildProductQuery joinWithOrderLine($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderLine relation
 *
 * @method     ChildProductQuery leftJoinWithOrderLine() Adds a LEFT JOIN clause and with to the query using the OrderLine relation
 * @method     ChildProductQuery rightJoinWithOrderLine() Adds a RIGHT JOIN clause and with to the query using the OrderLine relation
 * @method     ChildProductQuery innerJoinWithOrderLine() Adds a INNER JOIN clause and with to the query using the OrderLine relation
 *
 * @method     ChildProductQuery leftJoinProductPrice($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductPrice relation
 * @method     ChildProductQuery rightJoinProductPrice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductPrice relation
 * @method     ChildProductQuery innerJoinProductPrice($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductPrice relation
 *
 * @method     ChildProductQuery joinWithProductPrice($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductPrice relation
 *
 * @method     ChildProductQuery leftJoinWithProductPrice() Adds a LEFT JOIN clause and with to the query using the ProductPrice relation
 * @method     ChildProductQuery rightJoinWithProductPrice() Adds a RIGHT JOIN clause and with to the query using the ProductPrice relation
 * @method     ChildProductQuery innerJoinWithProductPrice() Adds a INNER JOIN clause and with to the query using the ProductPrice relation
 *
 * @method     ChildProductQuery leftJoinProductStock($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductStock relation
 * @method     ChildProductQuery rightJoinProductStock($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductStock relation
 * @method     ChildProductQuery innerJoinProductStock($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductStock relation
 *
 * @method     ChildProductQuery joinWithProductStock($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductStock relation
 *
 * @method     ChildProductQuery leftJoinWithProductStock() Adds a LEFT JOIN clause and with to the query using the ProductStock relation
 * @method     ChildProductQuery rightJoinWithProductStock() Adds a RIGHT JOIN clause and with to the query using the ProductStock relation
 * @method     ChildProductQuery innerJoinWithProductStock() Adds a INNER JOIN clause and with to the query using the ProductStock relation
 *
 * @method     \ProductShelfQuery|\MediaQuery|\OrderLineQuery|\ProductPriceQuery|\ProductStockQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProduct findOne(ConnectionInterface $con = null) Return the first ChildProduct matching the query
 * @method     ChildProduct findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProduct matching the query, or a new ChildProduct object populated from the query conditions when no match is found
 *
 * @method     ChildProduct findOneById(int $id) Return the first ChildProduct filtered by the id column
 * @method     ChildProduct findOneByLabel(string $label) Return the first ChildProduct filtered by the label column
 * @method     ChildProduct findOneByDateCreation(string $date_creation) Return the first ChildProduct filtered by the date_creation column
 * @method     ChildProduct findOneByDateModification(string $date_modification) Return the first ChildProduct filtered by the date_modification column
 * @method     ChildProduct findOneByStartPublicationDate(string $start_publication_date) Return the first ChildProduct filtered by the start_publication_date column
 * @method     ChildProduct findOneByEndPublicationDate(string $end_publication_date) Return the first ChildProduct filtered by the end_publication_date column
 * @method     ChildProduct findOneBySku(string $sku) Return the first ChildProduct filtered by the sku column
 * @method     ChildProduct findOneByWeight(string $weight) Return the first ChildProduct filtered by the weight column
 * @method     ChildProduct findOneByStatus(int $status) Return the first ChildProduct filtered by the status column
 * @method     ChildProduct findOneByProductShelfId(int $product_shelf_id) Return the first ChildProduct filtered by the product_shelf_id column
 * @method     ChildProduct findOneByDescription(string $description) Return the first ChildProduct filtered by the description column *

 * @method     ChildProduct requirePk($key, ConnectionInterface $con = null) Return the ChildProduct by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOne(ConnectionInterface $con = null) Return the first ChildProduct matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduct requireOneById(int $id) Return the first ChildProduct filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByLabel(string $label) Return the first ChildProduct filtered by the label column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByDateCreation(string $date_creation) Return the first ChildProduct filtered by the date_creation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByDateModification(string $date_modification) Return the first ChildProduct filtered by the date_modification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByStartPublicationDate(string $start_publication_date) Return the first ChildProduct filtered by the start_publication_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByEndPublicationDate(string $end_publication_date) Return the first ChildProduct filtered by the end_publication_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneBySku(string $sku) Return the first ChildProduct filtered by the sku column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByWeight(string $weight) Return the first ChildProduct filtered by the weight column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByStatus(int $status) Return the first ChildProduct filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByProductShelfId(int $product_shelf_id) Return the first ChildProduct filtered by the product_shelf_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByDescription(string $description) Return the first ChildProduct filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduct[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProduct objects based on current ModelCriteria
 * @method     ChildProduct[]|ObjectCollection findById(int $id) Return ChildProduct objects filtered by the id column
 * @method     ChildProduct[]|ObjectCollection findByLabel(string $label) Return ChildProduct objects filtered by the label column
 * @method     ChildProduct[]|ObjectCollection findByDateCreation(string $date_creation) Return ChildProduct objects filtered by the date_creation column
 * @method     ChildProduct[]|ObjectCollection findByDateModification(string $date_modification) Return ChildProduct objects filtered by the date_modification column
 * @method     ChildProduct[]|ObjectCollection findByStartPublicationDate(string $start_publication_date) Return ChildProduct objects filtered by the start_publication_date column
 * @method     ChildProduct[]|ObjectCollection findByEndPublicationDate(string $end_publication_date) Return ChildProduct objects filtered by the end_publication_date column
 * @method     ChildProduct[]|ObjectCollection findBySku(string $sku) Return ChildProduct objects filtered by the sku column
 * @method     ChildProduct[]|ObjectCollection findByWeight(string $weight) Return ChildProduct objects filtered by the weight column
 * @method     ChildProduct[]|ObjectCollection findByStatus(int $status) Return ChildProduct objects filtered by the status column
 * @method     ChildProduct[]|ObjectCollection findByProductShelfId(int $product_shelf_id) Return ChildProduct objects filtered by the product_shelf_id column
 * @method     ChildProduct[]|ObjectCollection findByDescription(string $description) Return ChildProduct objects filtered by the description column
 * @method     ChildProduct[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProductQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ecom', $modelName = '\\Product', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductQuery) {
            return $criteria;
        }
        $query = new ChildProductQuery();
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
     * @param array[$id, $product_shelf_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildProduct|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildProduct A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, label, date_creation, date_modification, start_publication_date, end_publication_date, sku, weight, status, product_shelf_id, description FROM product WHERE id = :p0 AND product_shelf_id = :p1';
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
            /** @var ChildProduct $obj */
            $obj = new ChildProduct();
            $obj->hydrate($row);
            ProductTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildProduct|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ProductTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ProductTableMap::COL_PRODUCT_SHELF_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ProductTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ProductTableMap::COL_PRODUCT_SHELF_ID, $key[1], Criteria::EQUAL);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByLabel($label = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($label)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_LABEL, $label, $comparison);
    }

    /**
     * Filter the query on the date_creation column
     *
     * Example usage:
     * <code>
     * $query->filterByDateCreation('2011-03-14'); // WHERE date_creation = '2011-03-14'
     * $query->filterByDateCreation('now'); // WHERE date_creation = '2011-03-14'
     * $query->filterByDateCreation(array('max' => 'yesterday')); // WHERE date_creation > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateCreation The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByDateCreation($dateCreation = null, $comparison = null)
    {
        if (is_array($dateCreation)) {
            $useMinMax = false;
            if (isset($dateCreation['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_DATE_CREATION, $dateCreation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateCreation['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_DATE_CREATION, $dateCreation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_DATE_CREATION, $dateCreation, $comparison);
    }

    /**
     * Filter the query on the date_modification column
     *
     * Example usage:
     * <code>
     * $query->filterByDateModification('2011-03-14'); // WHERE date_modification = '2011-03-14'
     * $query->filterByDateModification('now'); // WHERE date_modification = '2011-03-14'
     * $query->filterByDateModification(array('max' => 'yesterday')); // WHERE date_modification > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateModification The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByDateModification($dateModification = null, $comparison = null)
    {
        if (is_array($dateModification)) {
            $useMinMax = false;
            if (isset($dateModification['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_DATE_MODIFICATION, $dateModification['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateModification['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_DATE_MODIFICATION, $dateModification['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_DATE_MODIFICATION, $dateModification, $comparison);
    }

    /**
     * Filter the query on the start_publication_date column
     *
     * Example usage:
     * <code>
     * $query->filterByStartPublicationDate('2011-03-14'); // WHERE start_publication_date = '2011-03-14'
     * $query->filterByStartPublicationDate('now'); // WHERE start_publication_date = '2011-03-14'
     * $query->filterByStartPublicationDate(array('max' => 'yesterday')); // WHERE start_publication_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $startPublicationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByStartPublicationDate($startPublicationDate = null, $comparison = null)
    {
        if (is_array($startPublicationDate)) {
            $useMinMax = false;
            if (isset($startPublicationDate['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_START_PUBLICATION_DATE, $startPublicationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startPublicationDate['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_START_PUBLICATION_DATE, $startPublicationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_START_PUBLICATION_DATE, $startPublicationDate, $comparison);
    }

    /**
     * Filter the query on the end_publication_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEndPublicationDate('2011-03-14'); // WHERE end_publication_date = '2011-03-14'
     * $query->filterByEndPublicationDate('now'); // WHERE end_publication_date = '2011-03-14'
     * $query->filterByEndPublicationDate(array('max' => 'yesterday')); // WHERE end_publication_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $endPublicationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByEndPublicationDate($endPublicationDate = null, $comparison = null)
    {
        if (is_array($endPublicationDate)) {
            $useMinMax = false;
            if (isset($endPublicationDate['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_END_PUBLICATION_DATE, $endPublicationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endPublicationDate['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_END_PUBLICATION_DATE, $endPublicationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_END_PUBLICATION_DATE, $endPublicationDate, $comparison);
    }

    /**
     * Filter the query on the sku column
     *
     * Example usage:
     * <code>
     * $query->filterBySku('fooValue');   // WHERE sku = 'fooValue'
     * $query->filterBySku('%fooValue%', Criteria::LIKE); // WHERE sku LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sku The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterBySku($sku = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sku)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_SKU, $sku, $comparison);
    }

    /**
     * Filter the query on the weight column
     *
     * Example usage:
     * <code>
     * $query->filterByWeight(1234); // WHERE weight = 1234
     * $query->filterByWeight(array(12, 34)); // WHERE weight IN (12, 34)
     * $query->filterByWeight(array('min' => 12)); // WHERE weight > 12
     * </code>
     *
     * @param     mixed $weight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByWeight($weight = null, $comparison = null)
    {
        if (is_array($weight)) {
            $useMinMax = false;
            if (isset($weight['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_WEIGHT, $weight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($weight['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_WEIGHT, $weight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_WEIGHT, $weight, $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the product_shelf_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductShelfId(1234); // WHERE product_shelf_id = 1234
     * $query->filterByProductShelfId(array(12, 34)); // WHERE product_shelf_id IN (12, 34)
     * $query->filterByProductShelfId(array('min' => 12)); // WHERE product_shelf_id > 12
     * </code>
     *
     * @see       filterByProductShelf()
     *
     * @param     mixed $productShelfId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductShelfId($productShelfId = null, $comparison = null)
    {
        if (is_array($productShelfId)) {
            $useMinMax = false;
            if (isset($productShelfId['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_SHELF_ID, $productShelfId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productShelfId['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_SHELF_ID, $productShelfId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_SHELF_ID, $productShelfId, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query by a related \ProductShelf object
     *
     * @param \ProductShelf|ObjectCollection $productShelf The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductShelf($productShelf, $comparison = null)
    {
        if ($productShelf instanceof \ProductShelf) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_PRODUCT_SHELF_ID, $productShelf->getId(), $comparison);
        } elseif ($productShelf instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductTableMap::COL_PRODUCT_SHELF_ID, $productShelf->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProductShelf() only accepts arguments of type \ProductShelf or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductShelf relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProductShelf($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductShelf');

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
            $this->addJoinObject($join, 'ProductShelf');
        }

        return $this;
    }

    /**
     * Use the ProductShelf relation ProductShelf object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductShelfQuery A secondary query class using the current class as primary query
     */
    public function useProductShelfQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductShelf($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductShelf', '\ProductShelfQuery');
    }

    /**
     * Filter the query by a related \Media object
     *
     * @param \Media|ObjectCollection $media the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByMedia($media, $comparison = null)
    {
        if ($media instanceof \Media) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_ID, $media->getProductId(), $comparison);
        } elseif ($media instanceof ObjectCollection) {
            return $this
                ->useMediaQuery()
                ->filterByPrimaryKeys($media->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMedia() only accepts arguments of type \Media or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Media relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinMedia($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Media');

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
            $this->addJoinObject($join, 'Media');
        }

        return $this;
    }

    /**
     * Use the Media relation Media object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MediaQuery A secondary query class using the current class as primary query
     */
    public function useMediaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMedia($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Media', '\MediaQuery');
    }

    /**
     * Filter the query by a related \OrderLine object
     *
     * @param \OrderLine|ObjectCollection $orderLine the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByOrderLine($orderLine, $comparison = null)
    {
        if ($orderLine instanceof \OrderLine) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_ID, $orderLine->getProductId(), $comparison);
        } elseif ($orderLine instanceof ObjectCollection) {
            return $this
                ->useOrderLineQuery()
                ->filterByPrimaryKeys($orderLine->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOrderLine() only accepts arguments of type \OrderLine or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderLine relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinOrderLine($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderLine');

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
            $this->addJoinObject($join, 'OrderLine');
        }

        return $this;
    }

    /**
     * Use the OrderLine relation OrderLine object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrderLineQuery A secondary query class using the current class as primary query
     */
    public function useOrderLineQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderLine($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderLine', '\OrderLineQuery');
    }

    /**
     * Filter the query by a related \ProductPrice object
     *
     * @param \ProductPrice|ObjectCollection $productPrice the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductPrice($productPrice, $comparison = null)
    {
        if ($productPrice instanceof \ProductPrice) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_ID, $productPrice->getProductId(), $comparison);
        } elseif ($productPrice instanceof ObjectCollection) {
            return $this
                ->useProductPriceQuery()
                ->filterByPrimaryKeys($productPrice->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductPrice() only accepts arguments of type \ProductPrice or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductPrice relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProductPrice($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductPrice');

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
            $this->addJoinObject($join, 'ProductPrice');
        }

        return $this;
    }

    /**
     * Use the ProductPrice relation ProductPrice object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductPriceQuery A secondary query class using the current class as primary query
     */
    public function useProductPriceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductPrice($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductPrice', '\ProductPriceQuery');
    }

    /**
     * Filter the query by a related \ProductStock object
     *
     * @param \ProductStock|ObjectCollection $productStock the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductStock($productStock, $comparison = null)
    {
        if ($productStock instanceof \ProductStock) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_ID, $productStock->getProductId(), $comparison);
        } elseif ($productStock instanceof ObjectCollection) {
            return $this
                ->useProductStockQuery()
                ->filterByPrimaryKeys($productStock->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductStock() only accepts arguments of type \ProductStock or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductStock relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProductStock($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductStock');

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
            $this->addJoinObject($join, 'ProductStock');
        }

        return $this;
    }

    /**
     * Use the ProductStock relation ProductStock object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductStockQuery A secondary query class using the current class as primary query
     */
    public function useProductStockQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductStock($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductStock', '\ProductStockQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProduct $product Object to remove from the list of results
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function prune($product = null)
    {
        if ($product) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ProductTableMap::COL_ID), $product->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ProductTableMap::COL_PRODUCT_SHELF_ID), $product->getProductShelfId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductTableMap::clearInstancePool();
            ProductTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProductQuery
