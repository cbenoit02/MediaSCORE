<?php

/**
 * OneInchOpenReelVideo form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OneInchOpenReelVideoForm extends BaseOneInchOpenReelVideoForm
{
  /**
   * @see OpenReelVideoFormatTypeForm
   */
  public function configure()
  {
	  parent::configure();
	  $this->setWidget('format',new sfWidgetFormChoice(array('choices' => OneInchOpenReelVideo::$constants[0])));
	  $this->setWidget('reelSize',new sfWidgetFormChoice(array('choices' => OneInchOpenReelVideo::$constants[1])));
	  $this->setWidget('whiteResidue',new sfWidgetFormInputCheckbox());

	$this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => $this->getObject()->getTypeValue() )));
  }
}