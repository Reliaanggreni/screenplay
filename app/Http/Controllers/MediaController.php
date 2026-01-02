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
                'max:30720', // max 30MB
            ],
            'durasi' => 'nullable|integer|min:3|max:60',
            'urutan' => 'nullable|integer|min:1',
        ]);

        $file = $request->file('file');
        $uuid = Str::uuid()->toString();

        if ($validated['tipe'] === 'gambar') {

            $manager = new ImageManager(new Driver());

            $filePath = "media/$uuid.webp";

            $image = $manager->read($file)
                ->resize(1920, 1080)
                ->toWebp(80);

            Storage::disk('public')->put($filePath, (string) $image);
            $validated['file_path'] = $filePath;

            // THUMB (admin)
            $thumbPath = "media/thumb/$uuid.webp";

            $thumb = $manager->read($file)
                ->cover(320, 180)
                ->toWebp(75);

            Storage::disk('public')->put($thumbPath, (string) $thumb);
            $validated['thumb_path'] = $thumbPath;
        }

        /**
         * =========================
         * VIDEO
         * =========================
         */
        if ($validated['tipe'] === 'video') {

            $ext = $file->getClientOriginalExtension();
            $filePath = "media/$uuid.$ext";

            $file->storeAs('media', "$uuid.$ext", 'public');
            $validated['file_path'] = $filePath;
        }

        Media::create($validated);

        // trigger reload display
        Cache::increment('display_version');

        return redirect()->route('media.index')
            ->with('success', 'Media berhasil ditambahkan.');
    }
}
