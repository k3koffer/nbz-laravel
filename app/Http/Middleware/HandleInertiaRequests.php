<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
            ],
            'meta' => [
                'title' => 'Не Бойся Знать - образовательная платформа',
                'description' => 'Поможем вашему ребенку найти призвание! Онлайн-курсы по профориентации и развитию soft-skills для детей и подростков. Интерактивные занятия и наставники, которые говорят на одном языке с учениками. Запишитесь на пробный урок!',
                'image' => 'new_logo_transparent.webp?updatedAt=1760216006474',
                'type' => 'website',
                'url' => $request->url(),
            ]
        ];
    }
}
