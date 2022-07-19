<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use DataTables;
use Validator;
use App\Models\Admin;

class OperatorController extends Controller
{
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            return DataTables::of(Admin::get())->addIndexColumn()
            ->addColumn('action', function($model) {
                return '
                    <a href="" class="btn btn-sm btn-primary">
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
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            [
                'data' => 'action','title' => 'Action',
                'width' => '170px','class' => 'text-center',
                'orderable' => false,
                'searchable' => false
            ]
        ])->minifiedAjax()->responsive()->autoWidth(false);

        return view('pages.admin.operator.index')
        ->with([
            'html' => $html
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $admin = new Admin;
        $admin->name= $request->name;
        $admin->email= $request->email;
        $admin->password = bcrypt($request->password);

        $store=$admin->save();

        return $store ? redirect()->route('admin.operator.index')->with('status', 'Data saved statusfully')
        : redirect()->back()->with('danger', 'Failed to save');
    }

    public function destroy(Request $request)
    {
        $find = Admin::findOrFail($request->id);

        $destroy = $find->delete();

        return $destroy ? response()->json(['success' => true, 'message' => 'Data deleted successfully'], 200)->header('Content-Type', 'application/json') : 
            response()->json(['success' => false, 'message' => 'Data failed to delete'], 400)->header('Content-Type', 'application/json');
    }
    
}
