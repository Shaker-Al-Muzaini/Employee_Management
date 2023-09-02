<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminNotificationController extends Controller
{
    function index()
    {
        $admin = Admin::find(2);
        return response()->json([
            "notifications" => $admin->notifications
        ]);
    }

    function unread()
    {
        $admin = Admin::find(2);
        return response()->json([
            "notifications" => $admin->unreadNotifications
        ]);
    }

    function markReadAll()
    {
        $admin = Admin::find(2);
        foreach ($admin->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return response()->json([
            "message" => "success"
        ]);
    }

    function deleteAll()
    {
        $admin = Admin::find(2);
        $admin->notifications()->delete();
        return response()->json([
            "message" => "deleted"
        ]);
    }

    function delete($id)
    {
        DB::table('notifications')->where('id', $id)->delete();
        return response()->json([
            "message" => "deleted"
        ]);
    }
}
