<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;
use App\Actions\ImageKit\UploadPicture;
use App\Actions\ImageKit\DeletePicture;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, UploadPicture $uploadPicture)
    {
        if ($request->input('tags') === '') {
            $request->merge(['tags' => null]);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:60',
            'description' => 'nullable|string|max:160',
            'picture' => 'nullable|image',
            'type' => 'required',
            'creator_id' => 'required',
            'content' => 'required|string',
            'tags' => 'nullable|array',
        ]);

        if ($request->hasFile('picture')) {
            // Сохраняем файл и получаем путь к нему
            $pictureData = $uploadPicture->execute($request->file('picture'));

            if (!$pictureData) {
                return redirect()
                ->back()
                ->withInput()
                ->withErrors(['picture' => 'Не удалось создать статью. Ошибка загрузки изображения.']);
            }

            $pictureData = JSON_encode($pictureData, JSON_UNESCAPED_UNICODE);
            $validatedData['picture'] = $pictureData;
        }

        Post::create($validatedData);
        return Redirect::back()->with('success', 'Статья успешно создана.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, DeletePicture $deletePicture, UploadPicture $uploadPicture)
    {
        try {
            $post = Post::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return Redirect::back()
                ->withErrors(['general' => 'Статья, которую вы пытаетесь обновить, не найдена.']);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:60',
            'description' => 'nullable|string|max:160',
            'picture' => 'nullable|image', 
            'type' => 'required',
            'creator_id' => 'required',
            'content' => 'required|string',
            'tags' => 'nullable|array',
        ]);

        if ($request->hasFile('picture')) {
            if ($post->picture) {
                $oldPicture = json_decode($post->picture, true);
                $deletePictureResult = $deletePicture->execute($oldPicture['imagekit_id']);
                if (!$deletePictureResult) {
                    return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['picture' => 'Не удалось обновить статью. Ошибка удаления изображения.']);
                }
            }

            // Загружаем новый файл
            $pictureData = $uploadPicture->execute($request->file('picture'));

            if (!$pictureData) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['picture' => 'Не удалось обновить статью. Ошибка загрузки изображения.']);
            }

            // Добавляем путь к новой картинке в данные для обновления.
            $validatedData['picture'] = json_encode($pictureData, JSON_UNESCAPED_UNICODE);
        }

        // 4. Обновляем статью в базе данных.
        $post->update($validatedData);

        // 5. Возвращаем пользователя на предыдущую страницу с сообщением об успехе.
        return Redirect::back()->with('success', 'Статья успешно обновлена.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, DeletePicture $deletePicture)
    {
        if ($post->picture) {
            $oldPicture = json_decode($post->picture, true);
            $deletePictureResult = $deletePicture->execute($oldPicture['imagekit_id']);
            if (!$deletePictureResult) {
                return redirect()
                ->back()
                ->withInput()
                ->withErrors(['picture' => 'Не удалось удалить статью. Ошибка удаления изображения.']);
            }
        }

        $post->delete();

        return Redirect::back()->with('success', 'Пост успешно удален.');
    }
}
