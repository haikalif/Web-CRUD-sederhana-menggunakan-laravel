<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Http\Controllers\Controller;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Input\InputInterface;

use function PHPUnit\Framework\returnArgument;

class ControllerKelas extends Controller
{

    public function index() //method untuk menanpilkan(view)
    {
        $totalkelas = kelas::count();
        $kelas = kelas::all();
        return view('kelas.index', compact('kelas', 'totalkelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function Store(Request $request) //method untuk menyimpan data(store)
    {

        $request->validate([
            'namakelas' => 'required',
            'walikelas' => 'required',
            'ketuakelas' => 'required',
            'kursi' => 'required',
            'meja' => 'required',
            'gambar_kelas' => 'required|image|mimes:jpg,png,jpef,gif|max:30000',

        ]);

        $gambar_kelas = $request->file('gambar_kelas');
        $gambar_kelas_name = time() . "." . $gambar_kelas->getClientOriginalExtension();
        $gambar_kelas->move(public_path('upload_gambar'), $gambar_kelas_name);

        kelas::create([
            'namakelas' => $request->Input('namakelas'),
            'walikelas' => $request->Input('walikelas'),
            'ketuakelas' => $request->Input('ketuakelas'),
            'kursi' => $request->input('kursi'),
            'meja' => $request->input('meja'),
            'gambar_kelas' => $gambar_kelas_name,
        ]);

        return redirect()->Route('kelas.index')->with('success', 'data berhasil di simpan');
    }



    public function edit($id_kelas)
    {
        $kelas = kelas::find($id_kelas);

        if (!$kelas) {
            return redirect('/kelas')->with("tabel kelas tidak ditemukan");
        }
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id_kelas)
    {
        $kelas = kelas::find($id_kelas);

        $request->validate([
            "namakelas" => "required",
            "walikelas" => "required",
            "ketuakelas" => "required",
            "kursi" => "required|numeric",
            "meja" => "required|numeric",
            "gambar_kelas" => "nullable|image|mimes:jpg,jpeg,png,webp,gif",
        ]);

        if ($request->hasFile('gambar_kelas')) {
            $gambar_kelas = $request->file('gambar_kelas');
            $gambar_kelas_name = time() . "." . $gambar_kelas->getClientOriginalExtension();
            $gambar_kelas->move(public_path('upload_gambar'), $gambar_kelas_name);
            $kelas->gambar_kelas = $gambar_kelas_name;
        }

        $kelas->namakelas = $request->input('namakelas');
        $kelas->walikelas = $request->input('walikelas');
        $kelas->ketuakelas = $request->input('ketuakelas');
        $kelas->meja = $request->input('meja');
        $kelas->kursi = $request->input('kursi');

        $kelas->save();

        return redirect('/kelas');
    }



    public function destroy($id_kelas)
    {
        $kelas = kelas::find($id_kelas);
        $kelas->delete();
        return redirect('/kelas');
    }

    public function cari(Request $request)
    {
        $searchQuery = $request->input('kolomcari');

        if ($searchQuery) {
            $kelas = kelas::where('id_kelas', 'LIKE', "%{$searchQuery}")
                ->orWhere('namakelas', 'LIKE', "%{$searchQuery}%")
                ->orWhere('walikelas', 'LIKE', "%{$searchQuery}%")
                ->orWhere('ketuakelas', 'LIKE', "%{$searchQuery}%")
                ->get();
        } else {
            $kelas = kelas::all();
        }

        // TAMBAHKAN INI ↓↓↓
        $totalkelas = kelas::count();

        return view('kelas.index', compact('kelas', 'totalkelas', 'searchQuery'));
    }
}
