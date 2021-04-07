<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Corporation;
use Illuminate\Http\Request;

final class CorporationController extends AppBaseController
{
    public function add()
    {
        return view('corporations.add');
    }

    public function store(Request $request)
    {

        $parameters = $this->validate($request, [
            'title' => 'required|unique:posts|max:255'
        ]);

        $corporation = new Corporation();
        $corporation->title = $parameters['title'];
        $corporation->save();

        return redirect()->route('organizations.index');
    }

    public function view(int $id)
    {
        $corporation = Corporation::findOrFail($id);

        return view('corporations.view', compact('corporation'));
    }

    public function edit(int $id)
    {
        $corporation = Corporation::findOrFail($id);

        return view('corporations.edit', compact('corporation'));
    }

    public function save(int $id)
    {
        $parameters = request()->all();

        $corporation = Corporation::findOrFail($id);
        $corporation->title = $parameters['title'];
        $corporation->save();

        return redirect()->route('organizations.index');
    }

    public function delete(int $id)
    {
        $corporation = Corporation::findOrFail($id);
        $corporation->delete();

        return redirect()->back();
    }
}
