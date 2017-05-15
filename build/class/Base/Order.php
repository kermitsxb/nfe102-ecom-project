<?php

namespace Base;

use \Order as ChildOrder;
use \OrderLine as ChildOrderLine;
use \OrderLineQuery as ChildOrderLineQuery;
use \OrderQuery as ChildOrderQuery;
use \Payment as ChildPayment;
use \PaymentQuery as ChildPaymentQuery;
use \Shipment as ChildShipment;
use \ShipmentQuery as ChildShipmentQuery;
use \User as ChildUser;
use \UserQuery as ChildUserQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\OrderLineTableMap;
use Map\OrderTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'order' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Order implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\OrderTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the creation_date field.
     *
     * @var        DateTime
     */
    protected $creation_date;

    /**
     * The value for the modification_date field.
     *
     * @var        DateTime
     */
    protected $modification_date;

    /**
     * The value for the ordernumber field.
     *
     * @var        string
     */
    protected $ordernumber;

    /**
     * The value for the order_status field.
     *
     * @var        int
     */
    protected $order_status;

    /**
     * The value for the total_amount_with_tax field.
     *
     * @var        string
     */
    protected $total_amount_with_tax;

    /**
     * The value for the total_amount_without_tax field.
     *
     * @var        string
     */
    protected $total_amount_without_tax;

    /**
     * The value for the currency_code field.
     *
     * @var        string
     */
    protected $currency_code;

    /**
     * The value for the shipping_fee_with_tax field.
     *
     * @var        string
     */
    protected $shipping_fee_with_tax;

    /**
     * The value for the shipping_fee_without_tax field.
     *
     * @var        string
     */
    protected $shipping_fee_without_tax;

    /**
     * The value for the billing_address_id field.
     *
     * @var        int
     */
    protected $billing_address_id;

    /**
     * The value for the shipping_address_id field.
     *
     * @var        int
     */
    protected $shipping_address_id;

    /**
     * The value for the user_id field.
     *
     * @var        int
     */
    protected $user_id;

    /**
     * The value for the payment_id field.
     *
     * @var        int
     */
    protected $payment_id;

    /**
     * The value for the shipment_id field.
     *
     * @var        int
     */
    protected $shipment_id;

    /**
     * The value for the status field.
     *
     * @var        int
     */
    protected $status;

    /**
     * @var        ChildPayment
     */
    protected $aPayment;

    /**
     * @var        ChildShipment
     */
    protected $aShipment;

    /**
     * @var        ChildUser
     */
    protected $aUser;

    /**
     * @var        ObjectCollection|ChildOrderLine[] Collection to store aggregation of ChildOrderLine objects.
     */
    protected $collOrderLines;
    protected $collOrderLinesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrderLine[]
     */
    protected $orderLinesScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Order object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Order</code> instance.  If
     * <code>obj</code> is an instance of <code>Order</code>, delegates to
     * <code>equals(Order)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Order The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [optionally formatted] temporal [creation_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreationDate($format = NULL)
    {
        if ($format === null) {
            return $this->creation_date;
        } else {
            return $this->creation_date instanceof \DateTimeInterface ? $this->creation_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [modification_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getModificationDate($format = NULL)
    {
        if ($format === null) {
            return $this->modification_date;
        } else {
            return $this->modification_date instanceof \DateTimeInterface ? $this->modification_date->format($format) : null;
        }
    }

    /**
     * Get the [ordernumber] column value.
     *
     * @return string
     */
    public function getOrdernumber()
    {
        return $this->ordernumber;
    }

    /**
     * Get the [order_status] column value.
     *
     * @return int
     */
    public function getOrderStatus()
    {
        return $this->order_status;
    }

    /**
     * Get the [total_amount_with_tax] column value.
     *
     * @return string
     */
    public function getTotalAmountWithTax()
    {
        return $this->total_amount_with_tax;
    }

    /**
     * Get the [total_amount_without_tax] column value.
     *
     * @return string
     */
    public function getTotalAmountWithoutTax()
    {
        return $this->total_amount_without_tax;
    }

    /**
     * Get the [currency_code] column value.
     *
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currency_code;
    }

    /**
     * Get the [shipping_fee_with_tax] column value.
     *
     * @return string
     */
    public function getShippingFeeWithTax()
    {
        return $this->shipping_fee_with_tax;
    }

    /**
     * Get the [shipping_fee_without_tax] column value.
     *
     * @return string
     */
    public function getShippingFeeWithoutTax()
    {
        return $this->shipping_fee_without_tax;
    }

    /**
     * Get the [billing_address_id] column value.
     *
     * @return int
     */
    public function getBillingAddressId()
    {
        return $this->billing_address_id;
    }

    /**
     * Get the [shipping_address_id] column value.
     *
     * @return int
     */
    public function getShippingAddressId()
    {
        return $this->shipping_address_id;
    }

    /**
     * Get the [user_id] column value.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the [payment_id] column value.
     *
     * @return int
     */
    public function getPaymentId()
    {
        return $this->payment_id;
    }

    /**
     * Get the [shipment_id] column value.
     *
     * @return int
     */
    public function getShipmentId()
    {
        return $this->shipment_id;
    }

    /**
     * Get the [status] column value.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[OrderTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Sets the value of [creation_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setCreationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creation_date !== null || $dt !== null) {
            if ($this->creation_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->creation_date->format("Y-m-d H:i:s.u")) {
                $this->creation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrderTableMap::COL_CREATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setCreationDate()

    /**
     * Sets the value of [modification_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setModificationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->modification_date !== null || $dt !== null) {
            if ($this->modification_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->modification_date->format("Y-m-d H:i:s.u")) {
                $this->modification_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrderTableMap::COL_MODIFICATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setModificationDate()

    /**
     * Set the value of [ordernumber] column.
     *
     * @param string $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setOrdernumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ordernumber !== $v) {
            $this->ordernumber = $v;
            $this->modifiedColumns[OrderTableMap::COL_ORDERNUMBER] = true;
        }

        return $this;
    } // setOrdernumber()

    /**
     * Set the value of [order_status] column.
     *
     * @param int $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setOrderStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->order_status !== $v) {
            $this->order_status = $v;
            $this->modifiedColumns[OrderTableMap::COL_ORDER_STATUS] = true;
        }

        return $this;
    } // setOrderStatus()

    /**
     * Set the value of [total_amount_with_tax] column.
     *
     * @param string $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setTotalAmountWithTax($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->total_amount_with_tax !== $v) {
            $this->total_amount_with_tax = $v;
            $this->modifiedColumns[OrderTableMap::COL_TOTAL_AMOUNT_WITH_TAX] = true;
        }

        return $this;
    } // setTotalAmountWithTax()

    /**
     * Set the value of [total_amount_without_tax] column.
     *
     * @param string $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setTotalAmountWithoutTax($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->total_amount_without_tax !== $v) {
            $this->total_amount_without_tax = $v;
            $this->modifiedColumns[OrderTableMap::COL_TOTAL_AMOUNT_WITHOUT_TAX] = true;
        }

        return $this;
    } // setTotalAmountWithoutTax()

    /**
     * Set the value of [currency_code] column.
     *
     * @param string $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setCurrencyCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->currency_code !== $v) {
            $this->currency_code = $v;
            $this->modifiedColumns[OrderTableMap::COL_CURRENCY_CODE] = true;
        }

        return $this;
    } // setCurrencyCode()

    /**
     * Set the value of [shipping_fee_with_tax] column.
     *
     * @param string $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setShippingFeeWithTax($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->shipping_fee_with_tax !== $v) {
            $this->shipping_fee_with_tax = $v;
            $this->modifiedColumns[OrderTableMap::COL_SHIPPING_FEE_WITH_TAX] = true;
        }

        return $this;
    } // setShippingFeeWithTax()

    /**
     * Set the value of [shipping_fee_without_tax] column.
     *
     * @param string $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setShippingFeeWithoutTax($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->shipping_fee_without_tax !== $v) {
            $this->shipping_fee_without_tax = $v;
            $this->modifiedColumns[OrderTableMap::COL_SHIPPING_FEE_WITHOUT_TAX] = true;
        }

        return $this;
    } // setShippingFeeWithoutTax()

    /**
     * Set the value of [billing_address_id] column.
     *
     * @param int $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setBillingAddressId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->billing_address_id !== $v) {
            $this->billing_address_id = $v;
            $this->modifiedColumns[OrderTableMap::COL_BILLING_ADDRESS_ID] = true;
        }

        return $this;
    } // setBillingAddressId()

    /**
     * Set the value of [shipping_address_id] column.
     *
     * @param int $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setShippingAddressId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->shipping_address_id !== $v) {
            $this->shipping_address_id = $v;
            $this->modifiedColumns[OrderTableMap::COL_SHIPPING_ADDRESS_ID] = true;
        }

        return $this;
    } // setShippingAddressId()

    /**
     * Set the value of [user_id] column.
     *
     * @param int $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[OrderTableMap::COL_USER_ID] = true;
        }

        if ($this->aUser !== null && $this->aUser->getId() !== $v) {
            $this->aUser = null;
        }

        return $this;
    } // setUserId()

    /**
     * Set the value of [payment_id] column.
     *
     * @param int $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setPaymentId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->payment_id !== $v) {
            $this->payment_id = $v;
            $this->modifiedColumns[OrderTableMap::COL_PAYMENT_ID] = true;
        }

        if ($this->aPayment !== null && $this->aPayment->getId() !== $v) {
            $this->aPayment = null;
        }

        return $this;
    } // setPaymentId()

    /**
     * Set the value of [shipment_id] column.
     *
     * @param int $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setShipmentId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->shipment_id !== $v) {
            $this->shipment_id = $v;
            $this->modifiedColumns[OrderTableMap::COL_SHIPMENT_ID] = true;
        }

        if ($this->aShipment !== null && $this->aShipment->getId() !== $v) {
            $this->aShipment = null;
        }

        return $this;
    } // setShipmentId()

    /**
     * Set the value of [status] column.
     *
     * @param int $v new value
     * @return $this|\Order The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[OrderTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OrderTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OrderTableMap::translateFieldName('CreationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->creation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OrderTableMap::translateFieldName('ModificationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->modification_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OrderTableMap::translateFieldName('Ordernumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ordernumber = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OrderTableMap::translateFieldName('OrderStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OrderTableMap::translateFieldName('TotalAmountWithTax', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_amount_with_tax = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OrderTableMap::translateFieldName('TotalAmountWithoutTax', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_amount_without_tax = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OrderTableMap::translateFieldName('CurrencyCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->currency_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OrderTableMap::translateFieldName('ShippingFeeWithTax', TableMap::TYPE_PHPNAME, $indexType)];
            $this->shipping_fee_with_tax = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OrderTableMap::translateFieldName('ShippingFeeWithoutTax', TableMap::TYPE_PHPNAME, $indexType)];
            $this->shipping_fee_without_tax = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : OrderTableMap::translateFieldName('BillingAddressId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->billing_address_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : OrderTableMap::translateFieldName('ShippingAddressId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->shipping_address_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : OrderTableMap::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : OrderTableMap::translateFieldName('PaymentId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->payment_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : OrderTableMap::translateFieldName('ShipmentId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->shipment_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : OrderTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 16; // 16 = OrderTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Order'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aUser !== null && $this->user_id !== $this->aUser->getId()) {
            $this->aUser = null;
        }
        if ($this->aPayment !== null && $this->payment_id !== $this->aPayment->getId()) {
            $this->aPayment = null;
        }
        if ($this->aShipment !== null && $this->shipment_id !== $this->aShipment->getId()) {
            $this->aShipment = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrderTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildOrderQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aPayment = null;
            $this->aShipment = null;
            $this->aUser = null;
            $this->collOrderLines = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Order::setDeleted()
     * @see Order::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildOrderQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                OrderTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aPayment !== null) {
                if ($this->aPayment->isModified() || $this->aPayment->isNew()) {
                    $affectedRows += $this->aPayment->save($con);
                }
                $this->setPayment($this->aPayment);
            }

            if ($this->aShipment !== null) {
                if ($this->aShipment->isModified() || $this->aShipment->isNew()) {
                    $affectedRows += $this->aShipment->save($con);
                }
                $this->setShipment($this->aShipment);
            }

            if ($this->aUser !== null) {
                if ($this->aUser->isModified() || $this->aUser->isNew()) {
                    $affectedRows += $this->aUser->save($con);
                }
                $this->setUser($this->aUser);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->orderLinesScheduledForDeletion !== null) {
                if (!$this->orderLinesScheduledForDeletion->isEmpty()) {
                    \OrderLineQuery::create()
                        ->filterByPrimaryKeys($this->orderLinesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orderLinesScheduledForDeletion = null;
                }
            }

            if ($this->collOrderLines !== null) {
                foreach ($this->collOrderLines as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(OrderTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(OrderTableMap::COL_CREATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'creation_date';
        }
        if ($this->isColumnModified(OrderTableMap::COL_MODIFICATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'modification_date';
        }
        if ($this->isColumnModified(OrderTableMap::COL_ORDERNUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'ordernumber';
        }
        if ($this->isColumnModified(OrderTableMap::COL_ORDER_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'order_status';
        }
        if ($this->isColumnModified(OrderTableMap::COL_TOTAL_AMOUNT_WITH_TAX)) {
            $modifiedColumns[':p' . $index++]  = 'total_amount_with_tax';
        }
        if ($this->isColumnModified(OrderTableMap::COL_TOTAL_AMOUNT_WITHOUT_TAX)) {
            $modifiedColumns[':p' . $index++]  = 'total_amount_without_tax';
        }
        if ($this->isColumnModified(OrderTableMap::COL_CURRENCY_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'currency_code';
        }
        if ($this->isColumnModified(OrderTableMap::COL_SHIPPING_FEE_WITH_TAX)) {
            $modifiedColumns[':p' . $index++]  = 'shipping_fee_with_tax';
        }
        if ($this->isColumnModified(OrderTableMap::COL_SHIPPING_FEE_WITHOUT_TAX)) {
            $modifiedColumns[':p' . $index++]  = 'shipping_fee_without_tax';
        }
        if ($this->isColumnModified(OrderTableMap::COL_BILLING_ADDRESS_ID)) {
            $modifiedColumns[':p' . $index++]  = 'billing_address_id';
        }
        if ($this->isColumnModified(OrderTableMap::COL_SHIPPING_ADDRESS_ID)) {
            $modifiedColumns[':p' . $index++]  = 'shipping_address_id';
        }
        if ($this->isColumnModified(OrderTableMap::COL_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'user_id';
        }
        if ($this->isColumnModified(OrderTableMap::COL_PAYMENT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'payment_id';
        }
        if ($this->isColumnModified(OrderTableMap::COL_SHIPMENT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'shipment_id';
        }
        if ($this->isColumnModified(OrderTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }

        $sql = sprintf(
            'INSERT INTO order (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'creation_date':
                        $stmt->bindValue($identifier, $this->creation_date ? $this->creation_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'modification_date':
                        $stmt->bindValue($identifier, $this->modification_date ? $this->modification_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'ordernumber':
                        $stmt->bindValue($identifier, $this->ordernumber, PDO::PARAM_STR);
                        break;
                    case 'order_status':
                        $stmt->bindValue($identifier, $this->order_status, PDO::PARAM_INT);
                        break;
                    case 'total_amount_with_tax':
                        $stmt->bindValue($identifier, $this->total_amount_with_tax, PDO::PARAM_STR);
                        break;
                    case 'total_amount_without_tax':
                        $stmt->bindValue($identifier, $this->total_amount_without_tax, PDO::PARAM_STR);
                        break;
                    case 'currency_code':
                        $stmt->bindValue($identifier, $this->currency_code, PDO::PARAM_STR);
                        break;
                    case 'shipping_fee_with_tax':
                        $stmt->bindValue($identifier, $this->shipping_fee_with_tax, PDO::PARAM_STR);
                        break;
                    case 'shipping_fee_without_tax':
                        $stmt->bindValue($identifier, $this->shipping_fee_without_tax, PDO::PARAM_STR);
                        break;
                    case 'billing_address_id':
                        $stmt->bindValue($identifier, $this->billing_address_id, PDO::PARAM_INT);
                        break;
                    case 'shipping_address_id':
                        $stmt->bindValue($identifier, $this->shipping_address_id, PDO::PARAM_INT);
                        break;
                    case 'user_id':
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
                        break;
                    case 'payment_id':
                        $stmt->bindValue($identifier, $this->payment_id, PDO::PARAM_INT);
                        break;
                    case 'shipment_id':
                        $stmt->bindValue($identifier, $this->shipment_id, PDO::PARAM_INT);
                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = OrderTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getCreationDate();
                break;
            case 2:
                return $this->getModificationDate();
                break;
            case 3:
                return $this->getOrdernumber();
                break;
            case 4:
                return $this->getOrderStatus();
                break;
            case 5:
                return $this->getTotalAmountWithTax();
                break;
            case 6:
                return $this->getTotalAmountWithoutTax();
                break;
            case 7:
                return $this->getCurrencyCode();
                break;
            case 8:
                return $this->getShippingFeeWithTax();
                break;
            case 9:
                return $this->getShippingFeeWithoutTax();
                break;
            case 10:
                return $this->getBillingAddressId();
                break;
            case 11:
                return $this->getShippingAddressId();
                break;
            case 12:
                return $this->getUserId();
                break;
            case 13:
                return $this->getPaymentId();
                break;
            case 14:
                return $this->getShipmentId();
                break;
            case 15:
                return $this->getStatus();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Order'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Order'][$this->hashCode()] = true;
        $keys = OrderTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCreationDate(),
            $keys[2] => $this->getModificationDate(),
            $keys[3] => $this->getOrdernumber(),
            $keys[4] => $this->getOrderStatus(),
            $keys[5] => $this->getTotalAmountWithTax(),
            $keys[6] => $this->getTotalAmountWithoutTax(),
            $keys[7] => $this->getCurrencyCode(),
            $keys[8] => $this->getShippingFeeWithTax(),
            $keys[9] => $this->getShippingFeeWithoutTax(),
            $keys[10] => $this->getBillingAddressId(),
            $keys[11] => $this->getShippingAddressId(),
            $keys[12] => $this->getUserId(),
            $keys[13] => $this->getPaymentId(),
            $keys[14] => $this->getShipmentId(),
            $keys[15] => $this->getStatus(),
        );
        if ($result[$keys[1]] instanceof \DateTime) {
            $result[$keys[1]] = $result[$keys[1]]->format('c');
        }

        if ($result[$keys[2]] instanceof \DateTime) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aPayment) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'payment';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'payment';
                        break;
                    default:
                        $key = 'Payment';
                }

                $result[$key] = $this->aPayment->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aShipment) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'shipment';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'shipment';
                        break;
                    default:
                        $key = 'Shipment';
                }

                $result[$key] = $this->aShipment->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUser) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'user';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user';
                        break;
                    default:
                        $key = 'User';
                }

                $result[$key] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collOrderLines) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderLines';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'order_lines';
                        break;
                    default:
                        $key = 'OrderLines';
                }

                $result[$key] = $this->collOrderLines->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Order
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = OrderTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Order
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setCreationDate($value);
                break;
            case 2:
                $this->setModificationDate($value);
                break;
            case 3:
                $this->setOrdernumber($value);
                break;
            case 4:
                $this->setOrderStatus($value);
                break;
            case 5:
                $this->setTotalAmountWithTax($value);
                break;
            case 6:
                $this->setTotalAmountWithoutTax($value);
                break;
            case 7:
                $this->setCurrencyCode($value);
                break;
            case 8:
                $this->setShippingFeeWithTax($value);
                break;
            case 9:
                $this->setShippingFeeWithoutTax($value);
                break;
            case 10:
                $this->setBillingAddressId($value);
                break;
            case 11:
                $this->setShippingAddressId($value);
                break;
            case 12:
                $this->setUserId($value);
                break;
            case 13:
                $this->setPaymentId($value);
                break;
            case 14:
                $this->setShipmentId($value);
                break;
            case 15:
                $this->setStatus($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = OrderTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCreationDate($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setModificationDate($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setOrdernumber($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setOrderStatus($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setTotalAmountWithTax($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setTotalAmountWithoutTax($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCurrencyCode($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setShippingFeeWithTax($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setShippingFeeWithoutTax($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setBillingAddressId($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setShippingAddressId($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setUserId($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setPaymentId($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setShipmentId($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setStatus($arr[$keys[15]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Order The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(OrderTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OrderTableMap::COL_ID)) {
            $criteria->add(OrderTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(OrderTableMap::COL_CREATION_DATE)) {
            $criteria->add(OrderTableMap::COL_CREATION_DATE, $this->creation_date);
        }
        if ($this->isColumnModified(OrderTableMap::COL_MODIFICATION_DATE)) {
            $criteria->add(OrderTableMap::COL_MODIFICATION_DATE, $this->modification_date);
        }
        if ($this->isColumnModified(OrderTableMap::COL_ORDERNUMBER)) {
            $criteria->add(OrderTableMap::COL_ORDERNUMBER, $this->ordernumber);
        }
        if ($this->isColumnModified(OrderTableMap::COL_ORDER_STATUS)) {
            $criteria->add(OrderTableMap::COL_ORDER_STATUS, $this->order_status);
        }
        if ($this->isColumnModified(OrderTableMap::COL_TOTAL_AMOUNT_WITH_TAX)) {
            $criteria->add(OrderTableMap::COL_TOTAL_AMOUNT_WITH_TAX, $this->total_amount_with_tax);
        }
        if ($this->isColumnModified(OrderTableMap::COL_TOTAL_AMOUNT_WITHOUT_TAX)) {
            $criteria->add(OrderTableMap::COL_TOTAL_AMOUNT_WITHOUT_TAX, $this->total_amount_without_tax);
        }
        if ($this->isColumnModified(OrderTableMap::COL_CURRENCY_CODE)) {
            $criteria->add(OrderTableMap::COL_CURRENCY_CODE, $this->currency_code);
        }
        if ($this->isColumnModified(OrderTableMap::COL_SHIPPING_FEE_WITH_TAX)) {
            $criteria->add(OrderTableMap::COL_SHIPPING_FEE_WITH_TAX, $this->shipping_fee_with_tax);
        }
        if ($this->isColumnModified(OrderTableMap::COL_SHIPPING_FEE_WITHOUT_TAX)) {
            $criteria->add(OrderTableMap::COL_SHIPPING_FEE_WITHOUT_TAX, $this->shipping_fee_without_tax);
        }
        if ($this->isColumnModified(OrderTableMap::COL_BILLING_ADDRESS_ID)) {
            $criteria->add(OrderTableMap::COL_BILLING_ADDRESS_ID, $this->billing_address_id);
        }
        if ($this->isColumnModified(OrderTableMap::COL_SHIPPING_ADDRESS_ID)) {
            $criteria->add(OrderTableMap::COL_SHIPPING_ADDRESS_ID, $this->shipping_address_id);
        }
        if ($this->isColumnModified(OrderTableMap::COL_USER_ID)) {
            $criteria->add(OrderTableMap::COL_USER_ID, $this->user_id);
        }
        if ($this->isColumnModified(OrderTableMap::COL_PAYMENT_ID)) {
            $criteria->add(OrderTableMap::COL_PAYMENT_ID, $this->payment_id);
        }
        if ($this->isColumnModified(OrderTableMap::COL_SHIPMENT_ID)) {
            $criteria->add(OrderTableMap::COL_SHIPMENT_ID, $this->shipment_id);
        }
        if ($this->isColumnModified(OrderTableMap::COL_STATUS)) {
            $criteria->add(OrderTableMap::COL_STATUS, $this->status);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildOrderQuery::create();
        $criteria->add(OrderTableMap::COL_ID, $this->id);
        $criteria->add(OrderTableMap::COL_USER_ID, $this->user_id);
        $criteria->add(OrderTableMap::COL_PAYMENT_ID, $this->payment_id);
        $criteria->add(OrderTableMap::COL_SHIPMENT_ID, $this->shipment_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId() &&
            null !== $this->getUserId() &&
            null !== $this->getPaymentId() &&
            null !== $this->getShipmentId();

        $validPrimaryKeyFKs = 3;
        $primaryKeyFKs = [];

        //relation fk_order_payment1 to table payment
        if ($this->aPayment && $hash = spl_object_hash($this->aPayment)) {
            $primaryKeyFKs[] = $hash;
        } else {
            $validPrimaryKeyFKs = false;
        }

        //relation fk_order_shipment1 to table shipment
        if ($this->aShipment && $hash = spl_object_hash($this->aShipment)) {
            $primaryKeyFKs[] = $hash;
        } else {
            $validPrimaryKeyFKs = false;
        }

        //relation fk_order_user1 to table user
        if ($this->aUser && $hash = spl_object_hash($this->aUser)) {
            $primaryKeyFKs[] = $hash;
        } else {
            $validPrimaryKeyFKs = false;
        }

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the composite primary key for this object.
     * The array elements will be in same order as specified in XML.
     * @return array
     */
    public function getPrimaryKey()
    {
        $pks = array();
        $pks[0] = $this->getId();
        $pks[1] = $this->getUserId();
        $pks[2] = $this->getPaymentId();
        $pks[3] = $this->getShipmentId();

        return $pks;
    }

    /**
     * Set the [composite] primary key.
     *
     * @param      array $keys The elements of the composite key (order must match the order in XML file).
     * @return void
     */
    public function setPrimaryKey($keys)
    {
        $this->setId($keys[0]);
        $this->setUserId($keys[1]);
        $this->setPaymentId($keys[2]);
        $this->setShipmentId($keys[3]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return (null === $this->getId()) && (null === $this->getUserId()) && (null === $this->getPaymentId()) && (null === $this->getShipmentId());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Order (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setId($this->getId());
        $copyObj->setCreationDate($this->getCreationDate());
        $copyObj->setModificationDate($this->getModificationDate());
        $copyObj->setOrdernumber($this->getOrdernumber());
        $copyObj->setOrderStatus($this->getOrderStatus());
        $copyObj->setTotalAmountWithTax($this->getTotalAmountWithTax());
        $copyObj->setTotalAmountWithoutTax($this->getTotalAmountWithoutTax());
        $copyObj->setCurrencyCode($this->getCurrencyCode());
        $copyObj->setShippingFeeWithTax($this->getShippingFeeWithTax());
        $copyObj->setShippingFeeWithoutTax($this->getShippingFeeWithoutTax());
        $copyObj->setBillingAddressId($this->getBillingAddressId());
        $copyObj->setShippingAddressId($this->getShippingAddressId());
        $copyObj->setUserId($this->getUserId());
        $copyObj->setPaymentId($this->getPaymentId());
        $copyObj->setShipmentId($this->getShipmentId());
        $copyObj->setStatus($this->getStatus());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getOrderLines() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrderLine($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Order Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildPayment object.
     *
     * @param  ChildPayment $v
     * @return $this|\Order The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPayment(ChildPayment $v = null)
    {
        if ($v === null) {
            $this->setPaymentId(NULL);
        } else {
            $this->setPaymentId($v->getId());
        }

        $this->aPayment = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPayment object, it will not be re-added.
        if ($v !== null) {
            $v->addOrder($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPayment object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPayment The associated ChildPayment object.
     * @throws PropelException
     */
    public function getPayment(ConnectionInterface $con = null)
    {
        if ($this->aPayment === null && ($this->payment_id !== null)) {
            $this->aPayment = ChildPaymentQuery::create()
                ->filterByOrder($this) // here
                ->findOne($con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPayment->addOrders($this);
             */
        }

        return $this->aPayment;
    }

    /**
     * Declares an association between this object and a ChildShipment object.
     *
     * @param  ChildShipment $v
     * @return $this|\Order The current object (for fluent API support)
     * @throws PropelException
     */
    public function setShipment(ChildShipment $v = null)
    {
        if ($v === null) {
            $this->setShipmentId(NULL);
        } else {
            $this->setShipmentId($v->getId());
        }

        $this->aShipment = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildShipment object, it will not be re-added.
        if ($v !== null) {
            $v->addOrder($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildShipment object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildShipment The associated ChildShipment object.
     * @throws PropelException
     */
    public function getShipment(ConnectionInterface $con = null)
    {
        if ($this->aShipment === null && ($this->shipment_id !== null)) {
            $this->aShipment = ChildShipmentQuery::create()
                ->filterByOrder($this) // here
                ->findOne($con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aShipment->addOrders($this);
             */
        }

        return $this->aShipment;
    }

    /**
     * Declares an association between this object and a ChildUser object.
     *
     * @param  ChildUser $v
     * @return $this|\Order The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUser(ChildUser $v = null)
    {
        if ($v === null) {
            $this->setUserId(NULL);
        } else {
            $this->setUserId($v->getId());
        }

        $this->aUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUser object, it will not be re-added.
        if ($v !== null) {
            $v->addOrder($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUser object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUser The associated ChildUser object.
     * @throws PropelException
     */
    public function getUser(ConnectionInterface $con = null)
    {
        if ($this->aUser === null && ($this->user_id !== null)) {
            $this->aUser = ChildUserQuery::create()->findPk($this->user_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUser->addOrders($this);
             */
        }

        return $this->aUser;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('OrderLine' == $relationName) {
            return $this->initOrderLines();
        }
    }

    /**
     * Clears out the collOrderLines collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addOrderLines()
     */
    public function clearOrderLines()
    {
        $this->collOrderLines = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collOrderLines collection loaded partially.
     */
    public function resetPartialOrderLines($v = true)
    {
        $this->collOrderLinesPartial = $v;
    }

    /**
     * Initializes the collOrderLines collection.
     *
     * By default this just sets the collOrderLines collection to an empty array (like clearcollOrderLines());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderLines($overrideExisting = true)
    {
        if (null !== $this->collOrderLines && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrderLineTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderLines = new $collectionClassName;
        $this->collOrderLines->setModel('\OrderLine');
    }

    /**
     * Gets an array of ChildOrderLine objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrder is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrderLine[] List of ChildOrderLine objects
     * @throws PropelException
     */
    public function getOrderLines(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderLinesPartial && !$this->isNew();
        if (null === $this->collOrderLines || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collOrderLines) {
                // return empty collection
                $this->initOrderLines();
            } else {
                $collOrderLines = ChildOrderLineQuery::create(null, $criteria)
                    ->filterByOrder($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderLinesPartial && count($collOrderLines)) {
                        $this->initOrderLines(false);

                        foreach ($collOrderLines as $obj) {
                            if (false == $this->collOrderLines->contains($obj)) {
                                $this->collOrderLines->append($obj);
                            }
                        }

                        $this->collOrderLinesPartial = true;
                    }

                    return $collOrderLines;
                }

                if ($partial && $this->collOrderLines) {
                    foreach ($this->collOrderLines as $obj) {
                        if ($obj->isNew()) {
                            $collOrderLines[] = $obj;
                        }
                    }
                }

                $this->collOrderLines = $collOrderLines;
                $this->collOrderLinesPartial = false;
            }
        }

        return $this->collOrderLines;
    }

    /**
     * Sets a collection of ChildOrderLine objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $orderLines A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOrder The current object (for fluent API support)
     */
    public function setOrderLines(Collection $orderLines, ConnectionInterface $con = null)
    {
        /** @var ChildOrderLine[] $orderLinesToDelete */
        $orderLinesToDelete = $this->getOrderLines(new Criteria(), $con)->diff($orderLines);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->orderLinesScheduledForDeletion = clone $orderLinesToDelete;

        foreach ($orderLinesToDelete as $orderLineRemoved) {
            $orderLineRemoved->setOrder(null);
        }

        $this->collOrderLines = null;
        foreach ($orderLines as $orderLine) {
            $this->addOrderLine($orderLine);
        }

        $this->collOrderLines = $orderLines;
        $this->collOrderLinesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OrderLine objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related OrderLine objects.
     * @throws PropelException
     */
    public function countOrderLines(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderLinesPartial && !$this->isNew();
        if (null === $this->collOrderLines || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderLines) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderLines());
            }

            $query = ChildOrderLineQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrder($this)
                ->count($con);
        }

        return count($this->collOrderLines);
    }

    /**
     * Method called to associate a ChildOrderLine object to this object
     * through the ChildOrderLine foreign key attribute.
     *
     * @param  ChildOrderLine $l ChildOrderLine
     * @return $this|\Order The current object (for fluent API support)
     */
    public function addOrderLine(ChildOrderLine $l)
    {
        if ($this->collOrderLines === null) {
            $this->initOrderLines();
            $this->collOrderLinesPartial = true;
        }

        if (!$this->collOrderLines->contains($l)) {
            $this->doAddOrderLine($l);

            if ($this->orderLinesScheduledForDeletion and $this->orderLinesScheduledForDeletion->contains($l)) {
                $this->orderLinesScheduledForDeletion->remove($this->orderLinesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrderLine $orderLine The ChildOrderLine object to add.
     */
    protected function doAddOrderLine(ChildOrderLine $orderLine)
    {
        $this->collOrderLines[]= $orderLine;
        $orderLine->setOrder($this);
    }

    /**
     * @param  ChildOrderLine $orderLine The ChildOrderLine object to remove.
     * @return $this|ChildOrder The current object (for fluent API support)
     */
    public function removeOrderLine(ChildOrderLine $orderLine)
    {
        if ($this->getOrderLines()->contains($orderLine)) {
            $pos = $this->collOrderLines->search($orderLine);
            $this->collOrderLines->remove($pos);
            if (null === $this->orderLinesScheduledForDeletion) {
                $this->orderLinesScheduledForDeletion = clone $this->collOrderLines;
                $this->orderLinesScheduledForDeletion->clear();
            }
            $this->orderLinesScheduledForDeletion[]= clone $orderLine;
            $orderLine->setOrder(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Order is new, it will return
     * an empty collection; or if this Order has previously
     * been saved, it will retrieve related OrderLines from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Order.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderLine[] List of ChildOrderLine objects
     */
    public function getOrderLinesJoinProduct(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderLineQuery::create(null, $criteria);
        $query->joinWith('Product', $joinBehavior);

        return $this->getOrderLines($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aPayment) {
            $this->aPayment->removeOrder($this);
        }
        if (null !== $this->aShipment) {
            $this->aShipment->removeOrder($this);
        }
        if (null !== $this->aUser) {
            $this->aUser->removeOrder($this);
        }
        $this->id = null;
        $this->creation_date = null;
        $this->modification_date = null;
        $this->ordernumber = null;
        $this->order_status = null;
        $this->total_amount_with_tax = null;
        $this->total_amount_without_tax = null;
        $this->currency_code = null;
        $this->shipping_fee_with_tax = null;
        $this->shipping_fee_without_tax = null;
        $this->billing_address_id = null;
        $this->shipping_address_id = null;
        $this->user_id = null;
        $this->payment_id = null;
        $this->shipment_id = null;
        $this->status = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collOrderLines) {
                foreach ($this->collOrderLines as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collOrderLines = null;
        $this->aPayment = null;
        $this->aShipment = null;
        $this->aUser = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OrderTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
