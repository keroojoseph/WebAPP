<?php

namespace App\Models;

class EmployeesModel extends AbstractModel
{
    public $customer_id;
    public $name;
    public $email;
    public $address;
    public $phone;

    protected static $tableName = "customer";
    protected static $tableSchema = array (
        'name'      => self::DATA_TYPE_STR,
        'email'     => self::DATA_TYPE_STR,
        'address'   => self::DATA_TYPE_STR,
        'phone'     => self::DATA_TYPE_STR
    );
    protected static $primaryKey = 'customer_id';

//    public function __construct(public $name, public $email, public $address, public $phone) {
//    }

    public function __get($property) {
        return $this->$property;
    }

    public function setName($name) {
        $this->name = $name;
    }

}