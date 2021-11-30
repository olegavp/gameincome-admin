<?php

namespace App\Http\Controllers\Admin\Employees;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteEmployeeController extends Controller
{
    public function deleteEmployee(AdminUser $adminUser)
    {
        try
        {
            $adminUser->delete();
            DB::table('model_has_roles')->where('model_id', $adminUser->id)->delete();
            return redirect()->back()->withSuccess('Вы успешно удалили данного сотрудника');
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
