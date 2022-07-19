<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use DataTables;
use Validator;
use App\Models\SchoolCluster;

class SchoolDistrictController extends Controller
{
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            return DataTables::of(SchoolCluster::get())->addIndexColumn()
            ->addColumn('action', function($model) {
                return '
                    <a href="'.route('admin.school.district.edit', $model->id).'" class="btn btn-sm btn-primary">
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
            ['data' => 'districts', 'name' => 'email', 'title' => 'Wilayah'],
            [
                'data' => 'action','title' => 'Action',
                'width' => '170px','class' => 'text-center',
                'orderable' => false,
                'searchable' => false
            ]
        ])->minifiedAjax()->responsive()->autoWidth(false);

        return view('pages.admin.district.index')
        ->with([
            'html' => $html
        ]);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'districts' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $district = new SchoolCluster;
        $district->name= $request->name;
        $district->districts= $request->districts;

        $store=$district->save();

        return $store ? redirect()->route('admin.school.district.index')->with('status', 'Data saved statusfully')
        : redirect()->back()->with('danger', 'Failed to save');
    }
    public function destroy(Request $request)
    {
        $find = SchoolCluster::findOrFail($request->id);

        $destroy = $find->delete();

        return $destroy ? response()->json(['success' => true, 'message' => 'Data deleted successfully'], 200)->header('Content-Type', 'application/json') : 
            response()->json(['success' => false, 'message' => 'Data failed to delete'], 400)->header('Content-Type', 'application/json');
    }
    public function edit($id)
    {
        $district = SchoolCluster::where('id', $id)->first();
        return view('pages.admin.district.edit')->with([
            "district" => $district,
        ]);
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'districts' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $district = SchoolCluster::where('id', $request->id)->FirstOrFail();
        
        $district->name= $request->name;
        $district->districts= $request->districts;
        
        $store=$district->save();

        return $store ? redirect()->route('admin.school.district.index')->with('status', 'Data saved statusfully')
        : redirect()->back()->with('danger', 'Failed to save');
    }
}
