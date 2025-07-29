<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GetNotificationController extends Controller
{
    public function GetNotification(Request $request)
    {
        $user = $request->user();
        $notifications = $user->notifications;
        return view('notifications.index', compact('notifications'));
    }
    public function MarkAsRead(Request $request)
    {
        $user = $request->user();
        $user->notifications()->update(['read_at' => now()]);
        return response()->json(['success' => true]);
    }
    public function GetUnreadCount(Request $request)
    {
        $user = $request->user();
        $unreadCount = $user->notifications()->where('read_at', null)->count();
        return response()->json(['count' => $unreadCount]);
    }
    public function GetUnreadNotifications(Request $request)
    {
        $user = $request->user();
        $unreadNotifications = $user->notifications()->where('read_at', null)->get();
        return response()->json(['unread_notifications' => $unreadNotifications]);
    }
}
