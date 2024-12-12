<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $data = ActivityLog::with(['user', 'user.peran'])->whereDate('created_at', Carbon::now())->latest()->get();
        return view('pages.log_aktivitas', [
            'data' => $data
        ]);
    }
}
