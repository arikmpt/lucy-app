<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use DataTables;
use Validator;
use App\Models\SchoolMajor;

class SchoolMajorController extends Controller
{
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            return DataTables::of(SchoolMajor::get())->addIndexColumn()
            ->addColumn('action', function($model) {
                return '
                    <a href="'.route('admin.school.major.edit', $model->id).'" class="btn btn-sm btn-primary">
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
            [
                'data' => 'action','title' => 'Action',
                'width' => '170px','class' => 'text-center',
                'orderable' => false,
                'searchable' => false
            ]
        ])->minifiedAjax()->responsive()->autoWidth(false);

        return view('pages.admin.major.index')
        ->with([
            'html' => $html
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $major = new SchoolMajor;
        $major->name= $request->name;

        $store=$major->save();

        return $store ? redirect()->route('admin.school.major.index')->with('status', 'Data saved statusfully')
        : redirect()->back()->with('danger', 'Failed to save');
    }
    public function destroy(Request $request)
    {
        $find = SchoolMajor::findOrFail($request->id);

        $destroy = $find->delete();

        return $destroy ? response()->json(['success' => true, 'message' => 'Data deleted successfully'], 200)->header('Content-Type', 'application/json') : 
            response()->json(['success' => false, 'message' => 'Data failed to delete'], 400)->header('Content-Type', 'application/json');
    }

    public function edit($id)
    {
        $major = SchoolMajor::where('id', $id)->first();
        return view('pages.admin.major.edit')->with([
            "major" => $major,
        ]);
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $major = SchoolMajor::where('id', $request->id)->FirstOrFail();
        
        $major->name= $request->name;
        
        $store=$major->save();

        return $store ? redirect()->route('admin.school.major.index')->with('status', 'Data saved statusfully')
        : redirect()->back()->with('danger', 'Failed to save');
    }
}
