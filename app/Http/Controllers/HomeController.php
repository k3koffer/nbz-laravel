<?php

namespace App\Http\Controllers;

use App\Models\Educator;
use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
        public function index()
    {
        
        // 2. Получаем данные о преподавателях
        $educators = Educator::all();

        // Тут ты можешь получить и другие данные
        // $courses = Course::latest()->take(6)->get();
        // $reviews = Review::where('is_featured', true)->get();

        // 3. Рендерим компонент главной страницы ('Index')
        // и передаем все необходимые данные в пропсы
        return Inertia::render('Index', [
            'educators' => $educators,
            // 'courses' => $courses,
            // 'reviews' => $reviews,
        ]);
    }

        public function about()
    {
        $educators = Educator::all();

        return Inertia::render('About', [
            'educators' => $educators,
        ]);
    }

        public function reviews()
    {
        $reviews = Review::all();
        // тут при загрузке курсов юзера сделать фильтрацию на те, у которых нет отзыва

        return Inertia::render('Reviews', [
            'reviews' => $reviews,
            'show_header' => false
        ]);
    }

        public function storeReview(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'course' => 'string|max:255'
        ]);

        $reviews = Review::create([
            'comment' => $validated['comment'],
            'rating' => $validated['rating'],
            'course' => $validated['course'],
            'user_id' => $request->user()->id
        ]);

        // сделать проверку на наличие уже отзыва у юзера на этот курс
        // курс надо в таблицу добавить, там его нет

        return redirect()->back()->with('success', 'Спасибо за ваш отзыв!');
    }

        public function policy()
    {
        return Inertia::render('Policy');
    }
    //
}
