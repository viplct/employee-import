<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    const DEFAULT_PER_PAGE = 10;
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', self::DEFAULT_PER_PAGE);
        $employees = Employee::paginate($perPage);
        return $this->sendResponse($employees);
    }

    public function show(Employee $employee)
    {
        return $this->sendResponse($employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return $this->sendResponse([
            'status' => 'success',
            'message' => 'Employee deleted successfully.'
        ]);
    }
}
