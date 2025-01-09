<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Appointment; // เพิ่มบรรทัดนี้
use Illuminate\Support\Facades\Redirect;

class ZoomController extends Controller
{
    // ฟังก์ชันนี้เริ่มกระบวนการ OAuth
    public function authorize()
    {
        $zoomClientId = env('ZOOM_CLIENT_ID');
        $zoomRedirectUri = env('ZOOM_REDIRECT_URI'); // ตรวจสอบว่ามีค่านี้หรือไม่

        $authUrl = "https://zoom.us/oauth/authorize?response_type=code&client_id={$zoomClientId}&redirect_uri={$zoomRedirectUri}";

        return redirect($authUrl);
    }

    // ฟังก์ชันนี้รับ callback จาก Zoom หลังจากอนุญาตแล้ว
    public function callback(Request $request)
    {
        $code = $request->query('code');
        if (!$code) {
            return back()->with('error', 'เกิดข้อผิดพลาดในการเชื่อมต่อกับ Zoom');
        }

        try {
            $client = new Client();
            $response = $client->post('https://zoom.us/oauth/token', [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'code' => $code,
                    'redirect_uri' => env('ZOOM_REDIRECT_URI'),
                ],
                'auth' => [env('ZOOM_CLIENT_ID'), env('ZOOM_CLIENT_SECRET')],
            ]);

            $body = json_decode($response->getBody(), true);

            // บันทึก Access Token และ Refresh Token
            session([
                'zoom_access_token' => $body['access_token'],
                'zoom_refresh_token' => $body['refresh_token'],
                'zoom_token_expires_at' => now()->addSeconds($body['expires_in']),
            ]);

            return redirect()->route('appointments.index')->with('success', 'เชื่อมต่อ Zoom สำเร็จ');
        } catch (\Exception $e) {
            return back()->with('error', 'ไม่สามารถเชื่อมต่อกับ Zoom ได้: ' . $e->getMessage());
        }
    }

    
    public function createMeetingAndSaveLink($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $zoomAccessToken = session('zoom_access_token'); // หรือดึงจากฐานข้อมูล

        if (!$zoomAccessToken) {
            return redirect()->route('zoom.authorize')->with('error', 'กรุณาเชื่อมต่อกับ Zoom ก่อน');
        }

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://api.zoom.us/v2/users/me/meetings', [
                'headers' => [
                    'Authorization' => "Bearer {$zoomAccessToken}",
                ],
                'json' => [
                    'topic' => "Meeting with {$appointment->elderly->name}",
                    'type' => 2, // Scheduled meeting
                    'start_time' => $appointment->scheduled_at->toIso8601String(),
                    'duration' => 30,
                    'timezone' => 'Asia/Bangkok',
                    'settings' => [
                        'host_video' => true,
                        'participant_video' => true,
                    ],
                ],
            ]);

            $meeting = json_decode($response->getBody(), true);

            // บันทึกลิงก์ Zoom ในฐานข้อมูล
            $appointment->update([
                'zoom_link' => $meeting['join_url'],
            ]);

            return redirect()->route('appointments.show', $appointmentId)->with('success', 'ห้องประชุม Zoom ถูกสร้างสำเร็จ');
        } catch (\Exception $e) {
            return back()->with('error', 'เกิดข้อผิดพลาดในการสร้างห้องประชุม Zoom: ' . $e->getMessage());
        }
    }


    public function refreshAccessToken()
    {
        $refreshToken = session('zoom_refresh_token');

        try {
            $client = new Client();
            $response = $client->post('https://zoom.us/oauth/token', [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refreshToken,
                ],
                'auth' => [env('ZOOM_CLIENT_ID'), env('ZOOM_CLIENT_SECRET')],
            ]);

            $body = json_decode($response->getBody(), true);

            session([
                'zoom_access_token' => $body['access_token'],
                'zoom_refresh_token' => $body['refresh_token'],
                'zoom_token_expires_at' => now()->addSeconds($body['expires_in']),
            ]);

            return $body['access_token'];
        } catch (\Exception $e) {
            throw new \Exception('ไม่สามารถต่ออายุ Access Token ได้: ' . $e->getMessage());
        }
    }



}
