<?php

include 'DB.php';

class Auto extends DB{

    private $params = [];
    private $import_date;

    function __construct($params, $import_date)
    {
        $this->params = $params;
        $this->import_date = $import_date;
    }

    public function saveAuto()
    {
        $db = new DB();

        $db->save($this->params, $this->import_date);

        return true;
    }

    public function removeAuto()
    {
        $db = new DB();

        $db->removeOld($this->import_date);
    }

}