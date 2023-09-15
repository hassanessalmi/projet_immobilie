<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    

    public function markAsRead($notificationId)
{
    $user = Auth::user();
    $notification = $user->notifications->where('id', $notificationId)->first();

    if ($notification) {
        $notification->markAsRead();
        return response()->json(['message' => 'Notification marked as read.']);
    } else {
        return response()->json(['error' => 'Notification not found.'], 404);
    }
}
}
