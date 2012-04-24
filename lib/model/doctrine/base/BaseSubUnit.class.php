<?php

/**
 * BaseSubUnit
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property Unit $Unit
 * 
 * @method Unit    getUnit() Returns the current record's "Unit" value
 * @method SubUnit setUnit() Sets the current record's "Unit" value
 * 
 * @package    mediaSCORE
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSubUnit extends Store
{
    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Unit', array(
             'local' => 'parent_node_id',
             'foreign' => 'id'));
    }
}