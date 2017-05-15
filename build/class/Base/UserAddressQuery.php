<?php

namespace Base;

use \UserAddress as ChildUserAddress;
use \UserAddressQuery as ChildUserAddressQuery;
use \Exception;
use \PDO;
use Map\UserAddressTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'user_address' table.
 *
 *
 *
 * @method     ChildUserAddressQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUserAddressQuery orderByCreationDate($order = Criteria::ASC) Order by the creation_date column
 * @method     ChildUserAddressQuery orderByModificationDate($order = Criteria::ASC) Order by the modification_date column
 * @method     ChildUserAddressQuery orderByLabel($order = Criteria::ASC) Order by the label column
 * @method     ChildUserAddressQuery orderByFirstname($order = Criteria::ASC) Order by the firstname column
 * @method     ChildUserAddressQuery orderByLastname($order = Criteria::ASC) Order by the lastname column
 * @method     ChildUserAddressQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUserAddressQuery orderByCompany($order = Criteria::ASC) Order by the company column
 * @method     ChildUserAddressQuery orderByAddressline1($order = Criteria::ASC) Order by the addressline1 column
 * @method     ChildUserAddressQuery orderByAddressline2($order = Criteria::ASC) Order by the addressline2 column
 * @method     ChildUserAddressQuery orderByAddressline3($order = Criteria::ASC) Order by the addressline3 column
 * @method     ChildUserAddressQuery orderByZipcode($order = Criteria::ASC) Order by the zipcode column
 * @method     ChildUserAddressQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method     ChildUserAddressQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method     ChildUserAddressQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildUserAddressQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildUserAddressQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method     ChildUserAddressQuery groupById() Group by the id column
 * @method     ChildUserAddressQuery groupByCreationDate() Group by the creation_date column
 * @method     ChildUserAddressQuery groupByModificationDate() Group by the modification_date column
 * @method     ChildUserAddressQuery groupByLabel() Group by the label column
 * @method     ChildUserAddressQuery groupByFirstname() Group by the firstname column
 * @method     ChildUserAddressQuery groupByLastname() Group by the lastname column
 * @method     ChildUserAddressQuery groupByEmail() Group by the email column
 * @method     ChildUserAddressQuery groupByCompany() Group by the company column
 * @method     ChildUserAddressQuery groupByAddressline1() Group by the addressline1 column
 * @method     ChildUserAddressQuery groupByAddressline2() Group by the addressline2 column
 * @method     ChildUserAddressQuery groupByAddressline3() Group by the addressline3 column
 * @method     ChildUserAddressQuery groupByZipcode() Group by the zipcode column
 * @method     ChildUserAddressQuery groupByCity() Group by the city column
 * @method     ChildUserAddressQuery groupByCountry() Group by the country column
 * @method     ChildUserAddressQuery groupByPhone() Group by the phone column
 * @method     ChildUserAddressQuery groupByUserId() Group by the user_id column
 * @method     ChildUserAddressQuery groupByStatus() Group by the status column
 *
 * @method     ChildUserAddressQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserAddressQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserAddressQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserAddressQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserAddressQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserAddressQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserAddressQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildUserAddressQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildUserAddressQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildUserAddressQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildUserAddressQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildUserAddressQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildUserAddressQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     \UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUserAddress findOne(ConnectionInterface $con = null) Return the first ChildUserAddress matching the query
 * @method     ChildUserAddress findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserAddress matching the query, or a new ChildUserAddress object populated from the query conditions when no match is found
 *
 * @method     ChildUserAddress findOneById(int $id) Return the first ChildUserAddress filtered by the id column
 * @method     ChildUserAddress findOneByCreationDate(string $creation_date) Return the first ChildUserAddress filtered by the creation_date column
 * @method     ChildUserAddress findOneByModificationDate(string $modification_date) Return the first ChildUserAddress filtered by the modification_date column
 * @method     ChildUserAddress findOneByLabel(string $label) Return the first ChildUserAddress filtered by the label column
 * @method     ChildUserAddress findOneByFirstname(string $firstname) Return the first ChildUserAddress filtered by the firstname column
 * @method     ChildUserAddress findOneByLastname(string $lastname) Return the first ChildUserAddress filtered by the lastname column
 * @method     ChildUserAddress findOneByEmail(string $email) Return the first ChildUserAddress filtered by the email column
 * @method     ChildUserAddress findOneByCompany(string $company) Return the first ChildUserAddress filtered by the company column
 * @method     ChildUserAddress findOneByAddressline1(string $addressline1) Return the first ChildUserAddress filtered by the addressline1 column
 * @method     ChildUserAddress findOneByAddressline2(string $addressline2) Return the first ChildUserAddress filtered by the addressline2 column
 * @method     ChildUserAddress findOneByAddressline3(string $addressline3) Return the first ChildUserAddress filtered by the addressline3 column
 * @method     ChildUserAddress findOneByZipcode(string $zipcode) Return the first ChildUserAddress filtered by the zipcode column
 * @method     ChildUserAddress findOneByCity(string $city) Return the first ChildUserAddress filtered by the city column
 * @method     ChildUserAddress findOneByCountry(string $country) Return the first ChildUserAddress filtered by the country column
 * @method     ChildUserAddress findOneByPhone(string $phone) Return the first ChildUserAddress filtered by the phone column
 * @method     ChildUserAddress findOneByUserId(int $user_id) Return the first ChildUserAddress filtered by the user_id column
 * @method     ChildUserAddress findOneByStatus(int $status) Return the first ChildUserAddress filtered by the status column *

 * @method     ChildUserAddress requirePk($key, ConnectionInterface $con = null) Return the ChildUserAddress by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAddress requireOne(ConnectionInterface $con = null) Return the first ChildUserAddress matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserAddress requireOneById(int $id) Return the first ChildUserAddress filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAddress requireOneByCreationDate(string $creation_date) Return the first ChildUserAddress filtered by the creation_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAddress requireOneByModificationDate(string $modification_date) Return the first ChildUserAddress filtered by the modification_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAddress requireOneByLabel(string $label) Return the first ChildUserAddress filtered by the label column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAddress requireOneByFirstname(string $firstname) Return the first ChildUserAddress filtered by the firstname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAddress requireOneByLastname(string $lastname) Return the first ChildUserAddress filtered by the lastname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAddress requireOneByEmail(string $email) Return the first ChildUserAddress filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAddress requireOneByCompany(string $company) Return the first ChildUserAddress filtered by the company column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAddress requireOneByAddressline1(string $addressline1) Return the first ChildUserAddress filtered by the addressline1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAddress requireOneByAddressline2(string $addressline2) Return the first ChildUserAddress filtered by the addressline2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAddress requireOneByAddressline3(string $addressline3) Return the first ChildUserAddress filtered by the addressline3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAddress requireOneByZipcode(string $zipcode) Return the first ChildUserAddress filtered by the zipcode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAddress requireOneByCity(string $city) Return the first ChildUserAddress filtered by the city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAddress requireOneByCountry(string $country) Return the first ChildUserAddress filtered by the country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAddress requireOneByPhone(string $phone) Return the first ChildUserAddress filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAddress requireOneByUserId(int $user_id) Return the first ChildUserAddress filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAddress requireOneByStatus(int $status) Return the first ChildUserAddress filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserAddress[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserAddress objects based on current ModelCriteria
 * @method     ChildUserAddress[]|ObjectCollection findById(int $id) Return ChildUserAddress objects filtered by the id column
 * @method     ChildUserAddress[]|ObjectCollection findByCreationDate(string $creation_date) Return ChildUserAddress objects filtered by the creation_date column
 * @method     ChildUserAddress[]|ObjectCollection findByModificationDate(string $modification_date) Return ChildUserAddress objects filtered by the modification_date column
 * @method     ChildUserAddress[]|ObjectCollection findByLabel(string $label) Return ChildUserAddress objects filtered by the label column
 * @method     ChildUserAddress[]|ObjectCollection findByFirstname(string $firstname) Return ChildUserAddress objects filtered by the firstname column
 * @method     ChildUserAddress[]|ObjectCollection findByLastname(string $lastname) Return ChildUserAddress objects filtered by the lastname column
 * @method     ChildUserAddress[]|ObjectCollection findByEmail(string $email) Return ChildUserAddress objects filtered by the email column
 * @method     ChildUserAddress[]|ObjectCollection findByCompany(string $company) Return ChildUserAddress objects filtered by the company column
 * @method     ChildUserAddress[]|ObjectCollection findByAddressline1(string $addressline1) Return ChildUserAddress objects filtered by the addressline1 column
 * @method     ChildUserAddress[]|ObjectCollection findByAddressline2(string $addressline2) Return ChildUserAddress objects filtered by the addressline2 column
 * @method     ChildUserAddress[]|ObjectCollection findByAddressline3(string $addressline3) Return ChildUserAddress objects filtered by the addressline3 column
 * @method     ChildUserAddress[]|ObjectCollection findByZipcode(string $zipcode) Return ChildUserAddress objects filtered by the zipcode column
 * @method     ChildUserAddress[]|ObjectCollection findByCity(string $city) Return ChildUserAddress objects filtered by the city column
 * @method     ChildUserAddress[]|ObjectCollection findByCountry(string $country) Return ChildUserAddress objects filtered by the country column
 * @method     ChildUserAddress[]|ObjectCollection findByPhone(string $phone) Return ChildUserAddress objects filtered by the phone column
 * @method     ChildUserAddress[]|ObjectCollection findByUserId(int $user_id) Return ChildUserAddress objects filtered by the user_id column
 * @method     ChildUserAddress[]|ObjectCollection findByStatus(int $status) Return ChildUserAddress objects filtered by the status column
 * @method     ChildUserAddress[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserAddressQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UserAddressQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ecom', $modelName = '\\UserAddress', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserAddressQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserAddressQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserAddressQuery) {
            return $criteria;
        }
        $query = new ChildUserAddressQuery();
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
     * @param array[$id, $user_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUserAddress|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserAddressTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UserAddressTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildUserAddress A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, creation_date, modification_date, label, firstname, lastname, email, company, addressline1, addressline2, addressline3, zipcode, city, country, phone, user_id, status FROM user_address WHERE id = :p0 AND user_id = :p1';
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
            /** @var ChildUserAddress $obj */
            $obj = new ChildUserAddress();
            $obj->hydrate($row);
            UserAddressTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildUserAddress|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(UserAddressTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(UserAddressTableMap::COL_USER_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(UserAddressTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(UserAddressTableMap::COL_USER_ID, $key[1], Criteria::EQUAL);
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
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UserAddressTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UserAddressTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAddressTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(UserAddressTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(UserAddressTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAddressTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(UserAddressTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(UserAddressTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAddressTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
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
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByLabel($label = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($label)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAddressTableMap::COL_LABEL, $label, $comparison);
    }

    /**
     * Filter the query on the firstname column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstname('fooValue');   // WHERE firstname = 'fooValue'
     * $query->filterByFirstname('%fooValue%', Criteria::LIKE); // WHERE firstname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByFirstname($firstname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAddressTableMap::COL_FIRSTNAME, $firstname, $comparison);
    }

    /**
     * Filter the query on the lastname column
     *
     * Example usage:
     * <code>
     * $query->filterByLastname('fooValue');   // WHERE lastname = 'fooValue'
     * $query->filterByLastname('%fooValue%', Criteria::LIKE); // WHERE lastname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByLastname($lastname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAddressTableMap::COL_LASTNAME, $lastname, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAddressTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the company column
     *
     * Example usage:
     * <code>
     * $query->filterByCompany('fooValue');   // WHERE company = 'fooValue'
     * $query->filterByCompany('%fooValue%', Criteria::LIKE); // WHERE company LIKE '%fooValue%'
     * </code>
     *
     * @param     string $company The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByCompany($company = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($company)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAddressTableMap::COL_COMPANY, $company, $comparison);
    }

    /**
     * Filter the query on the addressline1 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressline1('fooValue');   // WHERE addressline1 = 'fooValue'
     * $query->filterByAddressline1('%fooValue%', Criteria::LIKE); // WHERE addressline1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $addressline1 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByAddressline1($addressline1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressline1)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAddressTableMap::COL_ADDRESSLINE1, $addressline1, $comparison);
    }

    /**
     * Filter the query on the addressline2 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressline2('fooValue');   // WHERE addressline2 = 'fooValue'
     * $query->filterByAddressline2('%fooValue%', Criteria::LIKE); // WHERE addressline2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $addressline2 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByAddressline2($addressline2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressline2)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAddressTableMap::COL_ADDRESSLINE2, $addressline2, $comparison);
    }

    /**
     * Filter the query on the addressline3 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressline3('fooValue');   // WHERE addressline3 = 'fooValue'
     * $query->filterByAddressline3('%fooValue%', Criteria::LIKE); // WHERE addressline3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $addressline3 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByAddressline3($addressline3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressline3)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAddressTableMap::COL_ADDRESSLINE3, $addressline3, $comparison);
    }

    /**
     * Filter the query on the zipcode column
     *
     * Example usage:
     * <code>
     * $query->filterByZipcode('fooValue');   // WHERE zipcode = 'fooValue'
     * $query->filterByZipcode('%fooValue%', Criteria::LIKE); // WHERE zipcode LIKE '%fooValue%'
     * </code>
     *
     * @param     string $zipcode The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByZipcode($zipcode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zipcode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAddressTableMap::COL_ZIPCODE, $zipcode, $comparison);
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%', Criteria::LIKE); // WHERE city LIKE '%fooValue%'
     * </code>
     *
     * @param     string $city The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByCity($city = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($city)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAddressTableMap::COL_CITY, $city, $comparison);
    }

    /**
     * Filter the query on the country column
     *
     * Example usage:
     * <code>
     * $query->filterByCountry('fooValue');   // WHERE country = 'fooValue'
     * $query->filterByCountry('%fooValue%', Criteria::LIKE); // WHERE country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $country The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByCountry($country = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($country)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAddressTableMap::COL_COUNTRY, $country, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAddressTableMap::COL_PHONE, $phone, $comparison);
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
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(UserAddressTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UserAddressTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAddressTableMap::COL_USER_ID, $userId, $comparison);
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
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(UserAddressTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(UserAddressTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAddressTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserAddressQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(UserAddressTableMap::COL_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserAddressTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildUserAddress $userAddress Object to remove from the list of results
     *
     * @return $this|ChildUserAddressQuery The current query, for fluid interface
     */
    public function prune($userAddress = null)
    {
        if ($userAddress) {
            $this->addCond('pruneCond0', $this->getAliasedColName(UserAddressTableMap::COL_ID), $userAddress->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(UserAddressTableMap::COL_USER_ID), $userAddress->getUserId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserAddressTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserAddressTableMap::clearInstancePool();
            UserAddressTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserAddressTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserAddressTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserAddressTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserAddressTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserAddressQuery
