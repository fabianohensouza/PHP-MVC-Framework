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
    abstract public function tableName(): string;

    abstract public function attributes(): array;

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
        $where = ['email' => 'teste'];
        $key = array_keys($where)[0];
        $value = array_values($where)[0];
        $statement = self::prepare("SELECT * FROM $tableName WHERE $key = :value");
        $statement->bindValue(":value", $value);

    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}