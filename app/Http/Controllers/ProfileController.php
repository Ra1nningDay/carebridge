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
    public function index(Request $request):view 
    {
        $user = $request->user();
        $personalInfo = $user->personalInfo; // ดึงข้อมูลส่วนตัวเพิ่มเติม
        $posts = $user->posts()->latest()->get();
        return view('profile.index',[
            'user' => $user,
            'personalInfo' => $personalInfo,
            'posts' => $posts,
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
