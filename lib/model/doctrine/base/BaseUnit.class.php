<?php

/**
 * BaseUnit
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property Doctrine_Collection $StorageLocations
 * @property Doctrine_Collection $Personnel
 * @property Collection $Collection
 * @property Doctrine_Collection $UnitStorageLocation
 * @property Doctrine_Collection $UnitPerson
 * @property SubUnit $childNodes
 * 
 * @method Doctrine_Collection getStorageLocations()    Returns the current record's "StorageLocations" collection
 * @method Doctrine_Collection getPersonnel()           Returns the current record's "Personnel" collection
 * @method Collection          getCollection()          Returns the current record's "Collection" value
 * @method Doctrine_Collection getUnitStorageLocation() Returns the current record's "UnitStorageLocation" collection
 * @method Doctrine_Collection getUnitPerson()          Returns the current record's "UnitPerson" collection
 * @method SubUnit             getChildNodes()          Returns the current record's "childNodes" value
 * @method Unit                setStorageLocations()    Sets the current record's "StorageLocations" collection
 * @method Unit                setPersonnel()           Sets the current record's "Personnel" collection
 * @method Unit                setCollection()          Sets the current record's "Collection" value
 * @method Unit                setUnitStorageLocation() Sets the current record's "UnitStorageLocation" collection
 * @method Unit                setUnitPerson()          Sets the current record's "UnitPerson" collection
 * @method Unit                setChildNodes()          Sets the current record's "childNodes" value
 * 
 * @package    mediaSCORE
 * @subpackage model
 * @author     Nouman Tayyab
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUnit extends Store
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

        $this->hasOne('Collection', array(
             'local' => 'id',
             'foreign' => 'parent_node_id'));

        $this->hasMany('UnitStorageLocation', array(
             'local' => 'id',
             'foreign' => 'unit_id'));

        $this->hasMany('UnitPerson', array(
             'local' => 'id',
             'foreign' => 'unit_id'));

        $this->hasOne('SubUnit as childNodes', array(
             'local' => 'id',
             'foreign' => 'parent_node_id'));
    }
}