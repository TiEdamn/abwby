<?php

class DB
{

    protected $driver = 'mysql';
    protected $host = 'localhost';
    protected $dbname = 'abwby';
    protected $user = 'root';
    protected $pass = 'root';
    protected $dbh;

    function __construct()
    {
        $this->dbh = new PDO("$this->driver:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
    }

    # Сохранение авто
    public function save($params, $import_date)
    {

        $values = (array) $params;
        $auto = [
            'url' => $values['url'],
            'date' => date('Y-m-d H:i:s', strtotime($values['date'])),
            'update_date' => date('Y-m-d H:i:s', strtotime($values['update-date'])),
            'country' => $values['country'],
            'mark' => $values['mark'],
            'model' => $values['model'],
            'year' => $values['year'],
            'seller_city' => $values['seller-city'],
            'seller_phone' => $values['seller-phone'],
            'price' => $values['price'],
            'currency_type' => $values['currency-type'],
            'displacement' => $values['displacement'],
            'run' => $values['run'],
            'run_metric' => $values['run-metric'],
            'state' => $values['state'],
            'color' => $values['color'],
            'body_type' => $values['body-type'],
            'engine_type' => $values['engine-type'],
            'gear_type' => $values['gear-type'],
            'transmission' => $values['transmission'],
            'horse_power' => $values['horse-power'],
            'additional_info' => $values['additional-info'],
            'import_date' => $import_date,
            'removed' => '0',
        ];

        try {

            $exist = $this->checkauto($auto['url']);

            if($exist)
            {
                $prepare = self::prepareUpdate($auto);
                $STH = $this->dbh->prepare("UPDATE autos SET ".$prepare['fields']." WHERE id = :id");
                $auto['id'] = $exist;
                $STH->execute($auto);

                $id = $exist;
            } else {
                # данные, которые мы вставляем
                $prepare = self::prepareValues($auto);
                $STH = $this->dbh->prepare("INSERT INTO autos (".$prepare['fields'].") values (".$prepare['values'].")");
                $STH->execute($auto);

                $id = $this->dbh->lastInsertId();
            }

            if($id) {
                # Сохраняем изображения
                if($params->image->count() > 0)
                {

                    # Удаляем старые изображения
                    $STH = $this->dbh->prepare("DELETE FROM galleries WHERE auto_id = :id");
                    $STH->execute(['id' => $id]);

                    # Сохраняем новые
                    for($i = 0; $i < $params->image->count(); $i++)
                    {
                        $query = [
                            'auto_id' => $id,
                            'image' => $params->image[$i]
                        ];

                        # данные, которые мы вставляем
                        $STH = $this->dbh->prepare("INSERT INTO galleries (`auto_id`,`image`) values (:auto_id, :image)");
                        $STH->execute($query);
                    }
                }

                # Удаляем старые хар-ки
                $STH = $this->dbh->prepare("DELETE FROM auto_equipment WHERE auto_id = :id");
                $STH->execute(['id' => $id]);

                # Сохраняем опции
                if($params->equipment->count() > 0)
                {
                    for($i = 0; $i < $params->equipment->count(); $i++)
                    {
                        $STH = $this->dbh->prepare("SELECT id FROM equipments WHERE name='".$params->equipment[$i]."' LIMIT 1");
                        $STH->execute();
                        $row = $STH->fetch();

                        if($row['id'] > 0)
                        {
                            $param_id = $row['id'];
                        } else {
                            $STH = $this->dbh->prepare("INSERT INTO equipments (`name`) values (:name)");
                            $STH->execute(['name' => $params->equipment[$i]]);

                            $param_id = $this->dbh->lastInsertId();
                        }

                        $query = [
                            'auto_id' => $id,
                            'equipment_id' => $param_id
                        ];

                        # данные, которые мы вставляем
                        $STH = $this->dbh->prepare("INSERT INTO auto_equipment (`auto_id`,`equipment_id`) values (:auto_id, :equipment_id)");
                        $STH->execute($query);
                    }
                }
            }
        }
        catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function removeOld($import_date)
    {
        $STH = $this->dbh->prepare("UPDATE autos SET removed = :removed WHERE import_date < :import_date");
        $STH->execute(['removed' => 1, 'import_date' => $import_date]);
        return true;
    }

    # Метод выборки всех значений для запроса
    static function prepareValues($value)
    {
        $keys = array_keys($value);

        return [
            'fields' => '`'.implode('`,`', $keys).'`',
            'values' => ':'.implode(',:', $keys),
        ];
    }
    # Метод выборки всех значений для update
    static function prepareUpdate($value, $id = null)
    {
        $keys = array_keys($value);
        $query = '';

        foreach($keys as $key)
        {
            $query .= $key.' = :'.$key.', ';
        }

        $query = substr($query,0,-2);

        return [
            'fields' => $query,
            'where' => 'WHERE id = :id',
        ];
    }

    public function checkauto($url)
    {
        $STH = $this->dbh->prepare("SELECT id FROM autos WHERE url='".$url."' LIMIT 1");
        $STH->execute();
        $row = $STH->fetch();

        if($row['id'] > 0)
        {
            return $row['id'];
        }

        return false;
    }

}