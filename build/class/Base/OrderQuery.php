<?php

namespace Base;

use \Order as ChildOrder;
use \OrderQuery as ChildOrderQuery;
use \Exception;
use \PDO;
use Map\OrderTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'order' table.
 *
 *
 *
 * @method     ChildOrderQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildOrderQuery orderByCreationDate($order = Criteria::ASC) Order by the creation_date column
 * @method     ChildOrderQuery orderByModificationDate($order = Criteria::ASC) Order by the modification_date column
 * @method     ChildOrderQuery orderByOrdernumber($order = Criteria::ASC) Order by the ordernumber column
 * @method     ChildOrderQuery orderByOrderStatus($order = Criteria::ASC) Order by the order_status column
 * @method     ChildOrderQuery orderByTotalAmountWithTax($order = Criteria::ASC) Order by the total_amount_with_tax column
 * @method     ChildOrderQuery orderByTotalAmountWithoutTax($order = Criteria::ASC) Order by the total_amount_without_tax column
 * @method     ChildOrderQuery orderByCurrencyCode($order = Criteria::ASC) Order by the currency_code column
 * @method     ChildOrderQuery orderByShippingFeeWithTax($order = Criteria::ASC) Order by the shipping_fee_with_tax column
 * @method     ChildOrderQuery orderByShippingFeeWithoutTax($order = Criteria::ASC) Order by the shipping_fee_without_tax column
 * @method     ChildOrderQuery orderByBillingAddressId($order = Criteria::ASC) Order by the billing_address_id column
 * @method     ChildOrderQuery orderByShippingAddressId($order = Criteria::ASC) Order by the shipping_address_id column
 * @method     ChildOrderQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildOrderQuery orderByPaymentId($order = Criteria::ASC) Order by the payment_id column
 * @method     ChildOrderQuery orderByShipmentId($order = Criteria::ASC) Order by the shipment_id column
 * @method     ChildOrderQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method     ChildOrderQuery groupById() Group by the id column
 * @method     ChildOrderQuery groupByCreationDate() Group by the creation_date column
 * @method     ChildOrderQuery groupByModificationDate() Group by the modification_date column
 * @method     ChildOrderQuery groupByOrdernumber() Group by the ordernumber column
 * @method     ChildOrderQuery groupByOrderStatus() Group by the order_status column
 * @method     ChildOrderQuery groupByTotalAmountWithTax() Group by the total_amount_with_tax column
 * @method     ChildOrderQuery groupByTotalAmountWithoutTax() Group by the total_amount_without_tax column
 * @method     ChildOrderQuery groupByCurrencyCode() Group by the currency_code column
 * @method     ChildOrderQuery groupByShippingFeeWithTax() Group by the shipping_fee_with_tax column
 * @method     ChildOrderQuery groupByShippingFeeWithoutTax() Group by the shipping_fee_without_tax column
 * @method     ChildOrderQuery groupByBillingAddressId() Group by the billing_address_id column
 * @method     ChildOrderQuery groupByShippingAddressId() Group by the shipping_address_id column
 * @method     ChildOrderQuery groupByUserId() Group by the user_id column
 * @method     ChildOrderQuery groupByPaymentId() Group by the payment_id column
 * @method     ChildOrderQuery groupByShipmentId() Group by the shipment_id column
 * @method     ChildOrderQuery groupByStatus() Group by the status column
 *
 * @method     ChildOrderQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOrderQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOrderQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOrderQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOrderQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOrderQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOrderQuery leftJoinPayment($relationAlias = null) Adds a LEFT JOIN clause to the query using the Payment relation
 * @method     ChildOrderQuery rightJoinPayment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Payment relation
 * @method     ChildOrderQuery innerJoinPayment($relationAlias = null) Adds a INNER JOIN clause to the query using the Payment relation
 *
 * @method     ChildOrderQuery joinWithPayment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Payment relation
 *
 * @method     ChildOrderQuery leftJoinWithPayment() Adds a LEFT JOIN clause and with to the query using the Payment relation
 * @method     ChildOrderQuery rightJoinWithPayment() Adds a RIGHT JOIN clause and with to the query using the Payment relation
 * @method     ChildOrderQuery innerJoinWithPayment() Adds a INNER JOIN clause and with to the query using the Payment relation
 *
 * @method     ChildOrderQuery leftJoinShipment($relationAlias = null) Adds a LEFT JOIN clause to the query using the Shipment relation
 * @method     ChildOrderQuery rightJoinShipment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Shipment relation
 * @method     ChildOrderQuery innerJoinShipment($relationAlias = null) Adds a INNER JOIN clause to the query using the Shipment relation
 *
 * @method     ChildOrderQuery joinWithShipment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Shipment relation
 *
 * @method     ChildOrderQuery leftJoinWithShipment() Adds a LEFT JOIN clause and with to the query using the Shipment relation
 * @method     ChildOrderQuery rightJoinWithShipment() Adds a RIGHT JOIN clause and with to the query using the Shipment relation
 * @method     ChildOrderQuery innerJoinWithShipment() Adds a INNER JOIN clause and with to the query using the Shipment relation
 *
 * @method     ChildOrderQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildOrderQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildOrderQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildOrderQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildOrderQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildOrderQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildOrderQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     ChildOrderQuery leftJoinOrderLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderLine relation
 * @method     ChildOrderQuery rightJoinOrderLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderLine relation
 * @method     ChildOrderQuery innerJoinOrderLine($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderLine relation
 *
 * @method     ChildOrderQuery joinWithOrderLine($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderLine relation
 *
 * @method     ChildOrderQuery leftJoinWithOrderLine() Adds a LEFT JOIN clause and with to the query using the OrderLine relation
 * @method     ChildOrderQuery rightJoinWithOrderLine() Adds a RIGHT JOIN clause and with to the query using the OrderLine relation
 * @method     ChildOrderQuery innerJoinWithOrderLine() Adds a INNER JOIN clause and with to the query using the OrderLine relation
 *
 * @method     \PaymentQuery|\ShipmentQuery|\UserQuery|\OrderLineQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOrder findOne(ConnectionInterface $con = null) Return the first ChildOrder matching the query
 * @method     ChildOrder findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOrder matching the query, or a new ChildOrder object populated from the query conditions when no match is found
 *
 * @method     ChildOrder findOneById(int $id) Return the first ChildOrder filtered by the id column
 * @method     ChildOrder findOneByCreationDate(string $creation_date) Return the first ChildOrder filtered by the creation_date column
 * @method     ChildOrder findOneByModificationDate(string $modification_date) Return the first ChildOrder filtered by the modification_date column
 * @method     ChildOrder findOneByOrdernumber(string $ordernumber) Return the first ChildOrder filtered by the ordernumber column
 * @method     ChildOrder findOneByOrderStatus(int $order_status) Return the first ChildOrder filtered by the order_status column
 * @method     ChildOrder findOneByTotalAmountWithTax(string $total_amount_with_tax) Return the first ChildOrder filtered by the total_amount_with_tax column
 * @method     ChildOrder findOneByTotalAmountWithoutTax(string $total_amount_without_tax) Return the first ChildOrder filtered by the total_amount_without_tax column
 * @method     ChildOrder findOneByCurrencyCode(string $currency_code) Return the first ChildOrder filtered by the currency_code column
 * @method     ChildOrder findOneByShippingFeeWithTax(string $shipping_fee_with_tax) Return the first ChildOrder filtered by the shipping_fee_with_tax column
 * @method     ChildOrder findOneByShippingFeeWithoutTax(string $shipping_fee_without_tax) Return the first ChildOrder filtered by the shipping_fee_without_tax column
 * @method     ChildOrder findOneByBillingAddressId(int $billing_address_id) Return the first ChildOrder filtered by the billing_address_id column
 * @method     ChildOrder findOneByShippingAddressId(int $shipping_address_id) Return the first ChildOrder filtered by the shipping_address_id column
 * @method     ChildOrder findOneByUserId(int $user_id) Return the first ChildOrder filtered by the user_id column
 * @method     ChildOrder findOneByPaymentId(int $payment_id) Return the first ChildOrder filtered by the payment_id column
 * @method     ChildOrder findOneByShipmentId(int $shipment_id) Return the first ChildOrder filtered by the shipment_id column
 * @method     ChildOrder findOneByStatus(int $status) Return the first ChildOrder filtered by the status column *

 * @method     ChildOrder requirePk($key, ConnectionInterface $con = null) Return the ChildOrder by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOne(ConnectionInterface $con = null) Return the first ChildOrder matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrder requireOneById(int $id) Return the first ChildOrder filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByCreationDate(string $creation_date) Return the first ChildOrder filtered by the creation_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByModificationDate(string $modification_date) Return the first ChildOrder filtered by the modification_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByOrdernumber(string $ordernumber) Return the first ChildOrder filtered by the ordernumber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByOrderStatus(int $order_status) Return the first ChildOrder filtered by the order_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByTotalAmountWithTax(string $total_amount_with_tax) Return the first ChildOrder filtered by the total_amount_with_tax column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByTotalAmountWithoutTax(string $total_amount_without_tax) Return the first ChildOrder filtered by the total_amount_without_tax column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByCurrencyCode(string $currency_code) Return the first ChildOrder filtered by the currency_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByShippingFeeWithTax(string $shipping_fee_with_tax) Return the first ChildOrder filtered by the shipping_fee_with_tax column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByShippingFeeWithoutTax(string $shipping_fee_without_tax) Return the first ChildOrder filtered by the shipping_fee_without_tax column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByBillingAddressId(int $billing_address_id) Return the first ChildOrder filtered by the billing_address_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByShippingAddressId(int $shipping_address_id) Return the first ChildOrder filtered by the shipping_address_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByUserId(int $user_id) Return the first ChildOrder filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByPaymentId(int $payment_id) Return the first ChildOrder filtered by the payment_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByShipmentId(int $shipment_id) Return the first ChildOrder filtered by the shipment_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrder requireOneByStatus(int $status) Return the first ChildOrder filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrder[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOrder objects based on current ModelCriteria
 * @method     ChildOrder[]|ObjectCollection findById(int $id) Return ChildOrder objects filtered by the id column
 * @method     ChildOrder[]|ObjectCollection findByCreationDate(string $creation_date) Return ChildOrder objects filtered by the creation_date column
 * @method     ChildOrder[]|ObjectCollection findByModificationDate(string $modification_date) Return ChildOrder objects filtered by the modification_date column
 * @method     ChildOrder[]|ObjectCollection findByOrdernumber(string $ordernumber) Return ChildOrder objects filtered by the ordernumber column
 * @method     ChildOrder[]|ObjectCollection findByOrderStatus(int $order_status) Return ChildOrder objects filtered by the order_status column
 * @method     ChildOrder[]|ObjectCollection findByTotalAmountWithTax(string $total_amount_with_tax) Return ChildOrder objects filtered by the total_amount_with_tax column
 * @method     ChildOrder[]|ObjectCollection findByTotalAmountWithoutTax(string $total_amount_without_tax) Return ChildOrder objects filtered by the total_amount_without_tax column
 * @method     ChildOrder[]|ObjectCollection findByCurrencyCode(string $currency_code) Return ChildOrder objects filtered by the currency_code column
 * @method     ChildOrder[]|ObjectCollection findByShippingFeeWithTax(string $shipping_fee_with_tax) Return ChildOrder objects filtered by the shipping_fee_with_tax column
 * @method     ChildOrder[]|ObjectCollection findByShippingFeeWithoutTax(string $shipping_fee_without_tax) Return ChildOrder objects filtered by the shipping_fee_without_tax column
 * @method     ChildOrder[]|ObjectCollection findByBillingAddressId(int $billing_address_id) Return ChildOrder objects filtered by the billing_address_id column
 * @method     ChildOrder[]|ObjectCollection findByShippingAddressId(int $shipping_address_id) Return ChildOrder objects filtered by the shipping_address_id column
 * @method     ChildOrder[]|ObjectCollection findByUserId(int $user_id) Return ChildOrder objects filtered by the user_id column
 * @method     ChildOrder[]|ObjectCollection findByPaymentId(int $payment_id) Return ChildOrder objects filtered by the payment_id column
 * @method     ChildOrder[]|ObjectCollection findByShipmentId(int $shipment_id) Return ChildOrder objects filtered by the shipment_id column
 * @method     ChildOrder[]|ObjectCollection findByStatus(int $status) Return ChildOrder objects filtered by the status column
 * @method     ChildOrder[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OrderQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\OrderQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ecom', $modelName = '\\Order', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOrderQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOrderQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOrderQuery) {
            return $criteria;
        }
        $query = new ChildOrderQuery();
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
     * $obj = $c->findPk(array(12, 34, 56, 78), $con);
     * </code>
     *
     * @param array[$id, $user_id, $payment_id, $shipment_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildOrder|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrderTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OrderTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2]), (null === $key[3] || is_scalar($key[3]) || is_callable([$key[3], '__toString']) ? (string) $key[3] : $key[3])]))))) {
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
     * @return ChildOrder A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, creation_date, modification_date, ordernumber, order_status, total_amount_with_tax, total_amount_without_tax, currency_code, shipping_fee_with_tax, shipping_fee_without_tax, billing_address_id, shipping_address_id, user_id, payment_id, shipment_id, status FROM order WHERE id = :p0 AND user_id = :p1 AND payment_id = :p2 AND shipment_id = :p3';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_INT);
            $stmt->bindValue(':p3', $key[3], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildOrder $obj */
            $obj = new ChildOrder();
            $obj->hydrate($row);
            OrderTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2]), (null === $key[3] || is_scalar($key[3]) || is_callable([$key[3], '__toString']) ? (string) $key[3] : $key[3])]));
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
     * @return ChildOrder|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(OrderTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(OrderTableMap::COL_USER_ID, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(OrderTableMap::COL_PAYMENT_ID, $key[2], Criteria::EQUAL);
        $this->addUsingAlias(OrderTableMap::COL_SHIPMENT_ID, $key[3], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(OrderTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(OrderTableMap::COL_USER_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(OrderTableMap::COL_PAYMENT_ID, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $cton3 = $this->getNewCriterion(OrderTableMap::COL_SHIPMENT_ID, $key[3], Criteria::EQUAL);
            $cton0->addAnd($cton3);
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
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(OrderTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(OrderTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the creation_date column
     *
     * Example usage:
     * <code>
     * $query->filterByCreationDate('2011-03-14'); // WHERE creation_date = '2011-03-14'
     * $query->filterByCreationDate('now'); // WHERE creation_date = '2011-03-14'
     * $query->filterByCreationDate(array('max' => 'yesterday')); // WHERE creation_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $creationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(OrderTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(OrderTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_CREATION_DATE, $creationDate, $comparison);
    }

    /**
     * Filter the query on the modification_date column
     *
     * Example usage:
     * <code>
     * $query->filterByModificationDate('2011-03-14'); // WHERE modification_date = '2011-03-14'
     * $query->filterByModificationDate('now'); // WHERE modification_date = '2011-03-14'
     * $query->filterByModificationDate(array('max' => 'yesterday')); // WHERE modification_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $modificationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(OrderTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(OrderTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query on the ordernumber column
     *
     * Example usage:
     * <code>
     * $query->filterByOrdernumber('fooValue');   // WHERE ordernumber = 'fooValue'
     * $query->filterByOrdernumber('%fooValue%', Criteria::LIKE); // WHERE ordernumber LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ordernumber The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByOrdernumber($ordernumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ordernumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_ORDERNUMBER, $ordernumber, $comparison);
    }

    /**
     * Filter the query on the order_status column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderStatus(1234); // WHERE order_status = 1234
     * $query->filterByOrderStatus(array(12, 34)); // WHERE order_status IN (12, 34)
     * $query->filterByOrderStatus(array('min' => 12)); // WHERE order_status > 12
     * </code>
     *
     * @param     mixed $orderStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByOrderStatus($orderStatus = null, $comparison = null)
    {
        if (is_array($orderStatus)) {
            $useMinMax = false;
            if (isset($orderStatus['min'])) {
                $this->addUsingAlias(OrderTableMap::COL_ORDER_STATUS, $orderStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderStatus['max'])) {
                $this->addUsingAlias(OrderTableMap::COL_ORDER_STATUS, $orderStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_ORDER_STATUS, $orderStatus, $comparison);
    }

    /**
     * Filter the query on the total_amount_with_tax column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalAmountWithTax(1234); // WHERE total_amount_with_tax = 1234
     * $query->filterByTotalAmountWithTax(array(12, 34)); // WHERE total_amount_with_tax IN (12, 34)
     * $query->filterByTotalAmountWithTax(array('min' => 12)); // WHERE total_amount_with_tax > 12
     * </code>
     *
     * @param     mixed $totalAmountWithTax The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByTotalAmountWithTax($totalAmountWithTax = null, $comparison = null)
    {
        if (is_array($totalAmountWithTax)) {
            $useMinMax = false;
            if (isset($totalAmountWithTax['min'])) {
                $this->addUsingAlias(OrderTableMap::COL_TOTAL_AMOUNT_WITH_TAX, $totalAmountWithTax['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalAmountWithTax['max'])) {
                $this->addUsingAlias(OrderTableMap::COL_TOTAL_AMOUNT_WITH_TAX, $totalAmountWithTax['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_TOTAL_AMOUNT_WITH_TAX, $totalAmountWithTax, $comparison);
    }

    /**
     * Filter the query on the total_amount_without_tax column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalAmountWithoutTax(1234); // WHERE total_amount_without_tax = 1234
     * $query->filterByTotalAmountWithoutTax(array(12, 34)); // WHERE total_amount_without_tax IN (12, 34)
     * $query->filterByTotalAmountWithoutTax(array('min' => 12)); // WHERE total_amount_without_tax > 12
     * </code>
     *
     * @param     mixed $totalAmountWithoutTax The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByTotalAmountWithoutTax($totalAmountWithoutTax = null, $comparison = null)
    {
        if (is_array($totalAmountWithoutTax)) {
            $useMinMax = false;
            if (isset($totalAmountWithoutTax['min'])) {
                $this->addUsingAlias(OrderTableMap::COL_TOTAL_AMOUNT_WITHOUT_TAX, $totalAmountWithoutTax['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalAmountWithoutTax['max'])) {
                $this->addUsingAlias(OrderTableMap::COL_TOTAL_AMOUNT_WITHOUT_TAX, $totalAmountWithoutTax['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_TOTAL_AMOUNT_WITHOUT_TAX, $totalAmountWithoutTax, $comparison);
    }

    /**
     * Filter the query on the currency_code column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrencyCode('fooValue');   // WHERE currency_code = 'fooValue'
     * $query->filterByCurrencyCode('%fooValue%', Criteria::LIKE); // WHERE currency_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $currencyCode The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByCurrencyCode($currencyCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($currencyCode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_CURRENCY_CODE, $currencyCode, $comparison);
    }

    /**
     * Filter the query on the shipping_fee_with_tax column
     *
     * Example usage:
     * <code>
     * $query->filterByShippingFeeWithTax(1234); // WHERE shipping_fee_with_tax = 1234
     * $query->filterByShippingFeeWithTax(array(12, 34)); // WHERE shipping_fee_with_tax IN (12, 34)
     * $query->filterByShippingFeeWithTax(array('min' => 12)); // WHERE shipping_fee_with_tax > 12
     * </code>
     *
     * @param     mixed $shippingFeeWithTax The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByShippingFeeWithTax($shippingFeeWithTax = null, $comparison = null)
    {
        if (is_array($shippingFeeWithTax)) {
            $useMinMax = false;
            if (isset($shippingFeeWithTax['min'])) {
                $this->addUsingAlias(OrderTableMap::COL_SHIPPING_FEE_WITH_TAX, $shippingFeeWithTax['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shippingFeeWithTax['max'])) {
                $this->addUsingAlias(OrderTableMap::COL_SHIPPING_FEE_WITH_TAX, $shippingFeeWithTax['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_SHIPPING_FEE_WITH_TAX, $shippingFeeWithTax, $comparison);
    }

    /**
     * Filter the query on the shipping_fee_without_tax column
     *
     * Example usage:
     * <code>
     * $query->filterByShippingFeeWithoutTax(1234); // WHERE shipping_fee_without_tax = 1234
     * $query->filterByShippingFeeWithoutTax(array(12, 34)); // WHERE shipping_fee_without_tax IN (12, 34)
     * $query->filterByShippingFeeWithoutTax(array('min' => 12)); // WHERE shipping_fee_without_tax > 12
     * </code>
     *
     * @param     mixed $shippingFeeWithoutTax The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByShippingFeeWithoutTax($shippingFeeWithoutTax = null, $comparison = null)
    {
        if (is_array($shippingFeeWithoutTax)) {
            $useMinMax = false;
            if (isset($shippingFeeWithoutTax['min'])) {
                $this->addUsingAlias(OrderTableMap::COL_SHIPPING_FEE_WITHOUT_TAX, $shippingFeeWithoutTax['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shippingFeeWithoutTax['max'])) {
                $this->addUsingAlias(OrderTableMap::COL_SHIPPING_FEE_WITHOUT_TAX, $shippingFeeWithoutTax['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_SHIPPING_FEE_WITHOUT_TAX, $shippingFeeWithoutTax, $comparison);
    }

    /**
     * Filter the query on the billing_address_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBillingAddressId(1234); // WHERE billing_address_id = 1234
     * $query->filterByBillingAddressId(array(12, 34)); // WHERE billing_address_id IN (12, 34)
     * $query->filterByBillingAddressId(array('min' => 12)); // WHERE billing_address_id > 12
     * </code>
     *
     * @param     mixed $billingAddressId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByBillingAddressId($billingAddressId = null, $comparison = null)
    {
        if (is_array($billingAddressId)) {
            $useMinMax = false;
            if (isset($billingAddressId['min'])) {
                $this->addUsingAlias(OrderTableMap::COL_BILLING_ADDRESS_ID, $billingAddressId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($billingAddressId['max'])) {
                $this->addUsingAlias(OrderTableMap::COL_BILLING_ADDRESS_ID, $billingAddressId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_BILLING_ADDRESS_ID, $billingAddressId, $comparison);
    }

    /**
     * Filter the query on the shipping_address_id column
     *
     * Example usage:
     * <code>
     * $query->filterByShippingAddressId(1234); // WHERE shipping_address_id = 1234
     * $query->filterByShippingAddressId(array(12, 34)); // WHERE shipping_address_id IN (12, 34)
     * $query->filterByShippingAddressId(array('min' => 12)); // WHERE shipping_address_id > 12
     * </code>
     *
     * @param     mixed $shippingAddressId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByShippingAddressId($shippingAddressId = null, $comparison = null)
    {
        if (is_array($shippingAddressId)) {
            $useMinMax = false;
            if (isset($shippingAddressId['min'])) {
                $this->addUsingAlias(OrderTableMap::COL_SHIPPING_ADDRESS_ID, $shippingAddressId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shippingAddressId['max'])) {
                $this->addUsingAlias(OrderTableMap::COL_SHIPPING_ADDRESS_ID, $shippingAddressId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_SHIPPING_ADDRESS_ID, $shippingAddressId, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(OrderTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(OrderTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the payment_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentId(1234); // WHERE payment_id = 1234
     * $query->filterByPaymentId(array(12, 34)); // WHERE payment_id IN (12, 34)
     * $query->filterByPaymentId(array('min' => 12)); // WHERE payment_id > 12
     * </code>
     *
     * @see       filterByPayment()
     *
     * @param     mixed $paymentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByPaymentId($paymentId = null, $comparison = null)
    {
        if (is_array($paymentId)) {
            $useMinMax = false;
            if (isset($paymentId['min'])) {
                $this->addUsingAlias(OrderTableMap::COL_PAYMENT_ID, $paymentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($paymentId['max'])) {
                $this->addUsingAlias(OrderTableMap::COL_PAYMENT_ID, $paymentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_PAYMENT_ID, $paymentId, $comparison);
    }

    /**
     * Filter the query on the shipment_id column
     *
     * Example usage:
     * <code>
     * $query->filterByShipmentId(1234); // WHERE shipment_id = 1234
     * $query->filterByShipmentId(array(12, 34)); // WHERE shipment_id IN (12, 34)
     * $query->filterByShipmentId(array('min' => 12)); // WHERE shipment_id > 12
     * </code>
     *
     * @see       filterByShipment()
     *
     * @param     mixed $shipmentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByShipmentId($shipmentId = null, $comparison = null)
    {
        if (is_array($shipmentId)) {
            $useMinMax = false;
            if (isset($shipmentId['min'])) {
                $this->addUsingAlias(OrderTableMap::COL_SHIPMENT_ID, $shipmentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shipmentId['max'])) {
                $this->addUsingAlias(OrderTableMap::COL_SHIPMENT_ID, $shipmentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_SHIPMENT_ID, $shipmentId, $comparison);
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
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(OrderTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(OrderTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related \Payment object
     *
     * @param \Payment|ObjectCollection $payment The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderQuery The current query, for fluid interface
     */
    public function filterByPayment($payment, $comparison = null)
    {
        if ($payment instanceof \Payment) {
            return $this
                ->addUsingAlias(OrderTableMap::COL_PAYMENT_ID, $payment->getId(), $comparison);
        } elseif ($payment instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderTableMap::COL_PAYMENT_ID, $payment->toKeyValue('Id', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPayment() only accepts arguments of type \Payment or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Payment relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function joinPayment($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Payment');

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
            $this->addJoinObject($join, 'Payment');
        }

        return $this;
    }

    /**
     * Use the Payment relation Payment object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PaymentQuery A secondary query class using the current class as primary query
     */
    public function usePaymentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPayment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Payment', '\PaymentQuery');
    }

    /**
     * Filter the query by a related \Shipment object
     *
     * @param \Shipment|ObjectCollection $shipment The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderQuery The current query, for fluid interface
     */
    public function filterByShipment($shipment, $comparison = null)
    {
        if ($shipment instanceof \Shipment) {
            return $this
                ->addUsingAlias(OrderTableMap::COL_SHIPMENT_ID, $shipment->getId(), $comparison);
        } elseif ($shipment instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderTableMap::COL_SHIPMENT_ID, $shipment->toKeyValue('Id', 'Id'), $comparison);
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
     * @return $this|ChildOrderQuery The current query, for fluid interface
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
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(OrderTableMap::COL_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\UserQuery');
    }

    /**
     * Filter the query by a related \OrderLine object
     *
     * @param \OrderLine|ObjectCollection $orderLine the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOrderQuery The current query, for fluid interface
     */
    public function filterByOrderLine($orderLine, $comparison = null)
    {
        if ($orderLine instanceof \OrderLine) {
            return $this
                ->addUsingAlias(OrderTableMap::COL_ID, $orderLine->getOrderId(), $comparison);
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
     * @return $this|ChildOrderQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildOrder $order Object to remove from the list of results
     *
     * @return $this|ChildOrderQuery The current query, for fluid interface
     */
    public function prune($order = null)
    {
        if ($order) {
            $this->addCond('pruneCond0', $this->getAliasedColName(OrderTableMap::COL_ID), $order->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(OrderTableMap::COL_USER_ID), $order->getUserId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(OrderTableMap::COL_PAYMENT_ID), $order->getPaymentId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond3', $this->getAliasedColName(OrderTableMap::COL_SHIPMENT_ID), $order->getShipmentId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2', 'pruneCond3'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the order table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OrderTableMap::clearInstancePool();
            OrderTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OrderTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OrderTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OrderTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OrderQuery
