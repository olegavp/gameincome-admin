<?php

namespace App\Http\Controllers\Admin\Employees;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\Employee\CreateEmployeeRequest;
use App\Models\AdminUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegistrationEmployeeController extends Controller
{
    private $user;


    public function index()
    {
        try
        {
            $roles = DB::table('roles')->get();
            return view('admin/employees/registration/index')->with(['roles' => $roles]);
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }


    public function createEmployee(CreateEmployeeRequest $request)
    {
        try
        {
            DB::transaction(function () use ($request)
            {
                $this->user = AdminUser::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                $this->user->assignRole($request->role);
            });

            return redirect()->back()->withSuccess('Вы успешно зарегистрировали нового сотрудника в системе.');
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
