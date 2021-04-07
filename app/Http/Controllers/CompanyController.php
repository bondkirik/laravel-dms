<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Corporation;
use Illuminate\Http\Request;

final class CompanyController extends AppBaseController
{
    public function add()
    {
        $corporations = Corporation::all();

        return view('companies.add', compact('corporations'));
    }

    public function store(Request $request)
    {

        $parameters = $this->validate($request, [
            'title' => 'required|unique:posts|max:255'
        ]);

        $company = new Company();
        $company->corporation_id = $parameters['corporation_id'];
        $company->title = $parameters['title'];
        $company->save();

        return redirect()->route('organizations.index');
    }

    public function view(int $id)
    {
        $company = Company::findOrFail($id);

        return view('companies.view', compact('company'));
    }

    public function edit(int $id)
    {
        $company = Company::findOrFail($id);

        return view('companies.edit', compact('company'));
    }

    public function save(int $id)
    {
        $parameters = request()->all();

        $company = Company::findOrFail($id);
        $company->title = $parameters['title'];
        $company->save();

        return redirect()->route('organizations.index');
    }

    public function delete(int $id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->back();
    }
}
