<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;
use App\Models\Message;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // กำหนดภาษาเริ่มต้น
        $locale = session('locale', 'en');
        app()->setLocale($locale);

        // View Composer สำหรับ layouts.navigation
        View::composer('layouts.navigation', function ($view) {
            $userId = Auth::id();

            if ($userId) {
                // ดึงบทสนทนาที่ผู้ใช้ล็อกอินมีส่วนร่วม
                $conversations = Conversation::whereHas('users', function ($query) use ($userId) {
                    $query->where('users.id', $userId);
                })->with(['messages' => function ($query) {
                    $query->latest();
                }, 'users'])->get();

                // นับข้อความที่ยังไม่ได้อ่าน เฉพาะข้อความที่ส่งถึงผู้ใช้ที่ล็อกอิน
                $unreadMessages = Message::where('is_read', false)
                    ->where('user_id', '!=', $userId) // ข้อความที่ส่งถึงผู้ใช้
                    ->whereHas('conversation.users', function ($query) use ($userId) {
                        $query->where('users.id', $userId);
                    })->count();
            } else {
                $conversations = collect(); // ไม่มีบทสนทนา
                $unreadMessages = 0;
            }

            // ส่งตัวแปรไปยัง View
            $view->with(compact('conversations', 'unreadMessages'));
        });

    }
}
