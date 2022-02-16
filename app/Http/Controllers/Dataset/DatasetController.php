<?php

namespace App\Http\Controllers\Dataset;

use App\Dataset;
use App\Imports\DatasetImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;

class DatasetController extends Controller
{
    public function index() {
        $data = Dataset::all();
        return view('dataset.index', compact('data'));
    }

    public function datasetimportexcel(Request $request) {
        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $file->move('data', $namaFile);

        Excel::import(new DatasetImport, public_path('/data/'.$namaFile));
        return redirect('/dataset')->with('toast_success', 'Dataset berhasil diimport!');
    }

    public function store(Request $request) {
        // dd($request->all());
        $this->validate($request, [
            'kode_siswa' => ['required', 'max:5','unique:datasets,kode_siswa'],
            'jk' => ['required'],
            'a1' => ['required'],
            'a2' => ['required'],
            'a3' => ['required'],
            'a4' => ['required'],
            'a5' => ['required'],
            'a6' => ['required'],
            'a7' => ['required'],
            'a8' => ['required'],
            'a9' => ['required'],
        ]);
        Dataset::create([
            'kode_siswa' => $request->kode_siswa,
            'jk' => $request->jk,
            'a1' => $request->a1,
            'a2' => $request->a2,
            'a3' => $request->a3,
            'a4' => $request->a4,
            'a5' => $request->a5,
            'a6' => $request->a6,
            'a7' => $request->a7,
            'a8' => $request->a8,
            'a9' => $request->a9,
        ]);
        return redirect('/dataset')->with('toast_success', 'Dataset berhasil ditambah!');
    }

    public function update(Request $request, $id) {
        // Dataset::where('id', $id)->update($request->all());
        $data = Dataset::findorfail($id);
        $data->update($request->all());
        return redirect('/dataset')->with('toast_success', 'Dataset berhasil diubah!');
    }

    public function destroy($id) {
        $data = Dataset::findorfail($id);
        $data->delete();
        return back()->with('info', 'Data berhasil dihapus!');
    }

    public function deleteall() {
        Dataset::truncate();
        return back()->with('info', 'Semua Data berhasil dihapus!');
    }
}
