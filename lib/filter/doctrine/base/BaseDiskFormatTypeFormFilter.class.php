<?php

/**
 * DiskFormatType filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDiskFormatTypeFormFilter extends FormatTypeFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('disk_format_type_filters[%s]');
  }

  public function getModelName()
  {
    return 'DiskFormatType';
  }
}
