<?php

/**
 * DigitalBetacamTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class DigitalBetacamTable extends FormatTypedVideoRecordingTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object DigitalBetacamTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('DigitalBetacam');
    }
}