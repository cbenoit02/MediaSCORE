<?php

/**
 * Betacam form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BetacamForm extends BaseBetacamForm
{
  /**
   * @see FormatTypedVideoRecordingForm
   */
  public function configure()
  {
	  parent::configure();
	  $this->setWidget('size',new sfWidgetFormChoice(array('choices' => Betacam::$constants[0])));
	  $this->setWidget('format',new sfWidgetFormChoice(array('choices' => Betacam::$constants[1])));


	$this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => $this->getObject()->getTypeValue() )));
  }
}