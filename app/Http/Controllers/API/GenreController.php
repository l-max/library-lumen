<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Get all genres
     *
     * @return array
     */
    public function index()
    {
        return ['data' => Genre::query()->get()];
    }

    /**
     * @param string $genreId
     *
     * @return array
     */
    public function show($genreId)
    {
        return ['data' => Genre::query()->findOrFail($genreId)];
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
                'name.required' => 'Название жанра обязательно для заполнения',
                'name.max'      => 'Название жанра не может превышать 255 символов',
            ]
        );

        $genre = new Genre();
        $genre->fill($request->all());
        $genre->saveOrFail();

        return ['data' => $genre];
    }

    /**
     * @param Request $request
     * @param string  $genreId
     *
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function update(Request $request, $genreId)
    {
        $this->validate($request,
            [
                'name' => 'required|max:512',
            ],
            [
                'name.required' => 'Название жанра обязательно для заполнения',
                'name.max'      => 'Название жанра не может превышать 255 символов',
            ]
        );

        $genre = Genre::query()->findOrFail($genreId);
        $genre->fill($request->all());
        $genre->saveOrFail();

        return ['data' => $genre];
    }
}
