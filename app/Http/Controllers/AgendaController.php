<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class AgendaController extends Controller
{
    public function index()
    {
        $agenda = Agenda::orderBy('updated_at', 'desc')->get();
        return view('pages.agenda.index', compact('agenda'));
    }

    public function create()
    {
        return view('pages.agenda.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'judul'       => 'required|string|max:150',
                'deskripsi'   => 'required|string',
                'tgl_mulai'   => 'required|date',
                'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            ],
            [
                'tgl_selesai.after_or_equal' =>
                'Tanggal selesai harus sama atau setelah tanggal mulai.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Agenda::create($request->all());
        Cache::increment('display_version');

        return redirect()->route('agenda.index')
            ->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function show($id_agenda)
    {
        $agenda = Agenda::findOrFail($id_agenda);
        return view('agenda.show', compact('agenda'));
    }

    public function edit($id_agenda)
    {
        $agenda = Agenda::findOrFail($id_agenda);
        Cache::increment('display_version');

        return view('pages.agenda.create', compact('agenda'));
    }

    public function update(Request $request, $id_agenda)
    {
        $agenda = Agenda::findOrFail($id_agenda);

        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:150',
            'deskripsi' => 'required|string',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $agenda->update($request->all());
        Cache::increment('display_version');

        return redirect()->route('agenda.index')
            ->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy($id_agenda)
    {
        $agenda = Agenda::findOrFail($id_agenda);
        $agenda->delete();
        Cache::increment('display_version');

        return redirect()->route('agenda.index')
            ->with('success', 'Agenda berhasil dihapus.');
    }
}
