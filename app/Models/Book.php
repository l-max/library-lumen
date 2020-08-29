<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * Class Book
 *
 * @property int                 id
 * @property string              name
 * @property string              description
 * @property string              genre_id
 * @property Carbon              created_at
 * @property Carbon              updated_at
 *
 * @property Collection|Author[] authors
 * @property Collection|Genre    genre
 * @package App\Models
 */
class Book extends Model
{
    protected $fillable = ['name', 'description', 'genre_id'];

    /**
     * Relation with Authors
     *
     * @return BelongsToMany
     */
    public function authors() : BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'book_authors');
    }

    /**
     * Relation with Genre
     *
     * @return BelongsTo
     */
    public function genre() : BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
}
