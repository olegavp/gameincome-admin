<?php

namespace App\Http\Controllers\Admin\Employees;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;

class GetEmployeesController extends Controller
{
    public function index()
    {
        try
        {
            $adminUsers = AdminUser::query()->get();
            return view('admin/employees/list/index')->with(['adminUsers' => $adminUsers]);
        }
        catch (\Throwable $e)
        {

        }
    }
}
