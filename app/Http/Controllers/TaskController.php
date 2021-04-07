<?php

declare(strict_types=1);

namespace App\Http\Controllers;

final class TaskController extends AppBaseController
{
    public function index()
    {
        return view('tasks.index');
    }
}
