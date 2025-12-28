<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = Media::orderBy('aktif', 'desc')
            ->orderBy('updated_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.media.index', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipeOptions = [
            'gambar' => 'Gambar',
            'video' => 'Video',
        ];

        return view('pages.media.create', compact('tipeOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:gambar,video',
            'file' => [
                'required',
                'file',
                $request->tipe === 'gambar'
                    ? 'mimes:jpg,jpeg,png,webp'
                    : 'mimes:mp4',
                'max:51200', // ✅ 50MB
            ],
            'durasi' => 'nullable|integer|min:3|max:60',
            'urutan' => 'nullable|integer|min:1',
        ]);

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

            $originalPath = $file->storeAs('media', $filename, 'public');
            $validated['file_path'] = $originalPath;

            if ($validated['tipe'] === 'gambar') {

                $thumbPath = 'media/thumb/' . pathinfo($filename, PATHINFO_FILENAME) . '.webp';

                $manager = new ImageManager(new Driver());

                $image = $manager->read($file)
                    ->cover(320, 180)
                    ->toWebp(75);

                Storage::disk('public')->put($thumbPath, (string) $image);

                $validated['thumb_path'] = $thumbPath;
            }
        }


        Media::create($validated);

        Cache::increment('display_version');

        return redirect()->route('media.index')
            ->with('success', 'Media berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        return view('pages.media.show', compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media $media)
    {
        return view('pages.media.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Media $media)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
        ]);

        $media->update([
            'judul' => $validated['judul'],
        ]);

        return redirect()->route('media.index')
            ->with('success', 'Judul media berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        // Hapus file dari storage
        if ($media->file_path && Storage::disk('public')->exists($media->file_path)) {
            Storage::disk('public')->delete($media->file_path);
        }

        $media->delete();

        return redirect()->route('media.index')
            ->with('success', 'Media berhasil dihapus.');
    }

    /**
     * Get file extension from mime type
     */

    // toggle tampil / tidak
    public function toggle(Request $request)
    {
        $media = Media::findOrFail($request->id);

        if ($media->aktif != $request->aktif) {
            $media->aktif = $request->aktif;
            $media->save();
        }
        Cache::increment('display_version');
        return response()->json(['success' => true]);
    }

    // update urutan slideshow
    public function updateUrutan(Request $request)
    {
        $media = Media::findOrFail($request->id);
        $media->urutan = $request->urutan;
        $media->save();
        Cache::increment('display_version');
        return response()->json(['success' => true]);
    }

    public function updateDurasi(Request $request)
    {
        $media = Media::findOrFail($request->id);
        $media->durasi = $request->durasi;
        $media->save();
        Cache::increment('display_version');
        return response()->json(['success' => true]);
    }
}
