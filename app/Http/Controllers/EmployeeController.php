<?php

namespace App\Http\Controllers;

use App\Models\OrgDepartment;
use App\Models\OrgEmployee;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\OrgPosition;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    
    public function viewemployee()
    {
        $employees = DB::table('org_employee')
            ->join('org_department', 'org_employee.DEP_ID', '=', 'org_department.DEP_ID')
            ->join('org_position', 'org_employee.POS_ID', '=', 'org_position.POS_ID')
            ->select(
                'org_employee.EMP_ID',
                'org_employee.FIRSTNAME',
                'org_employee.LASTNAME',
                'org_employee.DEP_ID', 
                'org_employee.POS_ID', 
                'org_employee.REGISTER',
                'org_employee.SEX',
                'org_employee.EMAIL',
                'org_employee.BIRTHDATE',
                'org_employee.HANDPHONE',
                'org_employee.HOMEPHONE',
                'org_employee.WORKPHONE',
                'org_employee.STATUS',
                'org_employee.PICTURE_LINK',
                'org_employee.WORK_DATE',
                'org_department.DEP_NAME',
                'org_position.POS_NAME'
            )
            ->where('org_employee.STATUS', '!=', 'D')
            ->orderBy('org_department.DEP_ID')
            ->orderBy('org_employee.FIRSTNAME')
            ->orderBy('org_employee.LASTNAME')
            ->get();

        $positions = OrgPosition::all();
        $departments = OrgDepartment::all();

        return view('viewemployee', compact('employees', 'positions', 'departments'));
    }

    
    public function addFormemployee(Request $request)
    {
        $validatedData = $request->validate([
            'REGISTER' => 'required|string|max:255',
            'FIRSTNAME' => 'required|string|max:255',
            'LASTNAME' => 'required|string|max:255',
            'POS_ID' => 'required|integer',
            'DEP_ID' => 'required|integer',
            'EMAIL' => 'required|string|email|max:255',
            'WORK_DATE' => 'required|date',
            'STATUS' => 'required|string|max:255',
            'BIRTHDATE' => 'required|date',
            'HANDPHONE' => 'required|string|max:255',
            'HOMEPHONE' => 'nullable|string|max:255',
            'WORKPHONE' => 'nullable|string|max:255',
            'SEX' => 'required|string|max:255',
            'PICTURE_LINK' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $employee = new OrgEmployee();
        $employee->REGISTER = $validatedData['REGISTER'];
        $employee->FIRSTNAME = $validatedData['FIRSTNAME'];
        $employee->LASTNAME = $validatedData['LASTNAME'];
        $employee->POS_ID = $validatedData['POS_ID'];
        $employee->DEP_ID = $validatedData['DEP_ID'];
        $employee->EMAIL = $validatedData['EMAIL'];
        $employee->PASS = bcrypt('default_password'); // Ensure to hash the password
        $employee->WORK_DATE = $validatedData['WORK_DATE'];
        $employee->STATUS = $validatedData['STATUS'];
        $employee->BIRTHDATE = $validatedData['BIRTHDATE'];
        $employee->HANDPHONE = $validatedData['HANDPHONE'];
        $employee->HOMEPHONE = $validatedData['HOMEPHONE'];
        $employee->WORKPHONE = $validatedData['WORKPHONE'];
        $employee->SEX = $validatedData['SEX'];
        $employee->FINGERID = 0; // Set a default value for FINGERID

        if ($request->hasFile('PICTURE_LINK')) {
            $file = $request->file('PICTURE_LINK');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('pictures', $filename, 'public');
            $employee->PICTURE_LINK = '/storage/' . $path;
        }

        $employee->save();

        return redirect()->back();
    }



    public function updateemployee(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'EMP_ID' => 'required|integer',
            'REGISTER' => 'required|string|max:255',
            'FIRSTNAME' => 'required|string|max:255',
            'LASTNAME' => 'required|string|max:255',
            'POS_ID' => 'required|integer',
            'DEP_ID' => 'required|integer',
            'EMAIL' => 'required|string|email|max:255',
            'WORK_DATE' => 'required|date',
            'STATUS' => 'required|string|max:255',
            'BIRTHDATE' => 'required|date',
            'HANDPHONE' => 'required|string|max:255',
            'HOMEPHONE' => 'nullable|string|max:255',
            'WORKPHONE' => 'nullable|string|max:255',
            'SEX' => 'required|string|max:255',
            'PICTURE_LINK' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Find the employee by ID
        $employee = OrgEmployee::findOrFail($validatedData['EMP_ID']);
    
        // Update the employee's details
        $employee->REGISTER = $validatedData['REGISTER'];
        $employee->FIRSTNAME = $validatedData['FIRSTNAME'];
        $employee->LASTNAME = $validatedData['LASTNAME'];
        $employee->POS_ID = $validatedData['POS_ID'];
        $employee->DEP_ID = $validatedData['DEP_ID'];
        $employee->EMAIL = $validatedData['EMAIL'];
        $employee->WORK_DATE = $validatedData['WORK_DATE'];
        $employee->STATUS = $validatedData['STATUS'];
        $employee->BIRTHDATE = $validatedData['BIRTHDATE'];
        $employee->HANDPHONE = $validatedData['HANDPHONE'];
        $employee->HOMEPHONE = $validatedData['HOMEPHONE'];
        $employee->WORKPHONE = $validatedData['WORKPHONE'];
        $employee->SEX = $validatedData['SEX'];
        $employee->FINGERID = $request->input('FINGERID'); // Assuming FINGERID is part of the request
    
        // Handle the picture upload if provided
        if ($request->hasFile('PICTURE_LINK')) {
            $file = $request->file('PICTURE_LINK');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('pictures', $filename, 'public');
            $employee->PICTURE_LINK = '/storage/' . $path;
        }
    
        // Save the updated employee details
        $employee->save();
    
        // Redirect back with a success message
        return redirect()->back();
    }
    

    public function deleteemployee($id)
    {
        $employee = OrgEmployee::findOrFail($id);
        $employee->status = 'D'; // Assuming 'D' represents deleted or deactivated status
        $employee->save();

        return redirect()->route('viewemployee');
    }
}
