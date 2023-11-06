<?php

namespace App\model;

use Ethereal\Model;

/**
 * @property integer $id ID
 * @property string $name NAME
 */
class Test extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'test';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

}