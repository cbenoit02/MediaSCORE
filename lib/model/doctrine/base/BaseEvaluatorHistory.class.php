<?php

/**
 * BaseEvaluatorHistory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $type
 * @property integer $evaluator_id
 * @property integer $asset_group_id
 * @property date $updated_at
 * @property Doctrine_Collection $consultedPersonnel
 * @property Store $Store
 * @property AssetGroup $AssetGroup
 * 
 * @method integer             getType()               Returns the current record's "type" value
 * @method integer             getEvaluatorId()        Returns the current record's "evaluator_id" value
 * @method integer             getAssetGroupId()       Returns the current record's "asset_group_id" value
 * @method date                getUpdatedAt()          Returns the current record's "updated_at" value
 * @method Doctrine_Collection getConsultedPersonnel() Returns the current record's "consultedPersonnel" collection
 * @method Store               getStore()              Returns the current record's "Store" value
 * @method AssetGroup          getAssetGroup()         Returns the current record's "AssetGroup" value
 * @method EvaluatorHistory    setType()               Sets the current record's "type" value
 * @method EvaluatorHistory    setEvaluatorId()        Sets the current record's "evaluator_id" value
 * @method EvaluatorHistory    setAssetGroupId()       Sets the current record's "asset_group_id" value
 * @method EvaluatorHistory    setUpdatedAt()          Sets the current record's "updated_at" value
 * @method EvaluatorHistory    setConsultedPersonnel() Sets the current record's "consultedPersonnel" collection
 * @method EvaluatorHistory    setStore()              Sets the current record's "Store" value
 * @method EvaluatorHistory    setAssetGroup()         Sets the current record's "AssetGroup" value
 * 
 * @package    mediaSCORE
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEvaluatorHistory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('evaluator_history');
        $this->hasColumn('type', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('evaluator_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('asset_group_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('updated_at', 'date', null, array(
             'type' => 'date',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Person as consultedPersonnel', array(
             'refClass' => 'EvaluatorHistoryPersonnel',
             'local' => 'evaluator_history_id',
             'foreign' => 'person_id'));

        $this->hasOne('Store', array(
             'local' => 'asset_group_id',
             'foreign' => 'id'));

        $this->hasOne('AssetGroup', array(
             'local' => 'asset_group_id',
             'foreign' => 'id'));
    }
}