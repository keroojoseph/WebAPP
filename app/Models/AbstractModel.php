<?php

namespace App\Models;

use \App\Libs\Database\DatabaseHandler;
use \App\Libs\Database\PDODatabaseHandler;
class AbstractModel
{
    const DATA_TYPE_STR = \PDO::PARAM_STR;
    const DATA_TYPE_INT = \PDO::PARAM_INT;
    const DATA_TYPE_DECIMAL = 4;
    const DATA_TYPE_BOOL = \PDO::PARAM_BOOL;


    public static function viewTableSchema()
    {
        return static:: $tableSchema;
    }

    private static function buildNameParametersSQL()
    {
        $params = '';
        foreach (static::$tableSchema as $column => $type) {
            $params .= $column . ' = ' . ':' . $column . ", ";
        }
        $params = trim($params, ', ');
        return $params;
    }

    private function create()
    {
        $sql = 'INSERT INTO ' . static::$tableName . ' SET ' . $this->buildNameParametersSQL();
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $this->prepareValues($stmt);
        if($stmt->execute()) {
            $this->{static::$primaryKey} = DatabaseHandler::factory()->lastInsertId();
            return true;
        }
        return false;
    }

    private function prepareValues(\PDOStatement &$stmt)
    {
        foreach (static::$tableSchema as $column => $type) {
            $value = $this->__get($column);

            if ($type == self::DATA_TYPE_DECIMAL) {
                $sanitizeValue = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $stmt->bindValue(':' . $column, $sanitizeValue);
            } else {
                $stmt->bindValue(':' . $column, $value, $type);
            }
        }
    }

    private function update()
    {
        $sql = 'UPDATE ' . static::$tableName . ' SET ' . $this->buildNameParametersSQL() . ' WHERE ' . static::$primaryKey . ' = :primaryKey';
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $stmt->bindValue(':primaryKey', $this->{static::$primaryKey});
        $this->prepareValues($stmt);
        return $stmt->execute();

    }

    public function delete()
    {
        $sql = 'DELETE FROM ' . static::$tableName . '  WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey};
        $stmt = DatabaseHandler::factory()->prepare($sql);
        return $stmt->execute();
    }

    public static function getAll()
    {
        $sql = 'SELECT * FROM ' . static::$tableName;
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $stmt->execute();
        if(method_exists(get_called_class(), '__construct')) {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        } else {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        }
        if ((is_array($results) && !empty($results))) {
            return new \ArrayIterator($results);
        };
        return false;
    }

    public static function getByPK($pk)
    {
        $sql = 'SELECT * FROM ' . static::$tableName . '  WHERE ' . static::$primaryKey . ' = "' . $pk . '"';
        $stmt = DatabaseHandler::factory()->prepare($sql);
        if ($stmt->execute() === true) {
            if(method_exists(get_called_class(), '__construct')) {
                $obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
            } else {
                $obj = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
            }
            return !empty($obj) ? array_shift($obj) : false;
        }
        return false;
    }

    public function save()
    {
        return $this->{static::$primaryKey} === null ? $this->create() : $this->update();
    }

    public static function get($sql, $option = array())
    {
        global $connection;
        $stmt = $connection->prepare($sql);

        if (!empty($option)) {
            foreach ($option as $column => $type) {
                if ($type[0] === 4) {
                    $sanitizeValue = filter_var($type[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $stmt->bindValue(':' . $column, $sanitizeValue);
                } else {
                    $stmt->bindValue(':' . $column, $type[1], $type[0]);
                }
            }
        }

        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        return (is_array($result) && !empty($result)) ? $result : false;
    }

    public static function getOne($sql, $options = array())
    {
        $result = static::get($sql, $options);
        return $result === false ? false : $result->current();
    }

    public static function getModelTableName()
    {
        return static::$tableName;
    }

    public static function getBy($columns, $options = array())
    {
        $whereClauseColumns = array_keys($columns);
        $whereClauseValues = array_values($columns);
        $whereClause = [];
        for ( $i = 0, $ii = count($whereClauseColumns); $i < $ii; $i++ ) {
            $whereClause[] = $whereClauseColumns[$i] . ' = "' . $whereClauseValues[$i] . '"';
        }
        $whereClause = implode(' AND ', $whereClause);
        $sql = 'SELECT * FROM ' . static::$tableName . '  WHERE ' . $whereClause;
        return static::get($sql, $options);
    }

}