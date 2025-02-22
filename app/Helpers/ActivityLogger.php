<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log($action, $description = null)
    {
        ActivityLog::create([
            'user' => Auth::check() ? Auth::user()->name : 'System',
            'action' => $action,
            'description' => $description,
        ]);
    }
}
