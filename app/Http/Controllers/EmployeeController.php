<?php

namespace App\Http\Controllers;

use App\Models\OrgDepartment;
use App\Models\OrgEmployee;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\OrgPosition;
use App\Models\Department;

class EmployeeController extends Controller
{
    public function viewemployee()
    {
        $employees = OrgEmployee::all();
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
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('pictures', $filename, 'public');
            $employee->PICTURE_LINK = '/storage/' . $path;
        }

        $employee->save();

        return redirect()->back()->with('success', 'Ажилтан амжилттай нэмэгдлээ.');
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
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('pictures', $filename, 'public');
            $employee->PICTURE_LINK = '/storage/' . $path;
        }

        // Save the updated employee details
        $employee->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Ажилтан амжилттай шинэчлэгдлээ.');
    }

    public function deleteemployee($id)
    {
        $employee = OrgEmployee::find($id);
        $employee->delete();

        return redirect()->back()->with('success', 'Ажилтан амжилттай устгагдлаа.');
    }
}
