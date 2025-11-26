<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_name',
        'user_role', 
        'action',
        'description',
        'ip_address'
    ];

    public static function log($action, $description)
    {
        self::create([
            'user_name' => session('user_name', 'System'),
            'user_role' => session('user_role', 'system'),
            'action' => $action,
            'description' => $description,
            'ip_address' => request()->ip()
        ]);
    }
}