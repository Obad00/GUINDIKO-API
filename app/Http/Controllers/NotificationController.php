<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $mentor = Auth::user();
        $notifications = $mentor->notifications;

        return response()->json($notifications, 200);
    }
}
