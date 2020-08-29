<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Author
 *
 * @property int    id
 * @property string name
 * @package App\Models
 */
class Author extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;
}
