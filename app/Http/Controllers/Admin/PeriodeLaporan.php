<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use function PHPSTORM_META\type;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use App\Models\PeriodeLaporan as PeriodeLaporanModel;

class PeriodeLaporan extends Controller
{
    public function index()
    {
        $modal_title = [
            'tambah' => 'Tambah Periode Laporan',
            'edit' => 'Edit Periode Laporan',
            'delete' => 'Delete Periode Laporan',
        ];
        $dataTables = PeriodeLaporanModel::all();
        $delete_msg = 'Apakah kamu yakin ingin menghapus Periode Laporan ini ?';


        $base_route = 'periode-laporan.index';

        $modal_field = [
            [
                'name' => 'nama periode',
                'model' => 'nama_periode',
            ],
            [
                'name' => 'mulai',
                'model' => 'start',
                'type' => 'date'
            ],
            [
                'name' => 'akhir',
                'model' => 'end',
                'type' => 'date'
            ],
        ];


        $cols = ['nama periode', 'mulai', 'akhir'];
        $rows = ['nama_periode', 'start', 'end'];

        $resource = true;

        $data = [
            'title' => 'Daftar Pengajuan',
            'cols' => $cols,
            'rows' => $rows,
            'dataTables' => $dataTables,
            'modal_title' => $modal_title,
            'modal_field' => $modal_field,
            'btn_link' => false,
            'base_route' => $base_route,
            'resource' => $resource,
            'delete_msg' => $delete_msg,
        ];
        return view('table', $data);
    }

    public function destroy(Request $request)
    {

        $id = $request->id;

        $delete = PeriodeLaporanModel::destroy($id);

        if (!$delete) {
            return Redirect::back()->with('fail', 'Gagal Menghapus Periode Laporan');
        }

        return Redirect::back()->with(['success' => 'Periode Laporan Berhasil Dihapus']);
    }

    public function create(Request $request)
    {
        $create =  PeriodeLaporanModel::create([
            'nama_periode' => $request->nama_periode,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        if (!$create) {
            return Redirect::back()->with('fail', 'Gagal Membuat Periode Laporan');
        }

        return Redirect::back()->with(['success' => 'Periode Laporan Berhasil Dibuat']);
    }

    public function update(Request $request)
    {

        $update =  PeriodeLaporanModel::updateOrCreate(['id' => $request->id], [
            'nama_periode' => $request->nama_periode,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        if (!$update) {
            return Redirect::back()->with('fail', 'Gagal Update Periode Laporan');
        }

        return Redirect::back()->with(['success' => 'Periode Laporan Berhasil Diupdate']);
    }
}
