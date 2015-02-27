<?php

/**
 * BaseCharacteristicsConstraints
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $constraint_name
 * @property string $constraint_value
 * @property string $constraint_readable
 * @property Doctrine_Collection $CharacteristicsValues
 * 
 * @method string                     getConstraintName()        Returns the current record's "constraint_name" value
 * @method string                     getConstraintValue()       Returns the current record's "constraint_value" value
 * @method string                     getConstraintReadable()    Returns the current record's "constraint_readable" value
 * @method Doctrine_Collection        getCharacteristicsValues() Returns the current record's "CharacteristicsValues" collection
 * @method CharacteristicsConstraints setConstraintName()        Sets the current record's "constraint_name" value
 * @method CharacteristicsConstraints setConstraintValue()       Sets the current record's "constraint_value" value
 * @method CharacteristicsConstraints setConstraintReadable()    Sets the current record's "constraint_readable" value
 * @method CharacteristicsConstraints setCharacteristicsValues() Sets the current record's "CharacteristicsValues" collection
 * 
 * @package    mediaSCORE
 * @subpackage model
 * @author     Nouman Tayyab
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCharacteristicsConstraints extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('characteristics_constraints');
        $this->hasColumn('constraint_name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('constraint_value', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('constraint_readable', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('CharacteristicsValues', array(
             'local' => 'id',
             'foreign' => 'constraint_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}