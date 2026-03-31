<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * GET /api/notifications
     * User melihat semua notifikasinya.
     */
    public function index(Request $request)
    {
        $notifications = Notification::where('user_id', $request->user()->id)
            ->with('report')
            ->latest()
            ->get();

        return response()->json([
            'message'       => 'Daftar notifikasi',
            'notifications' => $notifications,
        ]);
    }

    /**
     * PUT /api/notifications/{id}/read
     * User menandai notifikasi sebagai sudah dibaca.
     */
    public function markAsRead(Request $request, $id)
    {
        $notification = Notification::where('user_id', $request->user()->id)
            ->findOrFail($id);

        $notification->update([
            'is_read' => true,
        ]);

        return response()->json([
            'message'      => 'Notifikasi ditandai sudah dibaca',
            'notification' => $notification,
        ]);
    }
}
