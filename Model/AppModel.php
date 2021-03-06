<?php
App::uses('Model', 'Model');

/**
 * AppModel
 *
 * PHP version 5
 *
 * @package    Model
 * @author     Vitor Pacheco <vitor.pacheco@ifbaiano.edu.br>
 */
class AppModel extends Model {

    public function getLastQuery() {
        $dbo = $this->getDatasource();
        return $dbo->getLog();
    }
}