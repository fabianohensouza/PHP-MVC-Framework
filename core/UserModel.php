<?php
/** User:  FHS Dev */

namespace app\core;

use app\core\db\DbModel;

/**
 * Class UserModel
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package NAMESPACE
 */
abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}