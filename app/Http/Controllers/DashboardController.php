<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Agenda;
use App\Models\RunningText;

class DashboardController extends Controller
{
    public function index()
    {
        // Media
        $mediaCount = Media::count();
        $mediaActiveCount = Media::where('aktif', 1)->count();

        // Running Text
        $runningTextCount = RunningText::count();
        $runningTextActiveCount = RunningText::where('aktif', 1)->count();

        // Agenda
        $agendaCount = Agenda::count();

        // Agenda terbaru
        $today = now()->format('Y-m-d');

        $activeAgenda = Agenda::where('tgl_selesai', '>=', $today)
            ->orderBy('tgl_mulai', 'asc')
            ->limit(5)
            ->get();

        return view('pages.dashboard', compact(
            'mediaCount',
            'mediaActiveCount',
            'runningTextCount',
            'runningTextActiveCount',
            'agendaCount',
            'activeAgenda'
        ));
    }
}
