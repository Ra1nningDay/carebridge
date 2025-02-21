<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Appointment;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('layouts.navigation', function ($view) {
            $userId = Auth::id();

            if ($userId) {
                // ดึงบทสนทนาที่ผู้ใช้มีส่วนร่วม
                $conversations = Conversation::whereHas('users', function ($query) use ($userId) {
                    $query->where('users.id', $userId);
                })->with(['messages' => function ($query) {
                    $query->latest();
                }, 'users'])->get();

                // ดึงนัดหมายที่กำลังจะมาถึงและยืนยันแล้ว
                $upcomingAppointment = Appointment::where(function ($query) use ($userId) {
                    $query->where('elderly_id', $userId)
                          ->orWhere('caregiver_id', $userId)
                          ->orWhere('doctor_id', $userId);
                })
                ->where('status', 'confirmed')
                ->where('scheduled_at', '>=', now())
                ->orderBy('scheduled_at', 'asc')
                ->first();

                // นับข้อความที่ยังไม่ได้อ่าน
                $unreadMessages = Message::where('is_read', false)
                    ->where('user_id', '!=', $userId)
                    ->whereHas('conversation.users', function ($query) use ($userId) {
                        $query->where('users.id', $userId);
                    })->count();
            } else {
                $conversations = collect();
                $unreadMessages = 0;
                $upcomingAppointment = null;
            }

            // ส่งตัวแปรไปยัง View
            $view->with(compact('conversations', 'unreadMessages', 'upcomingAppointment'));
        });
    }
}
