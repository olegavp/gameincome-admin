<?php

namespace App\Http\Controllers\Admin\Employees;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EditEmployeesController extends Controller
{
    public function index(AdminUser $adminUser)
    {
        try
        {
            $role = DB::table('model_has_roles')->where('model_id', $adminUser->id)->pluck('role_id')[0];
            $role = DB::table('roles')->where('id', $role)->select('name', 'id')->get()[0];
            $roles = DB::table('roles')->where('name', '!=', $role->name)->get();
            return view('admin/employees/edit/index')->with(['adminUser' => $adminUser, 'role' => $role, 'roles' => $roles]);
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }


    public function edit(Request $request, AdminUser $adminUser)
    {
        try
        {
            $validator = Validator::make($request->all(), [
                'name' => ['bail','required','string','max:255'],
                'role' => ['bail','required','string'],
                'password' => ['confirmed'],
                'email' => ['bail', 'required', 'string', 'max:255', 'email',
                    function ($attribute, $value, $fail) use ($adminUser) {
                        $hasEmail = AdminUser::query()->where('email', $value)->get();
                        if ($value != $adminUser->email and $hasEmail->isNotEmpty())
                        {
                            $fail($attribute.' изменить невозможно, так как с таким email уже существует сотрудник.');
                        }
                    },
                ]
            ]);

            if ($validator->fails()) {
                return redirect('admin-panel/trash-box/employees/page/edit/' . $adminUser->id)
                    ->withErrors($validator)
                    ->withInput();
            }

            if (isset($request->role) and isset($request->role) != null)
            {
                DB::table('model_has_roles')->where('model_id', $adminUser->id)->update(['role_id' => $request->role]);
            }

            $request = $request->toArray();
            $request['password'] = Hash::make($request['password']);
            $adminUser->update($request);

            return redirect()->back()->withSuccess('Вы успешно изменили данные сотрудника!');
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
