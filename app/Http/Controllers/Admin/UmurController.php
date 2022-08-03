<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use DataTables;
use Validator;
use App\Models\Umur;

class UmurController extends Controller
{
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            return DataTables::of(Umur::get())->addIndexColumn()
            ->addColumn('action', function($model) {
                return '
                    <a href="'.route('admin.umur.edit', $model->id).'" class="btn btn-sm btn-primary">
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
            ['data' => 'name', 'name' => 'name', 'title' => 'Nama'],
            ['data' => 'start_range', 'name' => 'start_range', 'title' => 'Dari'],
            ['data' => 'end_range', 'name' => 'end_range', 'title' => 'Sampai'],
            [
                'data' => 'action','title' => 'Action',
                'width' => '170px','class' => 'text-center',
                'orderable' => false,
                'searchable' => false
            ]
        ])->minifiedAjax()->responsive()->autoWidth(false);

        return view('pages.admin.umur.index')
        ->with([
            'html' => $html
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'start_range' => 'required|unique:umurs',
            'end_range' => 'required|unique:umurs',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = new Umur;
        $data->name= $request->name;
        $data->start_range= $request->start_range;
        $data->end_range= $request->end_range;
        $data->predict_value = $request->predict_value;

        $store= $data->save();

        return $store ? redirect()->route('admin.umur.index')->with('status', 'Data saved statusfully')
        : redirect()->back()->with('danger', 'Failed to save');
    }
    public function destroy(Request $request)
    {
        $find = Umur::findOrFail($request->id);

        $destroy = $find->delete();

        return $destroy ? response()->json(['success' => true, 'message' => 'Data deleted successfully'], 200)->header('Content-Type', 'application/json') : 
            response()->json(['success' => false, 'message' => 'Data failed to delete'], 400)->header('Content-Type', 'application/json');
    }

    public function edit($id)
    {
        $data = Umur::where('id', $id)->first();
        return view('pages.admin.umur.edit')->with([
            "data" => $data,
        ]);
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'start_range' => 'required|unique:umurs,start_range,'.$request->id,
            'end_range' => 'required|unique:umurs,end_range,'.$request->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = Umur::where('id', $request->id)->FirstOrFail();
        
        $data->name= $request->name;
        $data->start_range= $request->start_range;
        $data->end_range= $request->end_range;
        $data->predict_value = $request->predict_value;
        
        $store=$data->save();

        return $store ? redirect()->route('admin.umur.index')->with('status', 'Data saved statusfully')
        : redirect()->back()->with('danger', 'Failed to save');
    }
}
