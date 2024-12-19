<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;

class VisitController extends Controller
{
    public function store(Request $request)
    {
        // ตรวจสอบว่ามีการเข้าชมจาก IP เดิมในวันนี้หรือไม่
        $exists = Visit::where('ip_address', $request->ip())
            ->whereDate('visited_at', today())
            ->exists();

        if (!$exists) {
            Visit::create([
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'visited_at' => now(),
            ]);
        }

        return response()->json(['message' => 'Visit recorded successfully'], 200);
    }
}

