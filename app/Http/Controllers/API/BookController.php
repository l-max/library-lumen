<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /** @var BookRepository */
    protected $bookRepository;

    /** @var BookService */
    protected $bookService;

    /**
     * BookController constructor.
     *
     * @param BookRepository $bookRepository
     * @param BookService    $bookService
     */
    public function __construct(BookRepository $bookRepository, BookService $bookService)
    {
        $this->bookRepository = $bookRepository;
        $this->bookService    = $bookService;
    }

    /**
     * Get all books
     *
     * @return array
     */
    public function index()
    {
        return ['data' => $this->bookRepository->getAllBooks()];
    }

    /**
     * @param mixed $bookId
     *
     * @return array
     */
    public function show($bookId)
    {
        return ['data' => $this->bookRepository->getById($bookId)];
    }

    /**
     * @param Request $request
     *
     * @return array
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name'          => 'required|min:1|max:512',
                'description'   => 'max:1024',
                'genre_id'      => 'exists:App\Models\Genre,id',
                'authors_ids.*' => 'exists:App\Models\Author,id',
            ],
            [
                'name.required'        => 'Навание книги обязательно для заполнения',
                'name.max'             => 'Длина названия книги не должна превышать 512 символов',
                'name.min'             => 'Название книги не должно быть пустым',
                'description.max'      => 'Длина названия книги не должна превышать 1024 символов',
                'genre_id.exists'      => 'Выбран не существующий жанр',
                'authors_ids.*.exists' => 'Выбран не существующий автор',
            ]
        );

        return ['data' => $this->bookService->createBook($request->all())];
    }

    /**
     * @param Request $request
     * @param string  $bookId
     *
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function update(Request $request, $bookId)
    {
        $this->validate($request,
            [
                'name'          => 'min:1|max:512',
                'description'   => 'max:1024',
                'genre_id'      => 'exists:App\Models\Genre,id',
                'authors_ids.*' => 'exists:App\Models\Author,id',
            ],
            [
                'name.required'        => 'Навание книги обязательно для заполнения',
                'name.max'             => 'Длина названия книги не должна превышать 512 символов',
                'name.min'             => 'Название книги не должно быть пустым',
                'description.max'      => 'Длина названия книги не должна превышать 1024 символов',
                'genre_id.exists'      => 'Выбран не существующий жанр',
                'authors_ids.*.exists' => 'Выбран не существующий автор',
            ]
        );

        return [
            'data' => $this->bookService->updateBook((int)$bookId, $request->all()),
        ];
    }

    /**
     * Search books by genre name or author name
     *
     * @param Request $request
     *
     * @return array
     */
    public function searchBooks(Request $request)
    {
        $genreName  = $request->get('genre_name');
        $authorName = $request->get('author_name');

        return ['data' => $this->bookService->searchBooks($genreName, $authorName)];
    }
}
