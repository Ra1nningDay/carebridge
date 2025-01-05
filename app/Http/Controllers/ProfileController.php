<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\UserPersonalInfo;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
   public function index(Request $request): View
{
    // ดึงข้อมูลผู้ใช้งานปัจจุบัน
    $user = $request->user();

    // ตรวจสอบว่าเป็นผู้ดูแลหรือไม่
    if ($user->roles->contains('name', 'caregiver')) {
        // กรณีเป็นผู้ดูแล ดึงข้อมูลของผู้สูงอายุที่ดูแล
        $elderly = $user->elderly()->with(['personalInfo', 'physicalInfo', 'healthChecks'])->get();

        // จัดข้อมูล physicalInfo สำหรับผู้สูงอายุที่ดูแล
        $measurements = $elderly->map(function ($patient) {
            return $patient->physicalInfo->map(function ($info) use ($patient) {
                return [
                    'date' => $info->created_at->toDateString(),
                    'height' => $info->height,
                    'weight' => $info->weight,
                    'patient_name' => $patient->name, // ชื่อของผู้สูงอายุ
                ];
            });
        })->flatten(1); // รวมข้อมูลใน array เดียว
    } else {
        // กรณีเป็นผู้สูงอายุ ดึงข้อมูลของตัวเอง
        $elderly = collect([$user]);
        $measurements = $user->physicalInfo->map(function ($info) {
            return [
                'date' => $info->created_at->toDateString(),
                'height' => $info->height,
                'weight' => $info->weight,
            ];
        });
    }

    return view('profile.index', [
        'user' => $user, // ข้อมูลผู้ใช้งานปัจจุบัน
        'personalInfo' => $user->personalInfo, // ข้อมูลส่วนตัว
        'elderly' => $elderly, // รายชื่อผู้สูงอายุที่เกี่ยวข้อง (กรณีเป็น caregiver)
        'caregiver' => $user->caregiver, // ผู้ดูแล (กรณีผู้สูงอายุล็อกอิน)
        'physicalInfo' => $measurements, // ข้อมูลสำหรับกราฟ
    ]);
}


    public function edit(Request $request): View
    {
        $user = $request->user();
        $personalInfo = $user->personalInfo; // ดึงข้อมูลส่วนตัวเพิ่มเติม

        return view('profile.edit', [
            'user' => $user,
            'personalInfo' => $personalInfo,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        // Validate Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow only images
        ]);

        // Handle Avatar Upload
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/avatars'), $filename);

            // Delete old avatar if exists
            if ($user->avatar && file_exists(public_path('uploads/avatars/' . $user->avatar))) {
                unlink(public_path('uploads/avatars/' . $user->avatar));
            }

            $user->avatar = $filename;
        }

        // Update Name and Email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        return redirect()->back()->with('status', 'profile-updated');
    }


    /**
     * Update the user's additional personal information.
     */
    public function updatePersonalInfo(Request $request): RedirectResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
            'medications' => 'nullable|string',
            'care_type' => 'nullable|string|max:50',
            'preferred_time' => 'nullable|string|max:50',
        ]);

        $personalInfo = $user->personalInfo ?: new UserPersonalInfo(['user_id' => $user->id]);
        $personalInfo->fill($data);
        $personalInfo->save();

        return Redirect::route('profile.edit')->with('status', 'personal-info-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
