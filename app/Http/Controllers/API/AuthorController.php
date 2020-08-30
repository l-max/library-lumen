<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Get all authors
     *
     * @App\Http\Routes\Route(
     *   method = {"GET"},
     *   uri = "/author",
     *   action = "AuthorController@index",
     * )
     *
     * @return array
     */
    public function index()
    {
        return ['data' => Author::query()->get()];
    }

    /**
     *
     * @App\Http\Routes\Route(
     *   method = {"GET"},
     *   uri = "/author/{authorId:[0-9]+}",
     *   action = "AuthorController@show",
     * )
     *
     * @param $authorId
     *
     * @return array
     */
    public function show($authorId)
    {
        return ['data' => Author::query()->findOrFail($authorId)];
    }

    /**
     *
     * @App\Http\Routes\Route(
     *   method = {"POST"},
     *   uri = "/author",
     *   action = "AuthorController@store",
     * )
     *
     * @param Request $request
     *
     * @return array
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|max:255',
            ],
            [
                'name.required' => 'Имя автора обязательно для заполнения',
                'name.max'      => 'Имя автора не может превышать 255 символов',
            ]
        );

        $author = new Author();
        $author->fill($request->all());
        $author->saveOrFail();

        return ['data' => $author];
    }

    /**
     *
     * @App\Http\Routes\Route(
     *   method = {"PATCH"},
     *   uri = "/author/{authorId:[0-9]+}",
     *   action = "AuthorController@update",
     * )
     *
     * @param Request $request
     * @param string  $authorId
     *
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function update(Request $request, $authorId)
    {
        $this->validate($request,
            [
                'name' => 'required|max:512',
            ],
            [
                'name.required' => 'Имя автора обязательно для заполнения',
                'name.max'      => 'Имя автора не может превышать 255 символов',
            ]
        );

        $author = Author::query()->findOrFail($authorId);
        $author->fill($request->all());
        $author->saveOrFail();

        return ['data' => $author];
    }
}
