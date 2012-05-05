<?php

/**
 * SizedVideoRecordingFormatType form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SizedVideoRecordingFormatTypeForm extends BaseSizedVideoRecordingFormatTypeForm
{
  /**
   * @see VideoRecordingFormatTypeForm
   */
  public function configure()
  {
	  parent::configure();
	  $this->setWidget('size',new sfWidgetFormChoice(array('choices' => SizedVideoRecordingFormatType::$constants)));

  }
}