<?php

/**
 * BaseCollection
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property Unit $Unit
 * @property AssetGroup $AssetGroup
 * @property Doctrine_Collection $StorageLocations
 * @property Doctrine_Collection $CollectionStorageLocation
 * 
 * @method Unit                getUnit()                      Returns the current record's "Unit" value
 * @method AssetGroup          getAssetGroup()                Returns the current record's "AssetGroup" value
 * @method Doctrine_Collection getStorageLocations()          Returns the current record's "StorageLocations" collection
 * @method Doctrine_Collection getCollectionStorageLocation() Returns the current record's "CollectionStorageLocation" collection
 * @method Collection          setUnit()                      Sets the current record's "Unit" value
 * @method Collection          setAssetGroup()                Sets the current record's "AssetGroup" value
 * @method Collection          setStorageLocations()          Sets the current record's "StorageLocations" collection
 * @method Collection          setCollectionStorageLocation() Sets the current record's "CollectionStorageLocation" collection
 * 
 * @package    mediaSCORE
 * @subpackage model
 * @author     Nouman Tayyab
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCollection extends SubUnit
{
    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Unit', array(
             'local' => 'parent_node_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('AssetGroup', array(
             'local' => 'id',
             'foreign' => 'parent_node_id'));

        $this->hasMany('StorageLocation as StorageLocations', array(
             'refClass' => 'CollectionStorageLocation',
             'local' => 'collection_id',
             'foreign' => 'storage_location_id'));

        $this->hasMany('CollectionStorageLocation', array(
             'local' => 'id',
             'foreign' => 'collection_id'));
    }
}