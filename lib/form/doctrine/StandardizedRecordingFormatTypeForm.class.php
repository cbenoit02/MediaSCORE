<?php

/**
 * StandardizedRecordingFormatType form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class StandardizedRecordingFormatTypeForm extends BaseStandardizedRecordingFormatTypeForm {

    /**
     * @see DiskFormatTypeForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('recordingStandard', new sfWidgetFormChoice(array('choices' => StandardizedRecordingFormatType::$constants), array('class' => 'override_required')));
        $this->setValidator('recordingStandard', new sfValidatorString(array('required' => true)));
        $this->getWidget('recordingStandard')->setLabel('<span class="required">*</span>Recording Standard:&nbsp;');
    }

}
