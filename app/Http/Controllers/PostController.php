<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * Показ списка постов
     */
    public function index()
    {
         // Получаем данные из базы с пагинацией
    $posts = Post::paginate(10);

    // Передаем данные в компонент через Inertia
    return Inertia::render('Posts/Index', [
        'posts' => $posts,
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * Отображение формы создания
     */
    public function create()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/');
            // abort(403);
            // или redirect() если хотите перенаправить
        }
        return Inertia::render('Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     * Сохранение нового поста
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string',
            'content' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Сообщение успешно создано!');
    }

    /**
     * Display the specified resource.
     * Показ конкретного поста
     */
    public function show(Post $post)
    {
        return Inertia::render('Posts/Show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * Отображение формы редактирования
     */
    public function edit(Post $post)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'У вас нет доступа к редактированию постов.');
        }
        return Inertia::render('Posts/Edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * Обновление поста
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string',
            'content' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Сообщение успешно обновлено!');
    }

    /**
     * Remove the specified resource from storage.
     * Удаление поста
     */
    public function destroy(Post $post)
    {
        $post->delete();

        // Получите актуальный список постов
        $posts = Post::all();

        // return Inertia::render('Posts/Index', [
        //     'posts' => Post::all(),
        //     'flash' => [
        //         'success' => 'Сообщение успешно удалено!',
        //     ],
        // ]);
        return redirect()->route('posts.index',['posts' => $posts,])->with('error', 'Сообщение успешно удалено!');
    }
}
