<?php

namespace App\Http\Controllers;

use App\Models\RunningText;
use Illuminate\Http\Request;

class RunningTextController extends Controller
{
    public function index()
    {
        $runningTexts = RunningText::all();
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
            'aktif' => 'boolean',
        ]);

        RunningText::create($request->all());

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
            'aktif' => 'boolean',
        ]);

        $runningText->update($request->all());

        return redirect()->route('running-texts.index')
            ->with('success', 'Running text berhasil diperbarui.');
    }

    public function destroy(RunningText $runningText)
    {
        $runningText->delete();

        return redirect()->route('running-texts.index')
            ->with('success', 'Running text berhasil dihapus.');
    }
}
