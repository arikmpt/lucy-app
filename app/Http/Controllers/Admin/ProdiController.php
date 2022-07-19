<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use DataTables;
use Validator;
use App\Models\Prodi;

class ProdiController extends Controller
{
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            return DataTables::of(Prodi::get())->addIndexColumn()
            ->addColumn('action', function($model) {
                return '
                    <a href="'.route('admin.prodi.edit', $model->id).'" class="btn btn-sm btn-primary">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <button type="button" class="btn btn-sm btn-danger btn-delete">
                        <i class="fas fa-trash"></i>
                    </button>
                ';
            })
            ->toJson();
        }
    
        $html = $builder->columns([
            [
                'data' => 'DT_RowIndex','title' => '#',
                'orderable' => false,'searchable' => false,
                'width' => '24px'
            ],
            ['data' => 'code', 'name' => 'code', 'title' => 'Code'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Nama'],
            [
                'data' => 'action','title' => 'Action',
                'width' => '170px','class' => 'text-center',
                'orderable' => false,
                'searchable' => false
            ]
        ])->minifiedAjax()->responsive()->autoWidth(false);

        return view('pages.admin.prodi.index')
        ->with([
            'html' => $html
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $prodi = new Prodi;
        $prodi->code= $request->code;
        $prodi->name= $request->name;

        $store=$prodi->save();

        return $store ? redirect()->route('admin.prodi.index')->with('status', 'Data saved statusfully')
        : redirect()->back()->with('danger', 'Failed to save');
    }

    public function destroy(Request $request)
    {
        $find = Prodi::findOrFail($request->id);

        $destroy = $find->delete();

        return $destroy ? response()->json(['success' => true, 'message' => 'Data deleted successfully'], 200)->header('Content-Type', 'application/json') : 
            response()->json(['success' => false, 'message' => 'Data failed to delete'], 400)->header('Content-Type', 'application/json');
    }

    public function edit($id)
    {
        $prodi = Prodi::where('id', $id)->first();
        return view('pages.admin.prodi.edit')->with([
            "prodi" => $prodi,
        ]);
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $prodi = Prodi::where('id', $request->id)->FirstOrFail();
        
        $prodi->code= $request->code;
        $prodi->name= $request->name;
        
        $store=$prodi->save();

        return $store ? redirect()->route('admin.prodi.index')->with('status', 'Data saved statusfully')
        : redirect()->back()->with('danger', 'Failed to save');
    }
}
