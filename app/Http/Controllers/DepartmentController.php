<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Department;

final class DepartmentController extends AppBaseController
{
    public function add()
    {
        $companies = Company::all();

        return view('departments.add', compact('companies'));
    }

    public function store()
    {
        $parameters = request()->all();

        $company = new Department();
        $company->company_id = $parameters['company_id'];
        $company->title = $parameters['title'];
        $company->save();

        return redirect()->route('organizations.index');
    }

    public function view(int $id)
    {
        $department = Department::findOrFail($id);

        return view('departments.view', compact('department'));
    }

    public function edit(int $id)
    {
        $department = Department::findOrFail($id);

        return view('departments.edit', compact('department'));
    }

    public function save(int $id)
    {
        $parameters = request()->all();

        $department = Department::findOrFail($id);
        $department->title = $parameters['title'];
        $department->save();

        return redirect()->route('organizations.index');
    }

    public function delete(int $id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->back();
    }
}
