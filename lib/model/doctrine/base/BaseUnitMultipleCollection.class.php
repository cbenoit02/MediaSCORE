<?php

/**
 * BaseUnitMultipleCollection
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property Doctrine_Collection $StorageLocations
 * @property Doctrine_Collection $Personnel
 * @property Doctrine_Collection $CollectionMultipleAssetGroup
 * 
 * @method Doctrine_Collection    getStorageLocations()             Returns the current record's "StorageLocations" collection
 * @method Doctrine_Collection    getPersonnel()                    Returns the current record's "Personnel" collection
 * @method Doctrine_Collection    getCollectionMultipleAssetGroup() Returns the current record's "CollectionMultipleAssetGroup" collection
 * @method UnitMultipleCollection setStorageLocations()             Sets the current record's "StorageLocations" collection
 * @method UnitMultipleCollection setPersonnel()                    Sets the current record's "Personnel" collection
 * @method UnitMultipleCollection setCollectionMultipleAssetGroup() Sets the current record's "CollectionMultipleAssetGroup" collection
 * 
 * @package    mediaSCORE
 * @subpackage model
 * @author     Nouman Tayyab
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUnitMultipleCollection extends Store
{
    public function setUp()
    {
        parent::setUp();
        $this->hasMany('StorageLocation as StorageLocations', array(
             'refClass' => 'UnitStorageLocation',
             'local' => 'unit_id',
             'foreign' => 'storage_location_id'));

        $this->hasMany('Person as Personnel', array(
             'refClass' => 'UnitPerson',
             'local' => 'unit_id',
             'foreign' => 'person_id'));

        $this->hasMany('CollectionMultipleAssetGroup', array(
             'local' => 'id',
             'foreign' => 'parent_node_id'));
    }
}