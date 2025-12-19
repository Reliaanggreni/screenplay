<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\RunningText;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeScreenController extends Controller
{
    public function index()
    {
        $media = Media::where('aktif', true)
            ->orderBy('urutan')
            ->get();

        $runningTexts = RunningText::where('aktif', true)->get();

        return view('homescreen', compact('media', 'runningTexts'));
    }
}
