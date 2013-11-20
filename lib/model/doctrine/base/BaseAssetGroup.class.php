<?php

/**
 * BaseAssetGroup
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property Collection $Collection
 * @property FormatType $FormatType
 * @property Doctrine_Collection $EvaluatorHistory
 * 
 * @method Collection          getCollection()       Returns the current record's "Collection" value
 * @method FormatType          getFormatType()       Returns the current record's "FormatType" value
 * @method Doctrine_Collection getEvaluatorHistory() Returns the current record's "EvaluatorHistory" collection
 * @method AssetGroup          setCollection()       Sets the current record's "Collection" value
 * @method AssetGroup          setFormatType()       Sets the current record's "FormatType" value
 * @method AssetGroup          setEvaluatorHistory() Sets the current record's "EvaluatorHistory" collection
 * 
 * @package    mediaSCORE
 * @subpackage model
 * @author     Nouman Tayyab
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAssetGroup extends SubUnit
{
    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Collection', array(
             'local' => 'parent_node_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('FormatType', array(
             'local' => 'format_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('EvaluatorHistory', array(
             'local' => 'id',
             'foreign' => 'asset_group_id',
             'onDelete' => 'CASCADE'));
    }
}