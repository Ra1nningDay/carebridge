<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect;

class ZoomController extends Controller
{
    // ฟังก์ชันนี้เริ่มกระบวนการ OAuth
    public function authorize()
    {
        $zoomClientId = env('ZOOM_CLIENT_ID');
        $zoomRedirectUri = env('ZOOM_REDIRECT_URI');
        
        // สร้าง URL ไปที่ Zoom OAuth Authorization
        $authUrl = "https://zoom.us/oauth/authorize?response_type=code&client_id={$zoomClientId}&redirect_uri={$zoomRedirectUri}";

        // เปลี่ยนทางไปยังหน้า Zoom เพื่อขออนุญาต
        return Redirect::to($authUrl);
    }

    // ฟังก์ชันนี้รับ callback จาก Zoom หลังจากอนุญาตแล้ว
    public function callback(Request $request)
    {
        $code = $request->query('code');
        if (!$code) {
            return back()->with('error', 'เกิดข้อผิดพลาดในการเชื่อมต่อกับ Zoom');
        }

        // ส่งข้อมูลเพื่อขอรับ access token
        $client = new Client();
        $response = $client->post('https://zoom.us/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => env('ZOOM_REDIRECT_URI'),
            ],
            'auth' => [env('ZOOM_CLIENT_ID'), env('ZOOM_CLIENT_SECRET')],
        ]);

        // รับ access token จาก response
        $body = json_decode($response->getBody());
        session(['zoom_access_token' => $body->access_token]);

        return redirect()->route('appointments.index')->with('success', 'เชื่อมต่อ Zoom สำเร็จ');
    }
    
    public function createMeetingAndSaveLink($appointmentId)
    {
        $zoomAccessToken = session('zoom_access_token');
        
        // สร้างห้องประชุมด้วย Zoom API
        $client = new Client();
        $response = $client->post('https://api.zoom.us/v2/users/me/meetings', [
            'headers' => [
                'Authorization' => "Bearer {$zoomAccessToken}",
            ],
            'json' => [
                'topic' => 'Meeting for Elderly Care',
                'type' => 2, // Scheduled meeting
                'start_time' => '2025-01-10T10:00:00Z', // Set the time accordingly
                'duration' => 30,
                'timezone' => 'Asia/Bangkok',
                'settings' => [
                    'host_video' => true,
                    'participant_video' => true,
                    'waiting_room' => true,
                ],
            ],
        ]);

        $meeting = json_decode($response->getBody());

        // บันทึกลิงก์ Zoom ที่สร้างขึ้นในฐานข้อมูล
        $appointment = Appointment::find($appointmentId);
        $appointment->zoom_link = $meeting->join_url;
        $appointment->save();

        return redirect()->route('appointments.show', $appointmentId);
    }

}
