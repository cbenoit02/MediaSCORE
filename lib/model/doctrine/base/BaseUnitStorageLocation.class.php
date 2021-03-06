<?php

/**
 * BaseUnitStorageLocation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $unit_id
 * @property integer $storage_location_id
 * @property Unit $Unit
 * @property StorageLocation $StorageLocation
 * 
 * @method integer             getUnitId()              Returns the current record's "unit_id" value
 * @method integer             getStorageLocationId()   Returns the current record's "storage_location_id" value
 * @method Unit                getUnit()                Returns the current record's "Unit" value
 * @method StorageLocation     getStorageLocation()     Returns the current record's "StorageLocation" value
 * @method UnitStorageLocation setUnitId()              Sets the current record's "unit_id" value
 * @method UnitStorageLocation setStorageLocationId()   Sets the current record's "storage_location_id" value
 * @method UnitStorageLocation setUnit()                Sets the current record's "Unit" value
 * @method UnitStorageLocation setStorageLocation()     Sets the current record's "StorageLocation" value
 * 
 * @package    mediaSCORE
 * @subpackage model
 * @author     Nouman Tayyab
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUnitStorageLocation extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('unit_storage_location');
        $this->hasColumn('unit_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('storage_location_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Unit', array(
             'local' => 'unit_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));

        $this->hasOne('StorageLocation', array(
             'local' => 'storage_location_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));
    }
}