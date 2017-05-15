<?php

namespace Base;

use \Media as ChildMedia;
use \MediaQuery as ChildMediaQuery;
use \OrderLine as ChildOrderLine;
use \OrderLineQuery as ChildOrderLineQuery;
use \Product as ChildProduct;
use \ProductPrice as ChildProductPrice;
use \ProductPriceQuery as ChildProductPriceQuery;
use \ProductQuery as ChildProductQuery;
use \ProductShelf as ChildProductShelf;
use \ProductShelfQuery as ChildProductShelfQuery;
use \ProductStock as ChildProductStock;
use \ProductStockQuery as ChildProductStockQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\MediaTableMap;
use Map\OrderLineTableMap;
use Map\ProductPriceTableMap;
use Map\ProductStockTableMap;
use Map\ProductTableMap;
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
 * Base class that represents a row from the 'product' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Product implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ProductTableMap';


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
     * The value for the label field.
     *
     * @var        string
     */
    protected $label;

    /**
     * The value for the date_creation field.
     *
     * @var        DateTime
     */
    protected $date_creation;

    /**
     * The value for the date_modification field.
     *
     * @var        DateTime
     */
    protected $date_modification;

    /**
     * The value for the start_publication_date field.
     *
     * @var        DateTime
     */
    protected $start_publication_date;

    /**
     * The value for the end_publication_date field.
     *
     * @var        DateTime
     */
    protected $end_publication_date;

    /**
     * The value for the sku field.
     *
     * @var        string
     */
    protected $sku;

    /**
     * The value for the weight field.
     *
     * @var        string
     */
    protected $weight;

    /**
     * The value for the status field.
     *
     * @var        int
     */
    protected $status;

    /**
     * The value for the product_shelf_id field.
     *
     * @var        int
     */
    protected $product_shelf_id;

    /**
     * The value for the description field.
     *
     * @var        string
     */
    protected $description;

    /**
     * @var        ChildProductShelf
     */
    protected $aProductShelf;

    /**
     * @var        ObjectCollection|ChildMedia[] Collection to store aggregation of ChildMedia objects.
     */
    protected $collMedias;
    protected $collMediasPartial;

    /**
     * @var        ObjectCollection|ChildOrderLine[] Collection to store aggregation of ChildOrderLine objects.
     */
    protected $collOrderLines;
    protected $collOrderLinesPartial;

    /**
     * @var        ObjectCollection|ChildProductPrice[] Collection to store aggregation of ChildProductPrice objects.
     */
    protected $collProductPrices;
    protected $collProductPricesPartial;

    /**
     * @var        ObjectCollection|ChildProductStock[] Collection to store aggregation of ChildProductStock objects.
     */
    protected $collProductStocks;
    protected $collProductStocksPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildMedia[]
     */
    protected $mediasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrderLine[]
     */
    protected $orderLinesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductPrice[]
     */
    protected $productPricesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductStock[]
     */
    protected $productStocksScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Product object.
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
     * Compares this with another <code>Product</code> instance.  If
     * <code>obj</code> is an instance of <code>Product</code>, delegates to
     * <code>equals(Product)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Product The current object, for fluid interface
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
     * Get the [label] column value.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Get the [optionally formatted] temporal [date_creation] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateCreation($format = NULL)
    {
        if ($format === null) {
            return $this->date_creation;
        } else {
            return $this->date_creation instanceof \DateTimeInterface ? $this->date_creation->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [date_modification] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateModification($format = NULL)
    {
        if ($format === null) {
            return $this->date_modification;
        } else {
            return $this->date_modification instanceof \DateTimeInterface ? $this->date_modification->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [start_publication_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getStartPublicationDate($format = NULL)
    {
        if ($format === null) {
            return $this->start_publication_date;
        } else {
            return $this->start_publication_date instanceof \DateTimeInterface ? $this->start_publication_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [end_publication_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getEndPublicationDate($format = NULL)
    {
        if ($format === null) {
            return $this->end_publication_date;
        } else {
            return $this->end_publication_date instanceof \DateTimeInterface ? $this->end_publication_date->format($format) : null;
        }
    }

    /**
     * Get the [sku] column value.
     *
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Get the [weight] column value.
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
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
     * Get the [product_shelf_id] column value.
     *
     * @return int
     */
    public function getProductShelfId()
    {
        return $this->product_shelf_id;
    }

    /**
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[ProductTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [label] column.
     *
     * @param string $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setLabel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->label !== $v) {
            $this->label = $v;
            $this->modifiedColumns[ProductTableMap::COL_LABEL] = true;
        }

        return $this;
    } // setLabel()

    /**
     * Sets the value of [date_creation] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setDateCreation($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_creation !== null || $dt !== null) {
            if ($this->date_creation === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->date_creation->format("Y-m-d H:i:s.u")) {
                $this->date_creation = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProductTableMap::COL_DATE_CREATION] = true;
            }
        } // if either are not null

        return $this;
    } // setDateCreation()

    /**
     * Sets the value of [date_modification] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setDateModification($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_modification !== null || $dt !== null) {
            if ($this->date_modification === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->date_modification->format("Y-m-d H:i:s.u")) {
                $this->date_modification = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProductTableMap::COL_DATE_MODIFICATION] = true;
            }
        } // if either are not null

        return $this;
    } // setDateModification()

    /**
     * Sets the value of [start_publication_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setStartPublicationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->start_publication_date !== null || $dt !== null) {
            if ($this->start_publication_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->start_publication_date->format("Y-m-d H:i:s.u")) {
                $this->start_publication_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProductTableMap::COL_START_PUBLICATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setStartPublicationDate()

    /**
     * Sets the value of [end_publication_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setEndPublicationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->end_publication_date !== null || $dt !== null) {
            if ($this->end_publication_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->end_publication_date->format("Y-m-d H:i:s.u")) {
                $this->end_publication_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProductTableMap::COL_END_PUBLICATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setEndPublicationDate()

    /**
     * Set the value of [sku] column.
     *
     * @param string $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setSku($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sku !== $v) {
            $this->sku = $v;
            $this->modifiedColumns[ProductTableMap::COL_SKU] = true;
        }

        return $this;
    } // setSku()

    /**
     * Set the value of [weight] column.
     *
     * @param string $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setWeight($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->weight !== $v) {
            $this->weight = $v;
            $this->modifiedColumns[ProductTableMap::COL_WEIGHT] = true;
        }

        return $this;
    } // setWeight()

    /**
     * Set the value of [status] column.
     *
     * @param int $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[ProductTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [product_shelf_id] column.
     *
     * @param int $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setProductShelfId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->product_shelf_id !== $v) {
            $this->product_shelf_id = $v;
            $this->modifiedColumns[ProductTableMap::COL_PRODUCT_SHELF_ID] = true;
        }

        if ($this->aProductShelf !== null && $this->aProductShelf->getId() !== $v) {
            $this->aProductShelf = null;
        }

        return $this;
    } // setProductShelfId()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[ProductTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ProductTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ProductTableMap::translateFieldName('Label', TableMap::TYPE_PHPNAME, $indexType)];
            $this->label = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ProductTableMap::translateFieldName('DateCreation', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->date_creation = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ProductTableMap::translateFieldName('DateModification', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->date_modification = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ProductTableMap::translateFieldName('StartPublicationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->start_publication_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ProductTableMap::translateFieldName('EndPublicationDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->end_publication_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ProductTableMap::translateFieldName('Sku', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sku = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ProductTableMap::translateFieldName('Weight', TableMap::TYPE_PHPNAME, $indexType)];
            $this->weight = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ProductTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ProductTableMap::translateFieldName('ProductShelfId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_shelf_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ProductTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = ProductTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Product'), 0, $e);
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
        if ($this->aProductShelf !== null && $this->product_shelf_id !== $this->aProductShelf->getId()) {
            $this->aProductShelf = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ProductTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildProductQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aProductShelf = null;
            $this->collMedias = null;

            $this->collOrderLines = null;

            $this->collProductPrices = null;

            $this->collProductStocks = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Product::setDeleted()
     * @see Product::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildProductQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
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
                ProductTableMap::addInstanceToPool($this);
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

            if ($this->aProductShelf !== null) {
                if ($this->aProductShelf->isModified() || $this->aProductShelf->isNew()) {
                    $affectedRows += $this->aProductShelf->save($con);
                }
                $this->setProductShelf($this->aProductShelf);
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

            if ($this->mediasScheduledForDeletion !== null) {
                if (!$this->mediasScheduledForDeletion->isEmpty()) {
                    \MediaQuery::create()
                        ->filterByPrimaryKeys($this->mediasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->mediasScheduledForDeletion = null;
                }
            }

            if ($this->collMedias !== null) {
                foreach ($this->collMedias as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

            if ($this->productPricesScheduledForDeletion !== null) {
                if (!$this->productPricesScheduledForDeletion->isEmpty()) {
                    \ProductPriceQuery::create()
                        ->filterByPrimaryKeys($this->productPricesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productPricesScheduledForDeletion = null;
                }
            }

            if ($this->collProductPrices !== null) {
                foreach ($this->collProductPrices as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->productStocksScheduledForDeletion !== null) {
                if (!$this->productStocksScheduledForDeletion->isEmpty()) {
                    \ProductStockQuery::create()
                        ->filterByPrimaryKeys($this->productStocksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productStocksScheduledForDeletion = null;
                }
            }

            if ($this->collProductStocks !== null) {
                foreach ($this->collProductStocks as $referrerFK) {
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
        if ($this->isColumnModified(ProductTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(ProductTableMap::COL_LABEL)) {
            $modifiedColumns[':p' . $index++]  = 'label';
        }
        if ($this->isColumnModified(ProductTableMap::COL_DATE_CREATION)) {
            $modifiedColumns[':p' . $index++]  = 'date_creation';
        }
        if ($this->isColumnModified(ProductTableMap::COL_DATE_MODIFICATION)) {
            $modifiedColumns[':p' . $index++]  = 'date_modification';
        }
        if ($this->isColumnModified(ProductTableMap::COL_START_PUBLICATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'start_publication_date';
        }
        if ($this->isColumnModified(ProductTableMap::COL_END_PUBLICATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'end_publication_date';
        }
        if ($this->isColumnModified(ProductTableMap::COL_SKU)) {
            $modifiedColumns[':p' . $index++]  = 'sku';
        }
        if ($this->isColumnModified(ProductTableMap::COL_WEIGHT)) {
            $modifiedColumns[':p' . $index++]  = 'weight';
        }
        if ($this->isColumnModified(ProductTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_SHELF_ID)) {
            $modifiedColumns[':p' . $index++]  = 'product_shelf_id';
        }
        if ($this->isColumnModified(ProductTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }

        $sql = sprintf(
            'INSERT INTO product (%s) VALUES (%s)',
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
                    case 'label':
                        $stmt->bindValue($identifier, $this->label, PDO::PARAM_STR);
                        break;
                    case 'date_creation':
                        $stmt->bindValue($identifier, $this->date_creation ? $this->date_creation->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'date_modification':
                        $stmt->bindValue($identifier, $this->date_modification ? $this->date_modification->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'start_publication_date':
                        $stmt->bindValue($identifier, $this->start_publication_date ? $this->start_publication_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'end_publication_date':
                        $stmt->bindValue($identifier, $this->end_publication_date ? $this->end_publication_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'sku':
                        $stmt->bindValue($identifier, $this->sku, PDO::PARAM_STR);
                        break;
                    case 'weight':
                        $stmt->bindValue($identifier, $this->weight, PDO::PARAM_STR);
                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case 'product_shelf_id':
                        $stmt->bindValue($identifier, $this->product_shelf_id, PDO::PARAM_INT);
                        break;
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
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
        $pos = ProductTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getLabel();
                break;
            case 2:
                return $this->getDateCreation();
                break;
            case 3:
                return $this->getDateModification();
                break;
            case 4:
                return $this->getStartPublicationDate();
                break;
            case 5:
                return $this->getEndPublicationDate();
                break;
            case 6:
                return $this->getSku();
                break;
            case 7:
                return $this->getWeight();
                break;
            case 8:
                return $this->getStatus();
                break;
            case 9:
                return $this->getProductShelfId();
                break;
            case 10:
                return $this->getDescription();
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

        if (isset($alreadyDumpedObjects['Product'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Product'][$this->hashCode()] = true;
        $keys = ProductTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getLabel(),
            $keys[2] => $this->getDateCreation(),
            $keys[3] => $this->getDateModification(),
            $keys[4] => $this->getStartPublicationDate(),
            $keys[5] => $this->getEndPublicationDate(),
            $keys[6] => $this->getSku(),
            $keys[7] => $this->getWeight(),
            $keys[8] => $this->getStatus(),
            $keys[9] => $this->getProductShelfId(),
            $keys[10] => $this->getDescription(),
        );
        if ($result[$keys[2]] instanceof \DateTime) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }

        if ($result[$keys[3]] instanceof \DateTime) {
            $result[$keys[3]] = $result[$keys[3]]->format('c');
        }

        if ($result[$keys[4]] instanceof \DateTime) {
            $result[$keys[4]] = $result[$keys[4]]->format('c');
        }

        if ($result[$keys[5]] instanceof \DateTime) {
            $result[$keys[5]] = $result[$keys[5]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aProductShelf) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productShelf';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'product_shelf';
                        break;
                    default:
                        $key = 'ProductShelf';
                }

                $result[$key] = $this->aProductShelf->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collMedias) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'medias';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'medias';
                        break;
                    default:
                        $key = 'Medias';
                }

                $result[$key] = $this->collMedias->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collProductPrices) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productPrices';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'product_prices';
                        break;
                    default:
                        $key = 'ProductPrices';
                }

                $result[$key] = $this->collProductPrices->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductStocks) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productStocks';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'product_stocks';
                        break;
                    default:
                        $key = 'ProductStocks';
                }

                $result[$key] = $this->collProductStocks->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Product
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProductTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Product
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setLabel($value);
                break;
            case 2:
                $this->setDateCreation($value);
                break;
            case 3:
                $this->setDateModification($value);
                break;
            case 4:
                $this->setStartPublicationDate($value);
                break;
            case 5:
                $this->setEndPublicationDate($value);
                break;
            case 6:
                $this->setSku($value);
                break;
            case 7:
                $this->setWeight($value);
                break;
            case 8:
                $this->setStatus($value);
                break;
            case 9:
                $this->setProductShelfId($value);
                break;
            case 10:
                $this->setDescription($value);
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
        $keys = ProductTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setLabel($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDateCreation($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDateModification($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setStartPublicationDate($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setEndPublicationDate($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setSku($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setWeight($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setStatus($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setProductShelfId($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setDescription($arr[$keys[10]]);
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
     * @return $this|\Product The current object, for fluid interface
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
        $criteria = new Criteria(ProductTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ProductTableMap::COL_ID)) {
            $criteria->add(ProductTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ProductTableMap::COL_LABEL)) {
            $criteria->add(ProductTableMap::COL_LABEL, $this->label);
        }
        if ($this->isColumnModified(ProductTableMap::COL_DATE_CREATION)) {
            $criteria->add(ProductTableMap::COL_DATE_CREATION, $this->date_creation);
        }
        if ($this->isColumnModified(ProductTableMap::COL_DATE_MODIFICATION)) {
            $criteria->add(ProductTableMap::COL_DATE_MODIFICATION, $this->date_modification);
        }
        if ($this->isColumnModified(ProductTableMap::COL_START_PUBLICATION_DATE)) {
            $criteria->add(ProductTableMap::COL_START_PUBLICATION_DATE, $this->start_publication_date);
        }
        if ($this->isColumnModified(ProductTableMap::COL_END_PUBLICATION_DATE)) {
            $criteria->add(ProductTableMap::COL_END_PUBLICATION_DATE, $this->end_publication_date);
        }
        if ($this->isColumnModified(ProductTableMap::COL_SKU)) {
            $criteria->add(ProductTableMap::COL_SKU, $this->sku);
        }
        if ($this->isColumnModified(ProductTableMap::COL_WEIGHT)) {
            $criteria->add(ProductTableMap::COL_WEIGHT, $this->weight);
        }
        if ($this->isColumnModified(ProductTableMap::COL_STATUS)) {
            $criteria->add(ProductTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(ProductTableMap::COL_PRODUCT_SHELF_ID)) {
            $criteria->add(ProductTableMap::COL_PRODUCT_SHELF_ID, $this->product_shelf_id);
        }
        if ($this->isColumnModified(ProductTableMap::COL_DESCRIPTION)) {
            $criteria->add(ProductTableMap::COL_DESCRIPTION, $this->description);
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
        $criteria = ChildProductQuery::create();
        $criteria->add(ProductTableMap::COL_ID, $this->id);
        $criteria->add(ProductTableMap::COL_PRODUCT_SHELF_ID, $this->product_shelf_id);

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
            null !== $this->getProductShelfId();

        $validPrimaryKeyFKs = 1;
        $primaryKeyFKs = [];

        //relation fk_product_product_shelf1 to table product_shelf
        if ($this->aProductShelf && $hash = spl_object_hash($this->aProductShelf)) {
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
        $pks[1] = $this->getProductShelfId();

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
        $this->setProductShelfId($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return (null === $this->getId()) && (null === $this->getProductShelfId());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Product (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setId($this->getId());
        $copyObj->setLabel($this->getLabel());
        $copyObj->setDateCreation($this->getDateCreation());
        $copyObj->setDateModification($this->getDateModification());
        $copyObj->setStartPublicationDate($this->getStartPublicationDate());
        $copyObj->setEndPublicationDate($this->getEndPublicationDate());
        $copyObj->setSku($this->getSku());
        $copyObj->setWeight($this->getWeight());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setProductShelfId($this->getProductShelfId());
        $copyObj->setDescription($this->getDescription());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getMedias() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMedia($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderLines() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrderLine($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductPrices() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductPrice($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductStocks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductStock($relObj->copy($deepCopy));
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
     * @return \Product Clone of current object.
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
     * Declares an association between this object and a ChildProductShelf object.
     *
     * @param  ChildProductShelf $v
     * @return $this|\Product The current object (for fluent API support)
     * @throws PropelException
     */
    public function setProductShelf(ChildProductShelf $v = null)
    {
        if ($v === null) {
            $this->setProductShelfId(NULL);
        } else {
            $this->setProductShelfId($v->getId());
        }

        $this->aProductShelf = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildProductShelf object, it will not be re-added.
        if ($v !== null) {
            $v->addProduct($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildProductShelf object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildProductShelf The associated ChildProductShelf object.
     * @throws PropelException
     */
    public function getProductShelf(ConnectionInterface $con = null)
    {
        if ($this->aProductShelf === null && ($this->product_shelf_id !== null)) {
            $this->aProductShelf = ChildProductShelfQuery::create()->findPk($this->product_shelf_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProductShelf->addProducts($this);
             */
        }

        return $this->aProductShelf;
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
        if ('Media' == $relationName) {
            return $this->initMedias();
        }
        if ('OrderLine' == $relationName) {
            return $this->initOrderLines();
        }
        if ('ProductPrice' == $relationName) {
            return $this->initProductPrices();
        }
        if ('ProductStock' == $relationName) {
            return $this->initProductStocks();
        }
    }

    /**
     * Clears out the collMedias collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addMedias()
     */
    public function clearMedias()
    {
        $this->collMedias = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collMedias collection loaded partially.
     */
    public function resetPartialMedias($v = true)
    {
        $this->collMediasPartial = $v;
    }

    /**
     * Initializes the collMedias collection.
     *
     * By default this just sets the collMedias collection to an empty array (like clearcollMedias());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMedias($overrideExisting = true)
    {
        if (null !== $this->collMedias && !$overrideExisting) {
            return;
        }

        $collectionClassName = MediaTableMap::getTableMap()->getCollectionClassName();

        $this->collMedias = new $collectionClassName;
        $this->collMedias->setModel('\Media');
    }

    /**
     * Gets an array of ChildMedia objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProduct is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildMedia[] List of ChildMedia objects
     * @throws PropelException
     */
    public function getMedias(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collMediasPartial && !$this->isNew();
        if (null === $this->collMedias || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMedias) {
                // return empty collection
                $this->initMedias();
            } else {
                $collMedias = ChildMediaQuery::create(null, $criteria)
                    ->filterByProduct($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMediasPartial && count($collMedias)) {
                        $this->initMedias(false);

                        foreach ($collMedias as $obj) {
                            if (false == $this->collMedias->contains($obj)) {
                                $this->collMedias->append($obj);
                            }
                        }

                        $this->collMediasPartial = true;
                    }

                    return $collMedias;
                }

                if ($partial && $this->collMedias) {
                    foreach ($this->collMedias as $obj) {
                        if ($obj->isNew()) {
                            $collMedias[] = $obj;
                        }
                    }
                }

                $this->collMedias = $collMedias;
                $this->collMediasPartial = false;
            }
        }

        return $this->collMedias;
    }

    /**
     * Sets a collection of ChildMedia objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $medias A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function setMedias(Collection $medias, ConnectionInterface $con = null)
    {
        /** @var ChildMedia[] $mediasToDelete */
        $mediasToDelete = $this->getMedias(new Criteria(), $con)->diff($medias);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->mediasScheduledForDeletion = clone $mediasToDelete;

        foreach ($mediasToDelete as $mediaRemoved) {
            $mediaRemoved->setProduct(null);
        }

        $this->collMedias = null;
        foreach ($medias as $media) {
            $this->addMedia($media);
        }

        $this->collMedias = $medias;
        $this->collMediasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Media objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Media objects.
     * @throws PropelException
     */
    public function countMedias(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collMediasPartial && !$this->isNew();
        if (null === $this->collMedias || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMedias) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMedias());
            }

            $query = ChildMediaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collMedias);
    }

    /**
     * Method called to associate a ChildMedia object to this object
     * through the ChildMedia foreign key attribute.
     *
     * @param  ChildMedia $l ChildMedia
     * @return $this|\Product The current object (for fluent API support)
     */
    public function addMedia(ChildMedia $l)
    {
        if ($this->collMedias === null) {
            $this->initMedias();
            $this->collMediasPartial = true;
        }

        if (!$this->collMedias->contains($l)) {
            $this->doAddMedia($l);

            if ($this->mediasScheduledForDeletion and $this->mediasScheduledForDeletion->contains($l)) {
                $this->mediasScheduledForDeletion->remove($this->mediasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildMedia $media The ChildMedia object to add.
     */
    protected function doAddMedia(ChildMedia $media)
    {
        $this->collMedias[]= $media;
        $media->setProduct($this);
    }

    /**
     * @param  ChildMedia $media The ChildMedia object to remove.
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function removeMedia(ChildMedia $media)
    {
        if ($this->getMedias()->contains($media)) {
            $pos = $this->collMedias->search($media);
            $this->collMedias->remove($pos);
            if (null === $this->mediasScheduledForDeletion) {
                $this->mediasScheduledForDeletion = clone $this->collMedias;
                $this->mediasScheduledForDeletion->clear();
            }
            $this->mediasScheduledForDeletion[]= clone $media;
            $media->setProduct(null);
        }

        return $this;
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
     * If this ChildProduct is new, it will return
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
                    ->filterByProduct($this)
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
     * @return $this|ChildProduct The current object (for fluent API support)
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
            $orderLineRemoved->setProduct(null);
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
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collOrderLines);
    }

    /**
     * Method called to associate a ChildOrderLine object to this object
     * through the ChildOrderLine foreign key attribute.
     *
     * @param  ChildOrderLine $l ChildOrderLine
     * @return $this|\Product The current object (for fluent API support)
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
        $orderLine->setProduct($this);
    }

    /**
     * @param  ChildOrderLine $orderLine The ChildOrderLine object to remove.
     * @return $this|ChildProduct The current object (for fluent API support)
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
            $orderLine->setProduct(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Product is new, it will return
     * an empty collection; or if this Product has previously
     * been saved, it will retrieve related OrderLines from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Product.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderLine[] List of ChildOrderLine objects
     */
    public function getOrderLinesJoinOrder(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderLineQuery::create(null, $criteria);
        $query->joinWith('Order', $joinBehavior);

        return $this->getOrderLines($query, $con);
    }

    /**
     * Clears out the collProductPrices collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProductPrices()
     */
    public function clearProductPrices()
    {
        $this->collProductPrices = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProductPrices collection loaded partially.
     */
    public function resetPartialProductPrices($v = true)
    {
        $this->collProductPricesPartial = $v;
    }

    /**
     * Initializes the collProductPrices collection.
     *
     * By default this just sets the collProductPrices collection to an empty array (like clearcollProductPrices());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductPrices($overrideExisting = true)
    {
        if (null !== $this->collProductPrices && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductPriceTableMap::getTableMap()->getCollectionClassName();

        $this->collProductPrices = new $collectionClassName;
        $this->collProductPrices->setModel('\ProductPrice');
    }

    /**
     * Gets an array of ChildProductPrice objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProduct is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductPrice[] List of ChildProductPrice objects
     * @throws PropelException
     */
    public function getProductPrices(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProductPricesPartial && !$this->isNew();
        if (null === $this->collProductPrices || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProductPrices) {
                // return empty collection
                $this->initProductPrices();
            } else {
                $collProductPrices = ChildProductPriceQuery::create(null, $criteria)
                    ->filterByProduct($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductPricesPartial && count($collProductPrices)) {
                        $this->initProductPrices(false);

                        foreach ($collProductPrices as $obj) {
                            if (false == $this->collProductPrices->contains($obj)) {
                                $this->collProductPrices->append($obj);
                            }
                        }

                        $this->collProductPricesPartial = true;
                    }

                    return $collProductPrices;
                }

                if ($partial && $this->collProductPrices) {
                    foreach ($this->collProductPrices as $obj) {
                        if ($obj->isNew()) {
                            $collProductPrices[] = $obj;
                        }
                    }
                }

                $this->collProductPrices = $collProductPrices;
                $this->collProductPricesPartial = false;
            }
        }

        return $this->collProductPrices;
    }

    /**
     * Sets a collection of ChildProductPrice objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $productPrices A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function setProductPrices(Collection $productPrices, ConnectionInterface $con = null)
    {
        /** @var ChildProductPrice[] $productPricesToDelete */
        $productPricesToDelete = $this->getProductPrices(new Criteria(), $con)->diff($productPrices);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->productPricesScheduledForDeletion = clone $productPricesToDelete;

        foreach ($productPricesToDelete as $productPriceRemoved) {
            $productPriceRemoved->setProduct(null);
        }

        $this->collProductPrices = null;
        foreach ($productPrices as $productPrice) {
            $this->addProductPrice($productPrice);
        }

        $this->collProductPrices = $productPrices;
        $this->collProductPricesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductPrice objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProductPrice objects.
     * @throws PropelException
     */
    public function countProductPrices(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProductPricesPartial && !$this->isNew();
        if (null === $this->collProductPrices || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductPrices) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductPrices());
            }

            $query = ChildProductPriceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collProductPrices);
    }

    /**
     * Method called to associate a ChildProductPrice object to this object
     * through the ChildProductPrice foreign key attribute.
     *
     * @param  ChildProductPrice $l ChildProductPrice
     * @return $this|\Product The current object (for fluent API support)
     */
    public function addProductPrice(ChildProductPrice $l)
    {
        if ($this->collProductPrices === null) {
            $this->initProductPrices();
            $this->collProductPricesPartial = true;
        }

        if (!$this->collProductPrices->contains($l)) {
            $this->doAddProductPrice($l);

            if ($this->productPricesScheduledForDeletion and $this->productPricesScheduledForDeletion->contains($l)) {
                $this->productPricesScheduledForDeletion->remove($this->productPricesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductPrice $productPrice The ChildProductPrice object to add.
     */
    protected function doAddProductPrice(ChildProductPrice $productPrice)
    {
        $this->collProductPrices[]= $productPrice;
        $productPrice->setProduct($this);
    }

    /**
     * @param  ChildProductPrice $productPrice The ChildProductPrice object to remove.
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function removeProductPrice(ChildProductPrice $productPrice)
    {
        if ($this->getProductPrices()->contains($productPrice)) {
            $pos = $this->collProductPrices->search($productPrice);
            $this->collProductPrices->remove($pos);
            if (null === $this->productPricesScheduledForDeletion) {
                $this->productPricesScheduledForDeletion = clone $this->collProductPrices;
                $this->productPricesScheduledForDeletion->clear();
            }
            $this->productPricesScheduledForDeletion[]= clone $productPrice;
            $productPrice->setProduct(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Product is new, it will return
     * an empty collection; or if this Product has previously
     * been saved, it will retrieve related ProductPrices from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Product.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProductPrice[] List of ChildProductPrice objects
     */
    public function getProductPricesJoinCurrency(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductPriceQuery::create(null, $criteria);
        $query->joinWith('Currency', $joinBehavior);

        return $this->getProductPrices($query, $con);
    }

    /**
     * Clears out the collProductStocks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProductStocks()
     */
    public function clearProductStocks()
    {
        $this->collProductStocks = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProductStocks collection loaded partially.
     */
    public function resetPartialProductStocks($v = true)
    {
        $this->collProductStocksPartial = $v;
    }

    /**
     * Initializes the collProductStocks collection.
     *
     * By default this just sets the collProductStocks collection to an empty array (like clearcollProductStocks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductStocks($overrideExisting = true)
    {
        if (null !== $this->collProductStocks && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductStockTableMap::getTableMap()->getCollectionClassName();

        $this->collProductStocks = new $collectionClassName;
        $this->collProductStocks->setModel('\ProductStock');
    }

    /**
     * Gets an array of ChildProductStock objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProduct is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductStock[] List of ChildProductStock objects
     * @throws PropelException
     */
    public function getProductStocks(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProductStocksPartial && !$this->isNew();
        if (null === $this->collProductStocks || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProductStocks) {
                // return empty collection
                $this->initProductStocks();
            } else {
                $collProductStocks = ChildProductStockQuery::create(null, $criteria)
                    ->filterByProduct($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductStocksPartial && count($collProductStocks)) {
                        $this->initProductStocks(false);

                        foreach ($collProductStocks as $obj) {
                            if (false == $this->collProductStocks->contains($obj)) {
                                $this->collProductStocks->append($obj);
                            }
                        }

                        $this->collProductStocksPartial = true;
                    }

                    return $collProductStocks;
                }

                if ($partial && $this->collProductStocks) {
                    foreach ($this->collProductStocks as $obj) {
                        if ($obj->isNew()) {
                            $collProductStocks[] = $obj;
                        }
                    }
                }

                $this->collProductStocks = $collProductStocks;
                $this->collProductStocksPartial = false;
            }
        }

        return $this->collProductStocks;
    }

    /**
     * Sets a collection of ChildProductStock objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $productStocks A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function setProductStocks(Collection $productStocks, ConnectionInterface $con = null)
    {
        /** @var ChildProductStock[] $productStocksToDelete */
        $productStocksToDelete = $this->getProductStocks(new Criteria(), $con)->diff($productStocks);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->productStocksScheduledForDeletion = clone $productStocksToDelete;

        foreach ($productStocksToDelete as $productStockRemoved) {
            $productStockRemoved->setProduct(null);
        }

        $this->collProductStocks = null;
        foreach ($productStocks as $productStock) {
            $this->addProductStock($productStock);
        }

        $this->collProductStocks = $productStocks;
        $this->collProductStocksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductStock objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProductStock objects.
     * @throws PropelException
     */
    public function countProductStocks(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProductStocksPartial && !$this->isNew();
        if (null === $this->collProductStocks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductStocks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductStocks());
            }

            $query = ChildProductStockQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collProductStocks);
    }

    /**
     * Method called to associate a ChildProductStock object to this object
     * through the ChildProductStock foreign key attribute.
     *
     * @param  ChildProductStock $l ChildProductStock
     * @return $this|\Product The current object (for fluent API support)
     */
    public function addProductStock(ChildProductStock $l)
    {
        if ($this->collProductStocks === null) {
            $this->initProductStocks();
            $this->collProductStocksPartial = true;
        }

        if (!$this->collProductStocks->contains($l)) {
            $this->doAddProductStock($l);

            if ($this->productStocksScheduledForDeletion and $this->productStocksScheduledForDeletion->contains($l)) {
                $this->productStocksScheduledForDeletion->remove($this->productStocksScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductStock $productStock The ChildProductStock object to add.
     */
    protected function doAddProductStock(ChildProductStock $productStock)
    {
        $this->collProductStocks[]= $productStock;
        $productStock->setProduct($this);
    }

    /**
     * @param  ChildProductStock $productStock The ChildProductStock object to remove.
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function removeProductStock(ChildProductStock $productStock)
    {
        if ($this->getProductStocks()->contains($productStock)) {
            $pos = $this->collProductStocks->search($productStock);
            $this->collProductStocks->remove($pos);
            if (null === $this->productStocksScheduledForDeletion) {
                $this->productStocksScheduledForDeletion = clone $this->collProductStocks;
                $this->productStocksScheduledForDeletion->clear();
            }
            $this->productStocksScheduledForDeletion[]= clone $productStock;
            $productStock->setProduct(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aProductShelf) {
            $this->aProductShelf->removeProduct($this);
        }
        $this->id = null;
        $this->label = null;
        $this->date_creation = null;
        $this->date_modification = null;
        $this->start_publication_date = null;
        $this->end_publication_date = null;
        $this->sku = null;
        $this->weight = null;
        $this->status = null;
        $this->product_shelf_id = null;
        $this->description = null;
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
            if ($this->collMedias) {
                foreach ($this->collMedias as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderLines) {
                foreach ($this->collOrderLines as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductPrices) {
                foreach ($this->collProductPrices as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductStocks) {
                foreach ($this->collProductStocks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collMedias = null;
        $this->collOrderLines = null;
        $this->collProductPrices = null;
        $this->collProductStocks = null;
        $this->aProductShelf = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProductTableMap::DEFAULT_STRING_FORMAT);
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
