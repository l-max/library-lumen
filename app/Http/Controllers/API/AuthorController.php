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
     * @return array
     */
    public function index()
    {
        return ['data' => Author::query()->get()];
    }

    /**
     * @param $authorId
     *
     * @return array
     */
    public function show($authorId)
    {
        return ['data' => Author::query()->findOrFail($authorId)];
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
