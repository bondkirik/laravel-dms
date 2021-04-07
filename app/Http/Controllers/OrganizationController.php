<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Corporation;
use App\Models\Relation;
use App\Models\User;

final class OrganizationController extends AppBaseController
{
    public function index()
    {
        $corporations = Corporation::all();

        return view('organizations.index', compact('corporations'));
    }

    public function assign(int $id)
    {
        $user = User::findOrFail($id);
        $corporations = Corporation::all();

        return view('organizations.assign', compact('user', 'corporations'));
    }

    public function process(int $id)
    {
        $parameters = request()->only(['corporation_id', 'company_id', 'department_id']);

        Relation::where('user_id', $id)->update($parameters);

        return redirect()->route('users.show', ['user' => User::find($id)]);
    }
}
