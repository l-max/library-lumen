<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Support\Facades\DB;

/**
 * Class BookService
 *
 * @package App\Services
 */
class BookService
{
    /**
     * Create new book
     *
     * @param array $data
     *
     * @return Book
     * @throws \Throwable
     */
    public function createBook(array $data)
    {
        DB::transaction(function () use ($data, &$book) {
            $book = new Book();
            $book->fill($data);
            $book->saveOrFail();

            if (isset($data['authors_ids'])) {
                $authorsIds = $data['authors_ids'];
                $book->authors()->sync($authorsIds);
            }
            $book->authors;
        });

        return $book;
    }

    /**
     * Update concrete book
     *
     * @param int   $bookId
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     */
    public function updateBook(int $bookId, array $data)
    {
        /** @var Book $book */
        $book = Book::query()->findOrFail($bookId);

        DB::transaction(function () use ($data, &$book) {
            $book->fill($data);
            $book->save();

            if (isset($data['authors_ids'])) {
                $authorsIds = $data['authors_ids'];
                $book->authors()->sync($authorsIds);
            }
            // load relations
            $book->authors;
        });

        return $book;
    }

    /**
     * Search books by genre_name and author_name
     *
     *
     * @param string|null $genreName
     * @param string|null $authorName
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function searchBooks(?string $genreName, ?string $authorName)
    {
        $query = Book::query()->with('authors')->select([
            'books.*',
            'g.name as genre_name',
        ]);

        if ($genreName) {
            $query->where('g.name', 'like', '%' . $genreName . '%');
        }

        if ($authorName) {
            $query->where('a.name', 'like', '%' . $authorName . '%');
        }

        $query->join('genres as g', 'g.id', '=', 'books.genre_id')
              ->join('book_authors as ba', 'ba.book_id', '=', 'books.id')
              ->leftJoin('authors as a', 'a.id', '=', 'ba.author_id');

        return $query->distinct()->get();
    }
}
