<?php

namespace Map;

use \Order;
use \OrderQuery;
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
 * This class defines the structure of the 'order' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class OrderTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.OrderTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'ecom';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'order';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Order';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Order';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 16;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 16;

    /**
     * the column name for the id field
     */
    const COL_ID = 'order.id';

    /**
     * the column name for the creation_date field
     */
    const COL_CREATION_DATE = 'order.creation_date';

    /**
     * the column name for the modification_date field
     */
    const COL_MODIFICATION_DATE = 'order.modification_date';

    /**
     * the column name for the ordernumber field
     */
    const COL_ORDERNUMBER = 'order.ordernumber';

    /**
     * the column name for the order_status field
     */
    const COL_ORDER_STATUS = 'order.order_status';

    /**
     * the column name for the total_amount_with_tax field
     */
    const COL_TOTAL_AMOUNT_WITH_TAX = 'order.total_amount_with_tax';

    /**
     * the column name for the total_amount_without_tax field
     */
    const COL_TOTAL_AMOUNT_WITHOUT_TAX = 'order.total_amount_without_tax';

    /**
     * the column name for the currency_code field
     */
    const COL_CURRENCY_CODE = 'order.currency_code';

    /**
     * the column name for the shipping_fee_with_tax field
     */
    const COL_SHIPPING_FEE_WITH_TAX = 'order.shipping_fee_with_tax';

    /**
     * the column name for the shipping_fee_without_tax field
     */
    const COL_SHIPPING_FEE_WITHOUT_TAX = 'order.shipping_fee_without_tax';

    /**
     * the column name for the billing_address_id field
     */
    const COL_BILLING_ADDRESS_ID = 'order.billing_address_id';

    /**
     * the column name for the shipping_address_id field
     */
    const COL_SHIPPING_ADDRESS_ID = 'order.shipping_address_id';

    /**
     * the column name for the user_id field
     */
    const COL_USER_ID = 'order.user_id';

    /**
     * the column name for the payment_id field
     */
    const COL_PAYMENT_ID = 'order.payment_id';

    /**
     * the column name for the shipment_id field
     */
    const COL_SHIPMENT_ID = 'order.shipment_id';

    /**
     * the column name for the status field
     */
    const COL_STATUS = 'order.status';

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
        self::TYPE_PHPNAME       => array('Id', 'CreationDate', 'ModificationDate', 'Ordernumber', 'OrderStatus', 'TotalAmountWithTax', 'TotalAmountWithoutTax', 'CurrencyCode', 'ShippingFeeWithTax', 'ShippingFeeWithoutTax', 'BillingAddressId', 'ShippingAddressId', 'UserId', 'PaymentId', 'ShipmentId', 'Status', ),
        self::TYPE_CAMELNAME     => array('id', 'creationDate', 'modificationDate', 'ordernumber', 'orderStatus', 'totalAmountWithTax', 'totalAmountWithoutTax', 'currencyCode', 'shippingFeeWithTax', 'shippingFeeWithoutTax', 'billingAddressId', 'shippingAddressId', 'userId', 'paymentId', 'shipmentId', 'status', ),
        self::TYPE_COLNAME       => array(OrderTableMap::COL_ID, OrderTableMap::COL_CREATION_DATE, OrderTableMap::COL_MODIFICATION_DATE, OrderTableMap::COL_ORDERNUMBER, OrderTableMap::COL_ORDER_STATUS, OrderTableMap::COL_TOTAL_AMOUNT_WITH_TAX, OrderTableMap::COL_TOTAL_AMOUNT_WITHOUT_TAX, OrderTableMap::COL_CURRENCY_CODE, OrderTableMap::COL_SHIPPING_FEE_WITH_TAX, OrderTableMap::COL_SHIPPING_FEE_WITHOUT_TAX, OrderTableMap::COL_BILLING_ADDRESS_ID, OrderTableMap::COL_SHIPPING_ADDRESS_ID, OrderTableMap::COL_USER_ID, OrderTableMap::COL_PAYMENT_ID, OrderTableMap::COL_SHIPMENT_ID, OrderTableMap::COL_STATUS, ),
        self::TYPE_FIELDNAME     => array('id', 'creation_date', 'modification_date', 'ordernumber', 'order_status', 'total_amount_with_tax', 'total_amount_without_tax', 'currency_code', 'shipping_fee_with_tax', 'shipping_fee_without_tax', 'billing_address_id', 'shipping_address_id', 'user_id', 'payment_id', 'shipment_id', 'status', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'CreationDate' => 1, 'ModificationDate' => 2, 'Ordernumber' => 3, 'OrderStatus' => 4, 'TotalAmountWithTax' => 5, 'TotalAmountWithoutTax' => 6, 'CurrencyCode' => 7, 'ShippingFeeWithTax' => 8, 'ShippingFeeWithoutTax' => 9, 'BillingAddressId' => 10, 'ShippingAddressId' => 11, 'UserId' => 12, 'PaymentId' => 13, 'ShipmentId' => 14, 'Status' => 15, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'creationDate' => 1, 'modificationDate' => 2, 'ordernumber' => 3, 'orderStatus' => 4, 'totalAmountWithTax' => 5, 'totalAmountWithoutTax' => 6, 'currencyCode' => 7, 'shippingFeeWithTax' => 8, 'shippingFeeWithoutTax' => 9, 'billingAddressId' => 10, 'shippingAddressId' => 11, 'userId' => 12, 'paymentId' => 13, 'shipmentId' => 14, 'status' => 15, ),
        self::TYPE_COLNAME       => array(OrderTableMap::COL_ID => 0, OrderTableMap::COL_CREATION_DATE => 1, OrderTableMap::COL_MODIFICATION_DATE => 2, OrderTableMap::COL_ORDERNUMBER => 3, OrderTableMap::COL_ORDER_STATUS => 4, OrderTableMap::COL_TOTAL_AMOUNT_WITH_TAX => 5, OrderTableMap::COL_TOTAL_AMOUNT_WITHOUT_TAX => 6, OrderTableMap::COL_CURRENCY_CODE => 7, OrderTableMap::COL_SHIPPING_FEE_WITH_TAX => 8, OrderTableMap::COL_SHIPPING_FEE_WITHOUT_TAX => 9, OrderTableMap::COL_BILLING_ADDRESS_ID => 10, OrderTableMap::COL_SHIPPING_ADDRESS_ID => 11, OrderTableMap::COL_USER_ID => 12, OrderTableMap::COL_PAYMENT_ID => 13, OrderTableMap::COL_SHIPMENT_ID => 14, OrderTableMap::COL_STATUS => 15, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'creation_date' => 1, 'modification_date' => 2, 'ordernumber' => 3, 'order_status' => 4, 'total_amount_with_tax' => 5, 'total_amount_without_tax' => 6, 'currency_code' => 7, 'shipping_fee_with_tax' => 8, 'shipping_fee_without_tax' => 9, 'billing_address_id' => 10, 'shipping_address_id' => 11, 'user_id' => 12, 'payment_id' => 13, 'shipment_id' => 14, 'status' => 15, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
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
        $this->setName('order');
        $this->setPhpName('Order');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Order');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('creation_date', 'CreationDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('modification_date', 'ModificationDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('ordernumber', 'Ordernumber', 'VARCHAR', false, 45, null);
        $this->addColumn('order_status', 'OrderStatus', 'INTEGER', false, null, null);
        $this->addColumn('total_amount_with_tax', 'TotalAmountWithTax', 'DECIMAL', false, null, null);
        $this->addColumn('total_amount_without_tax', 'TotalAmountWithoutTax', 'DECIMAL', false, null, null);
        $this->addColumn('currency_code', 'CurrencyCode', 'VARCHAR', false, 10, null);
        $this->addColumn('shipping_fee_with_tax', 'ShippingFeeWithTax', 'DECIMAL', false, null, null);
        $this->addColumn('shipping_fee_without_tax', 'ShippingFeeWithoutTax', 'DECIMAL', false, null, null);
        $this->addColumn('billing_address_id', 'BillingAddressId', 'INTEGER', false, null, null);
        $this->addColumn('shipping_address_id', 'ShippingAddressId', 'INTEGER', false, null, null);
        $this->addForeignPrimaryKey('user_id', 'UserId', 'INTEGER' , 'user', 'id', true, null, null);
        $this->addForeignPrimaryKey('payment_id', 'PaymentId', 'INTEGER' , 'payment', 'id', true, null, null);
        $this->addForeignPrimaryKey('shipment_id', 'ShipmentId', 'INTEGER' , 'shipment', 'id', true, null, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Payment', '\\Payment', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':payment_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Shipment', '\\Shipment', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':shipment_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('User', '\\User', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('OrderLine', '\\OrderLine', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':order_id',
    1 => ':id',
  ),
), null, null, 'OrderLines', false);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Order $obj A \Order object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getId() || is_scalar($obj->getId()) || is_callable([$obj->getId(), '__toString']) ? (string) $obj->getId() : $obj->getId()), (null === $obj->getUserId() || is_scalar($obj->getUserId()) || is_callable([$obj->getUserId(), '__toString']) ? (string) $obj->getUserId() : $obj->getUserId()), (null === $obj->getPaymentId() || is_scalar($obj->getPaymentId()) || is_callable([$obj->getPaymentId(), '__toString']) ? (string) $obj->getPaymentId() : $obj->getPaymentId()), (null === $obj->getShipmentId() || is_scalar($obj->getShipmentId()) || is_callable([$obj->getShipmentId(), '__toString']) ? (string) $obj->getShipmentId() : $obj->getShipmentId())]);
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
     * @param mixed $value A \Order object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Order) {
                $key = serialize([(null === $value->getId() || is_scalar($value->getId()) || is_callable([$value->getId(), '__toString']) ? (string) $value->getId() : $value->getId()), (null === $value->getUserId() || is_scalar($value->getUserId()) || is_callable([$value->getUserId(), '__toString']) ? (string) $value->getUserId() : $value->getUserId()), (null === $value->getPaymentId() || is_scalar($value->getPaymentId()) || is_callable([$value->getPaymentId(), '__toString']) ? (string) $value->getPaymentId() : $value->getPaymentId()), (null === $value->getShipmentId() || is_scalar($value->getShipmentId()) || is_callable([$value->getShipmentId(), '__toString']) ? (string) $value->getShipmentId() : $value->getShipmentId())]);

            } elseif (is_array($value) && count($value) === 4) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1]), (null === $value[2] || is_scalar($value[2]) || is_callable([$value[2], '__toString']) ? (string) $value[2] : $value[2]), (null === $value[3] || is_scalar($value[3]) || is_callable([$value[3], '__toString']) ? (string) $value[3] : $value[3])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Order object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 12 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 13 + $offset : static::translateFieldName('PaymentId', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 14 + $offset : static::translateFieldName('ShipmentId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 12 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 12 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 12 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 12 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 12 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 13 + $offset : static::translateFieldName('PaymentId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 13 + $offset : static::translateFieldName('PaymentId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 13 + $offset : static::translateFieldName('PaymentId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 13 + $offset : static::translateFieldName('PaymentId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 13 + $offset : static::translateFieldName('PaymentId', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 14 + $offset : static::translateFieldName('ShipmentId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 14 + $offset : static::translateFieldName('ShipmentId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 14 + $offset : static::translateFieldName('ShipmentId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 14 + $offset : static::translateFieldName('ShipmentId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 14 + $offset : static::translateFieldName('ShipmentId', TableMap::TYPE_PHPNAME, $indexType)])]);
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
                ? 12 + $offset
                : self::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 13 + $offset
                : self::translateFieldName('PaymentId', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 14 + $offset
                : self::translateFieldName('ShipmentId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OrderTableMap::CLASS_DEFAULT : OrderTableMap::OM_CLASS;
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
     * @return array           (Order object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = OrderTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OrderTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OrderTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OrderTableMap::OM_CLASS;
            /** @var Order $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OrderTableMap::addInstanceToPool($obj, $key);
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
            $key = OrderTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OrderTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Order $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OrderTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OrderTableMap::COL_ID);
            $criteria->addSelectColumn(OrderTableMap::COL_CREATION_DATE);
            $criteria->addSelectColumn(OrderTableMap::COL_MODIFICATION_DATE);
            $criteria->addSelectColumn(OrderTableMap::COL_ORDERNUMBER);
            $criteria->addSelectColumn(OrderTableMap::COL_ORDER_STATUS);
            $criteria->addSelectColumn(OrderTableMap::COL_TOTAL_AMOUNT_WITH_TAX);
            $criteria->addSelectColumn(OrderTableMap::COL_TOTAL_AMOUNT_WITHOUT_TAX);
            $criteria->addSelectColumn(OrderTableMap::COL_CURRENCY_CODE);
            $criteria->addSelectColumn(OrderTableMap::COL_SHIPPING_FEE_WITH_TAX);
            $criteria->addSelectColumn(OrderTableMap::COL_SHIPPING_FEE_WITHOUT_TAX);
            $criteria->addSelectColumn(OrderTableMap::COL_BILLING_ADDRESS_ID);
            $criteria->addSelectColumn(OrderTableMap::COL_SHIPPING_ADDRESS_ID);
            $criteria->addSelectColumn(OrderTableMap::COL_USER_ID);
            $criteria->addSelectColumn(OrderTableMap::COL_PAYMENT_ID);
            $criteria->addSelectColumn(OrderTableMap::COL_SHIPMENT_ID);
            $criteria->addSelectColumn(OrderTableMap::COL_STATUS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.creation_date');
            $criteria->addSelectColumn($alias . '.modification_date');
            $criteria->addSelectColumn($alias . '.ordernumber');
            $criteria->addSelectColumn($alias . '.order_status');
            $criteria->addSelectColumn($alias . '.total_amount_with_tax');
            $criteria->addSelectColumn($alias . '.total_amount_without_tax');
            $criteria->addSelectColumn($alias . '.currency_code');
            $criteria->addSelectColumn($alias . '.shipping_fee_with_tax');
            $criteria->addSelectColumn($alias . '.shipping_fee_without_tax');
            $criteria->addSelectColumn($alias . '.billing_address_id');
            $criteria->addSelectColumn($alias . '.shipping_address_id');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.payment_id');
            $criteria->addSelectColumn($alias . '.shipment_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(OrderTableMap::DATABASE_NAME)->getTable(OrderTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(OrderTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(OrderTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new OrderTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Order or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Order object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Order) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OrderTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(OrderTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(OrderTableMap::COL_USER_ID, $value[1]));
                $criterion->addAnd($criteria->getNewCriterion(OrderTableMap::COL_PAYMENT_ID, $value[2]));
                $criterion->addAnd($criteria->getNewCriterion(OrderTableMap::COL_SHIPMENT_ID, $value[3]));
                $criteria->addOr($criterion);
            }
        }

        $query = OrderQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OrderTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OrderTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the order table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return OrderQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Order or Criteria object.
     *
     * @param mixed               $criteria Criteria or Order object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Order object
        }


        // Set the correct dbName
        $query = OrderQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // OrderTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
OrderTableMap::buildTableMap();
