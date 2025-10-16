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
        $sharedMeta = Inertia::getShared('meta') ?? [];
        $educators = Educator::all();

        return Inertia::render('Index', [
            'educators' => $educators,
            // 'courses' => $courses,
            // 'reviews' => $reviews,
            'meta' => array_merge($sharedMeta, [
                'title' => 'Главная',
                'description' => 'Поможем вашему ребенку найти призвание! Онлайн-курсы по профориентации и развитию soft-skills для детей и подростков. Интерактивные занятия и наставники, которые говорят на одном языке с учениками. Запишитесь на пробный урок!',
            ]),
        ]);
    }

        public function about()
    {
        $sharedMeta = Inertia::getShared('meta') ?? [];
        $educators = Educator::all();

        return Inertia::render('About', [
            'educators' => $educators,
            'meta' => array_merge($sharedMeta, [
                'title' => 'О нас',
                'description' => 'Узнайте о миссии проекта "Не Бойся Знать". Мы создаем образовательную среду без стресса и зубрежки, помогая детям раскрыть таланты и сделать осознанный выбор профессии. Знакомьтесь с нашей командой!',
            ]),
        ]);
    }

        public function reviews()
    {
        $sharedMeta = Inertia::getShared('meta') ?? [];
        $reviews = Review::all();
        // тут при загрузке курсов юзера сделать фильтрацию на те, у которых нет отзыва

        return Inertia::render('Reviews', [
            'reviews' => $reviews,
            'show_header' => false,
            'accept_reviews' => config('app.accept_reviews'),
            'meta' => array_merge($sharedMeta, [
                'title' => 'Отзывы',
                'description' => '"Сын наконец-то понял, кем хочет стать!" - читайте этот и другие отзывы о наших развивающих курсах. Мнения родителей и детей, которые уже выбрали нас и довольны результатом.',
            ]),
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
            // 'user_id' => $request->user()->id
        ]);

        // сделать проверку на наличие уже отзыва у юзера на этот курс
        // курс надо в таблицу добавить, там его нет

        return redirect()->back()->with('success', 'Спасибо за ваш отзыв!');
    }

        public function policy()
    {
        $sharedMeta = Inertia::getShared('meta') ?? [];
        return Inertia::render('Policy', [
            'meta' => array_merge($sharedMeta, [
                'title' => 'Политика',
                'description' => 'Официальная политика конфиденциальности сайта НеБойсяЗнать. Мы подробно разъясняем, как собираем, храним и обрабатываем персональные данные наших пользователей. Ваша безопасность — наш приоритет.',
            ]),
        ]);
    }
    //
}
