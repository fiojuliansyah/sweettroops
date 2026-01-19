<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GatewayController extends Controller
{
    public function index(Request $request)
    {
        $token = env('FONNTE_TOKEN');
        $response = Http::withHeaders(['Authorization' => $token])->post('https://api.fonnte.com/qr', [
            'type' => 'qr',
        ]);

        $data = $response->json();
        $qr = $data['url'] ?? null;
        $message = $data['reason'] ?? 'Gagal memuat status';

        if ($request->ajax()) {
            return response()->json([
                'status' => $data['status'] ?? false,
                'qr' => $qr,
                'message' => $message
            ]);
        }

        return view('admin.gateway.whatsapp', compact('qr', 'message'));
    }
}