<?php

namespace App\Http\Controllers;

use App\Http\Requests\Department\StoreRequest;
use App\Http\Requests\Department\UpdateRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return view('department.index', ['departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $storeRequest)
    {
        $inputs = $storeRequest->validated();
        Department::create($inputs);

        return back()->with('succeed', '部署を登録しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($departmentId)
    {
        $department = Department::find($departmentId);
        
        return view('department.edit', ['department' => $department]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $updateRequest, $departmentId)
    {
        $department = Department::find($departmentId);
        $department->name = $updateRequest->name;
        $department->save();

        return redirect()->route('department.index')->with('succeed', '部署名を変更しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($departmentId)
    {
        Department::find($departmentId)->delete();

        return redirect()->route('department.index')->with('warning', '部署を削除しました。');
    }
}
