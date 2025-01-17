<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        // Валидация данных
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        // Логика сохранения данных
        // Например: сохранить в базу данных
        // Article::create($validated);

       // Возврат Inertia-ответа (если вы хотите обновить страницу)
       return back()->with('success', 'Данные успешно сохранены!');
    }
}
