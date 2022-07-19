<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use DataTables;

class MahasiswaController extends Controller
{
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            return DataTables::of([])->addIndexColumn()
            ->toJson();
        }
    
        $html = $builder->columns([
            [
                'data' => 'DT_RowIndex','title' => '#',
                'orderable' => false,'searchable' => false,
                'width' => '24px'
            ],
            ['data' => 'nim', 'name' => 'NIM', 'title' => 'NIM'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Nama'],
            ['data' => 'gender', 'name' => 'gender', 'title' => 'Jenis Kelamin'],
            [
                'data' => 'action','title' => 'Action',
                'width' => '170px','class' => 'text-center',
                'orderable' => false,
                'searchable' => false
            ]
        ])->minifiedAjax()->responsive()->autoWidth(false);

        return view('pages.admin.mahasiswa.index')
        ->with([
            'html' => $html
        ]);
    }

    public function new()
    {
        return view('pages.admin.mahasiswa.new');
    }
}
