<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaDisplayController extends Controller
{
    // halaman admin khusus pilih homescreen
    public function index()
    {
        $media = Media::orderBy('aktif', 'desc')
            ->orderBy('urutan')
            ->paginate(10);

        return view('pages.mediaDisplay', compact('media'));
    }

    // toggle tampil / tidak
    public function toggle(Request $request)
    {
        $media = Media::findOrFail($request->id);
        $media->aktif = $request->aktif;
        $media->save();

        return response()->json(['success' => true]);
    }

    // update urutan slideshow
    public function updateUrutan(Request $request)
    {
        $media = Media::findOrFail($request->id);
        $media->urutan = $request->urutan;
        $media->save();

        return response()->json(['success' => true]);
    }

    public function updateDurasi(Request $request)
    {
        $media = Media::findOrFail($request->id);
        $media->durasi = $request->durasi;
        $media->save();

        return response()->json(['success' => true]);
    }
}
