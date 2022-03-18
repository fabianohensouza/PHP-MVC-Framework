<?php
/** User:  FHS Dev */

namespace app\core;

use app\models\Model;

/**
 * Class DbModel
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\core
 */
abstract class DbModel extends Model
{
    abstract public static function tableName(): string;

    abstract public function attributes(): array;

    abstract public function primaryKey(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);

        $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") 
                                    VALUES(".implode(',', $params).")");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        return TRUE;

    }

    public static function find(array $where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $attributes = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $query = "SELECT * FROM $tableName WHERE " . $attributes;
        $statement = self::prepare($query);

        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        $statement->execute();
        return $statement->fetchObject(static::class);

    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}