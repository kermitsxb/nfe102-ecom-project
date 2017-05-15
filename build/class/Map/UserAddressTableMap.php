<?php

namespace Map;

use \UserAddress;
use \UserAddressQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'user_address' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UserAddressTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.UserAddressTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'ecom';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'user_address';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\UserAddress';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'UserAddress';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 17;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 17;

    /**
     * the column name for the id field
     */
    const COL_ID = 'user_address.id';

    /**
     * the column name for the creation_date field
     */
    const COL_CREATION_DATE = 'user_address.creation_date';

    /**
     * the column name for the modification_date field
     */
    const COL_MODIFICATION_DATE = 'user_address.modification_date';

    /**
     * the column name for the label field
     */
    const COL_LABEL = 'user_address.label';

    /**
     * the column name for the firstname field
     */
    const COL_FIRSTNAME = 'user_address.firstname';

    /**
     * the column name for the lastname field
     */
    const COL_LASTNAME = 'user_address.lastname';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'user_address.email';

    /**
     * the column name for the company field
     */
    const COL_COMPANY = 'user_address.company';

    /**
     * the column name for the addressline1 field
     */
    const COL_ADDRESSLINE1 = 'user_address.addressline1';

    /**
     * the column name for the addressline2 field
     */
    const COL_ADDRESSLINE2 = 'user_address.addressline2';

    /**
     * the column name for the addressline3 field
     */
    const COL_ADDRESSLINE3 = 'user_address.addressline3';

    /**
     * the column name for the zipcode field
     */
    const COL_ZIPCODE = 'user_address.zipcode';

    /**
     * the column name for the city field
     */
    const COL_CITY = 'user_address.city';

    /**
     * the column name for the country field
     */
    const COL_COUNTRY = 'user_address.country';

    /**
     * the column name for the phone field
     */
    const COL_PHONE = 'user_address.phone';

    /**
     * the column name for the user_id field
     */
    const COL_USER_ID = 'user_address.user_id';

    /**
     * the column name for the status field
     */
    const COL_STATUS = 'user_address.status';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'CreationDate', 'ModificationDate', 'Label', 'Firstname', 'Lastname', 'Email', 'Company', 'Addressline1', 'Addressline2', 'Addressline3', 'Zipcode', 'City', 'Country', 'Phone', 'UserId', 'Status', ),
        self::TYPE_CAMELNAME     => array('id', 'creationDate', 'modificationDate', 'label', 'firstname', 'lastname', 'email', 'company', 'addressline1', 'addressline2', 'addressline3', 'zipcode', 'city', 'country', 'phone', 'userId', 'status', ),
        self::TYPE_COLNAME       => array(UserAddressTableMap::COL_ID, UserAddressTableMap::COL_CREATION_DATE, UserAddressTableMap::COL_MODIFICATION_DATE, UserAddressTableMap::COL_LABEL, UserAddressTableMap::COL_FIRSTNAME, UserAddressTableMap::COL_LASTNAME, UserAddressTableMap::COL_EMAIL, UserAddressTableMap::COL_COMPANY, UserAddressTableMap::COL_ADDRESSLINE1, UserAddressTableMap::COL_ADDRESSLINE2, UserAddressTableMap::COL_ADDRESSLINE3, UserAddressTableMap::COL_ZIPCODE, UserAddressTableMap::COL_CITY, UserAddressTableMap::COL_COUNTRY, UserAddressTableMap::COL_PHONE, UserAddressTableMap::COL_USER_ID, UserAddressTableMap::COL_STATUS, ),
        self::TYPE_FIELDNAME     => array('id', 'creation_date', 'modification_date', 'label', 'firstname', 'lastname', 'email', 'company', 'addressline1', 'addressline2', 'addressline3', 'zipcode', 'city', 'country', 'phone', 'user_id', 'status', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'CreationDate' => 1, 'ModificationDate' => 2, 'Label' => 3, 'Firstname' => 4, 'Lastname' => 5, 'Email' => 6, 'Company' => 7, 'Addressline1' => 8, 'Addressline2' => 9, 'Addressline3' => 10, 'Zipcode' => 11, 'City' => 12, 'Country' => 13, 'Phone' => 14, 'UserId' => 15, 'Status' => 16, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'creationDate' => 1, 'modificationDate' => 2, 'label' => 3, 'firstname' => 4, 'lastname' => 5, 'email' => 6, 'company' => 7, 'addressline1' => 8, 'addressline2' => 9, 'addressline3' => 10, 'zipcode' => 11, 'city' => 12, 'country' => 13, 'phone' => 14, 'userId' => 15, 'status' => 16, ),
        self::TYPE_COLNAME       => array(UserAddressTableMap::COL_ID => 0, UserAddressTableMap::COL_CREATION_DATE => 1, UserAddressTableMap::COL_MODIFICATION_DATE => 2, UserAddressTableMap::COL_LABEL => 3, UserAddressTableMap::COL_FIRSTNAME => 4, UserAddressTableMap::COL_LASTNAME => 5, UserAddressTableMap::COL_EMAIL => 6, UserAddressTableMap::COL_COMPANY => 7, UserAddressTableMap::COL_ADDRESSLINE1 => 8, UserAddressTableMap::COL_ADDRESSLINE2 => 9, UserAddressTableMap::COL_ADDRESSLINE3 => 10, UserAddressTableMap::COL_ZIPCODE => 11, UserAddressTableMap::COL_CITY => 12, UserAddressTableMap::COL_COUNTRY => 13, UserAddressTableMap::COL_PHONE => 14, UserAddressTableMap::COL_USER_ID => 15, UserAddressTableMap::COL_STATUS => 16, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'creation_date' => 1, 'modification_date' => 2, 'label' => 3, 'firstname' => 4, 'lastname' => 5, 'email' => 6, 'company' => 7, 'addressline1' => 8, 'addressline2' => 9, 'addressline3' => 10, 'zipcode' => 11, 'city' => 12, 'country' => 13, 'phone' => 14, 'user_id' => 15, 'status' => 16, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('user_address');
        $this->setPhpName('UserAddress');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\UserAddress');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('creation_date', 'CreationDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('modification_date', 'ModificationDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('label', 'Label', 'VARCHAR', false, 100, null);
        $this->addColumn('firstname', 'Firstname', 'VARCHAR', false, 100, null);
        $this->addColumn('lastname', 'Lastname', 'VARCHAR', false, 100, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 255, null);
        $this->addColumn('company', 'Company', 'VARCHAR', false, 100, null);
        $this->addColumn('addressline1', 'Addressline1', 'VARCHAR', false, 100, null);
        $this->addColumn('addressline2', 'Addressline2', 'VARCHAR', false, 100, null);
        $this->addColumn('addressline3', 'Addressline3', 'VARCHAR', false, 100, null);
        $this->addColumn('zipcode', 'Zipcode', 'VARCHAR', false, 20, null);
        $this->addColumn('city', 'City', 'VARCHAR', false, 100, null);
        $this->addColumn('country', 'Country', 'VARCHAR', false, 100, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, 45, null);
        $this->addForeignPrimaryKey('user_id', 'UserId', 'INTEGER' , 'user', 'id', true, null, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', '\\User', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':id',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \UserAddress $obj A \UserAddress object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getId() || is_scalar($obj->getId()) || is_callable([$obj->getId(), '__toString']) ? (string) $obj->getId() : $obj->getId()), (null === $obj->getUserId() || is_scalar($obj->getUserId()) || is_callable([$obj->getUserId(), '__toString']) ? (string) $obj->getUserId() : $obj->getUserId())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \UserAddress object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \UserAddress) {
                $key = serialize([(null === $value->getId() || is_scalar($value->getId()) || is_callable([$value->getId(), '__toString']) ? (string) $value->getId() : $value->getId()), (null === $value->getUserId() || is_scalar($value->getUserId()) || is_callable([$value->getUserId(), '__toString']) ? (string) $value->getUserId() : $value->getUserId())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \UserAddress object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 15 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 15 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 15 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 15 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 15 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 15 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)])]);
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 15 + $offset
                : self::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? UserAddressTableMap::CLASS_DEFAULT : UserAddressTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (UserAddress object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UserAddressTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UserAddressTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UserAddressTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserAddressTableMap::OM_CLASS;
            /** @var UserAddress $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UserAddressTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = UserAddressTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UserAddressTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UserAddress $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserAddressTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UserAddressTableMap::COL_ID);
            $criteria->addSelectColumn(UserAddressTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(UserAddressTableMap::COL_MODIFICATION_DATE);
            $criteria->addSelectColumn(UserAddressTableMap::COL_LABEL);
            $criteria->addSelectColumn(UserAddressTableMap::COL_FIRSTNAME);
            $criteria->addSelectColumn(UserAddressTableMap::COL_LASTNAME);
            $criteria->addSelectColumn(UserAddressTableMap::COL_EMAIL);
            $criteria->addSelectColumn(UserAddressTableMap::COL_COMPANY);
            $criteria->addSelectColumn(UserAddressTableMap::COL_ADDRESSLINE1);
            $criteria->addSelectColumn(UserAddressTableMap::COL_ADDRESSLINE2);
            $criteria->addSelectColumn(UserAddressTableMap::COL_ADDRESSLINE3);
            $criteria->addSelectColumn(UserAddressTableMap::COL_ZIPCODE);
            $criteria->addSelectColumn(UserAddressTableMap::COL_CITY);
            $criteria->addSelectColumn(UserAddressTableMap::COL_COUNTRY);
            $criteria->addSelectColumn(UserAddressTableMap::COL_PHONE);
            $criteria->addSelectColumn(UserAddressTableMap::COL_USER_ID);
            $criteria->addSelectColumn(UserAddressTableMap::COL_STATUS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.creation_date');
            $criteria->addSelectColumn($alias . '.modification_date');
            $criteria->addSelectColumn($alias . '.label');
            $criteria->addSelectColumn($alias . '.firstname');
            $criteria->addSelectColumn($alias . '.lastname');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.company');
            $criteria->addSelectColumn($alias . '.addressline1');
            $criteria->addSelectColumn($alias . '.addressline2');
            $criteria->addSelectColumn($alias . '.addressline3');
            $criteria->addSelectColumn($alias . '.zipcode');
            $criteria->addSelectColumn($alias . '.city');
            $criteria->addSelectColumn($alias . '.country');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.status');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(UserAddressTableMap::DATABASE_NAME)->getTable(UserAddressTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UserAddressTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UserAddressTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UserAddressTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a UserAddress or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or UserAddress object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserAddressTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \UserAddress) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserAddressTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(UserAddressTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(UserAddressTableMap::COL_USER_ID, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = UserAddressQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UserAddressTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UserAddressTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the user_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UserAddressQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UserAddress or Criteria object.
     *
     * @param mixed               $criteria Criteria or UserAddress object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserAddressTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UserAddress object
        }


        // Set the correct dbName
        $query = UserAddressQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UserAddressTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UserAddressTableMap::buildTableMap();
