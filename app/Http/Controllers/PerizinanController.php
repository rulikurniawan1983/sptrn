<?php

namespace App\Http\Controllers;

use App\Models\Perizinans;
use Illuminate\Http\Request;
use App\Traits\BaseTrait;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PerizinanController extends Controller implements HasMiddleware
{
    use BaseTrait;
    private $repository;

    public function __construct()
    {
        $this->initialize();
        $this->commonData['kode_first_menu']  = 'KELOLA-PERIZINAN-SIDEBAR';
        $this->commonData['kode_second_menu'] = 'PERIZINAN';
        $this->commonData['col'] = 'col-lg-12';
    }

    public static function middleware(): array
    {
        $className  = class_basename(__CLASS__);
        $permission = str_replace('Controller', '', $className);
        $permission = trim(implode(' ', preg_split('/(?=[A-Z])/', $permission)));
        return [
            new Middleware("can:$permission Show", only: ['index']),
            new Middleware("can:$permission Add", only: ['store']),
            new Middleware("can:$permission Delete", only: ['destroy']),
        ];
    }

    public function index()
    {
        $user = auth()->user();
        $perizinans = Perizinans::where('user_id', $user->id)->get();
        return view('perizinan.index', compact('perizinans') + $this->commonData);
    }

    public function store(Request $request)
    {
        $request->validate([
            'perizinan_nama' => 'required|string|max:255',
            'perizinan_file' => 'required|file|mimes:pdf,jpeg,jpg|max:5120',
        ]);

        $user = auth()->user();
        $file = $request->file('perizinan_file');

        // Remove old file if exists for this permit type
        $existing = Perizinans::where('user_id', $user->id)
            ->where('nama', $request->perizinan_nama)
            ->first();
        
        if ($existing && $existing->file) {
            $path = storage_path('app/public/' . $existing->file);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        // Store new file
        $path = $file->store('perizinan/' . $user->id, 'public');

        // Create or update permit record
        Perizinans::updateOrCreate(
            ['user_id' => $user->id, 'nama' => $request->perizinan_nama],
            ['file' => $path, 'status' => 'Sudah Diunggah']
        );

        return redirect()->route('perizinan.index')->with('success', 'Berkas perizinan berhasil diupload.');
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $perizinan = Perizinans::where('user_id', $user->id)->where('id', $id)->firstOrFail();

        if ($perizinan->file) {
            $path = storage_path('app/public/' . $perizinan->file);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $perizinan->delete();

        return redirect()->route('perizinan.index')->with('success', 'Berkas perizinan berhasil dihapus.');
    }
}
