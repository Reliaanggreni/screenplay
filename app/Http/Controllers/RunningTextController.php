<?php

namespace App\Http\Controllers;

use App\Models\RunningText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RunningTextController extends Controller
{
    public function index()
    {
        $runningTexts = RunningText::orderBy('created_at', 'desc')->get();

        return view('pages.runningtexts.index', compact('runningTexts'));
    }

    public function create()
    {
        return view('pages.runningtexts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'isi_teks' => 'required|string',
        ]);

        $runningText = RunningText::create([
            'isi_teks' => $request->isi_teks,
            'aktif' => $request->has('aktif') ? 1 : 0,
        ]);

        if ($runningText->aktif) {
            Cache::increment('display_version');
        }

        return redirect()->route('running-texts.index')
            ->with('success', 'Running text berhasil ditambahkan.');
    }


    public function show(RunningText $runningText)
    {
        return view('running-texts.show', compact('runningText'));
    }

    public function edit(RunningText $runningText)
    {
        return view('pages.runningtexts.edit', compact('runningText'));
    }

    public function update(Request $request, RunningText $runningText)
    {
        $request->validate([
            'isi_teks' => 'required|string',
        ]);

        $aktifSebelum = $runningText->aktif;

        $runningText->update([
            'isi_teks' => $request->isi_teks,
            'aktif' => $request->has('aktif') ? 1 : 0,
        ]);

        if ($aktifSebelum || $runningText->aktif) {
            Cache::increment('display_version');
        }

        return redirect()->route('running-texts.index')
            ->with('success', 'Running text berhasil diperbarui.');
    }



    public function destroy(RunningText $runningText)
    {
        $wasActive = $runningText->aktif;
        $runningText->delete();

        if ($wasActive) {
            Cache::increment('display_version');
        }
        return redirect()->route('running-texts.index')
            ->with('success', 'Running text berhasil dihapus.');
    }
}
