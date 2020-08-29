<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Genre
 *
 * @property int    id
 * @property string name
 * @package App\Models
 */
class Genre extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;
}
