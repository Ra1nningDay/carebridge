<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caregiver;

class CaregiverController extends Controller
{
    public function welcome()
    {
        // Fetch posts
        $posts = Post::latest()->take(5)->get(); // Example to fetch latest 5 posts

        // Fetch caregivers
        $caregivers = Caregiver::with(['user', 'personalInfo'])->take(3)->get();

        // Pass both posts and caregivers to the view
        return view('welcome', compact('posts', 'caregivers'));
    }

    public function index (Request $request)
    {
        $search = $request->input('search');
        $caregivers = Caregiver::when($search, function ($query, $search) {
            $query->where('specialization', 'like', "%$search%")
                ->orWhere('user_id', 'like', "%$search%");
        })->paginate(10);

        return view('dashboard.caregiver-management', compact('caregivers'));
    }

    // public function showDashboardCaregiverManagement()
    // {
    //     $caregivers = Caregiver::paginate(10); // Fetch caregivers with pagination
    //     return view('dashboard.caregiver-management', compact('caregivers'));
    // }



    public function edit()
    {
        $caregiver = Caregiver::where('user_id', auth()->id())->firstOrFail();
        return view('caregiver.edit', compact('caregiver'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'specialization' => 'required|string|max:255',
            'experience_years' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $caregiver = Caregiver::where('user_id', auth()->id())->firstOrFail();

        $caregiver->update([
            'specialization' => $request->specialization,
            'experience_years' => $request->experience_years,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('caregiver.edit')->with('success', 'Profile updated successfully!');
    }

    public function findNearby(Request $request)
    {
        $latitude = $request->query('latitude');
        $longitude = $request->query('longitude');
        $radius = 100; // Distance in km

        // Query caregivers within the radius
        $caregivers = Caregiver::selectRaw("*,
                    ( 6371 * acos( cos( radians(?) ) *
                    cos( radians( latitude ) )
                    * cos( radians( longitude ) - radians(?)
                    ) + sin( radians(?) ) *
                    sin( radians( latitude ) ) )
                    ) AS distance", [$latitude, $longitude, $latitude])
                    ->having("distance", "<", $radius)
                    ->orderBy("distance", 'asc')
                    ->get();

        return view('caregiver.nearby', compact('caregivers', 'latitude', 'longitude'));
    }




    public function showProfile($id)
    {
        // โหลดข้อมูล Caregiver พร้อมกับ User, PersonalInfo และ Posts
        $caregiver = Caregiver::with(['user.personalInfo', 'user.posts'])->findOrFail($id);

        // ตรวจสอบว่ากำลังดูโปรไฟล์ของตัวเองหรือไม่
        $isOwnProfile = auth()->check() && auth()->id() == $caregiver->user->id;

        return view('profile.index', [
            'caregiver' => $caregiver,
            'user' => $caregiver->user,
            'personalInfo' => $caregiver->user->personalInfo,
            'posts' => $caregiver->user->posts->sortByDesc('created_at'), // เรียงโพสต์จากล่าสุด
            'isOwnProfile' => $isOwnProfile,
        ]);
    }


    public function showFindCaregiver()
    {
        // ดึงข้อมูลเฉพาะ Caregiver ที่มีสถานะ Approved
        $caregivers = Caregiver::where('status', 'Approved')->get();

        // ส่งข้อมูลไปยัง view
        return view('caregiver.find_caregiver', compact('caregivers'));
    }


    public function showApplicationForm()
    {
        $userId = auth()->user()->id;
        
        $existingApplication = Caregiver::where('user_id', $userId)->first();
        
        if ($existingApplication) {
            if ($existingApplication->application_step == 2) {
                return redirect()->route('caregiver.awaitReview');
            } elseif ($existingApplication->application_step >= 3) {
                return redirect()->route('caregiver.confirmStatus');
            }
        }

        $currentStep = 1;
        return view('caregiver.register.register', compact('currentStep'));
    }

    public function submitApplication(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'specialization' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'experience_years' => 'required|integer',
        ]);

        $existingApplication = Caregiver::where('user_id', $request->user_id)
            ->whereIn('status', ['Pending', 'Under Review'])
            ->first();

        if ($existingApplication) {
            return redirect()->route('caregiver.awaitReview')
                ->with('message', 'Your application is already under review or pending approval.');
        }

        $caregiver = Caregiver::create([
            'user_id' => $request->user_id,
            'specialization' => $request->specialization,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'experience_years' => $request->experience_years,
            'status' => 'Pending',
            'application_step' => 2,
        ]);

        $caregiver->applicationSteps()->create([
            'step_number' => 2,
            'status' => 'Submitted',
            'completed_at' => now(),
        ]);

        return redirect()->route('caregiver.awaitReview')
            ->with('message', 'Your application has been submitted and is pending review.');
    }

    public function awaitReview()
    {
        $caregiver = Caregiver::where('user_id', auth()->id())->first();

        if ($caregiver && $caregiver->application_step == 2) {
            return view('caregiver.register.await_review');
        }

        return redirect()->route('caregiver.register');
    }

    public function confirmStatus()
    {
        $caregiver = Caregiver::where('user_id', auth()->id())->first();

        if ($caregiver->application_step < 3) {
            return redirect()->route('caregiver.awaitReview');
        }

        return view('caregiver.register.confirm_status')->with('status', $caregiver->status);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        $caregiver = Caregiver::findOrFail($id);
        $caregiver->status = $request->status;

        if ($request->status === 'Approved' || $request->status === 'Rejected') {
            $caregiver->update(['application_step' => 4]);
        }

        $caregiver->save();

        $step_number = $caregiver->applicationSteps()->count() + 1;
        $caregiver->applicationSteps()->create([
            'step_number' => $step_number,
            'status' => $request->status,
            'completed_at' => now(),
        ]);

        return redirect()->route('dashboard.caregiver-management')->with('status', 'Caregiver status updated successfully!');
    }
}
