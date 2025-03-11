<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\PresentPostRequest;
use App\Settings\KehadiranSettings;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $kehadiran_settings = new KehadiranSettings;

        Inertia::share('present_settings', [
            'is_start_present' => $kehadiran_settings->isStartPresent(),
            'start_time' => $kehadiran_settings->start_time,
            'end_time' => $kehadiran_settings->end_time,
            'allow_late_check_in' => $kehadiran_settings->allow_late_check_in,
            'auto_absent_after' => $kehadiran_settings->auto_absent_after
        ]);

        return Inertia::render('dashboard');
    }

    public function present(PresentPostRequest $request) {}
}
