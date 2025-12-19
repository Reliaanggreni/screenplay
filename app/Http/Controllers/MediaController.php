<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = Media::latest()->paginate(10);
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
            'file'  => 'required|file|mimetypes:image/jpeg,image/png,image/webp,video/mp4,video/x-msvideo,video/x-matroska|max:20480',
        ]);

        // Upload file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('media', 'public');
            $validated['file_path'] = $path;
        }

        Media::create($validated);

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

        $media->update($validated);

        return redirect()->route('media.index')
            ->with('success', 'Media berhasil diperbarui.');
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
    private function getFileExtension($mimeType)
    {
        $extensions = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
            'video/mp4' => 'mp4',
        ];

        return $extensions[$mimeType] ?? 'bin';
    }
}
