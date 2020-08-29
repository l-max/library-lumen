<?php

namespace App\Repositories;

use App\Models\Book;

/**
 * Class BookRepository using for get books data from db
 *
 * @package App\Repositories
 */
class BookRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllBooks()
    {
        return Book::query()->get();
    }

    /**
     * @param int $bookId
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getById(int $bookId)
    {
        return Book::query()->findOrFail($bookId);
    }
}
