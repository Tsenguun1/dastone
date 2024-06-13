<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrgEmployee;
use App\Models\OrgDepartment;
use App\Models\OrgPosition;

class EmployeeController extends Controller
{
    public function viewemployee()
    {
        $employees = OrgEmployee::all();
        return view('viewemployee', compact('employees'));
    }

    public function addFormemployee(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                // Define validation rules for employee creation here
            ]);

            // Create new employee
            OrgEmployee::create([
                'REGISTER' => $request->register,
                'FIRSTNAME' => $request->firstname,
                'LASTNAME' => $request->lastname,
                'POS_ID' => $request->pos_id,
                'DEP_ID' => $request->dep_id,
                'EMAIL' => $request->email,
                'PASS' => $request->pass,
                'WORK_DATE' => $request->work_date,
                'STATUS' => $request->status,
                'BIRTHDATE' => $request->birthdate,
                'HANDPHONE' => $request->handphone,
                'HOMEPHONE' => $request->homephone,
                'WORKPHONE' => $request->workphone,
                'FINGERID' => $request->fingerid,
                'SEX' => $request->sex,
                'PICTURE_LINK' => $request->picture_link,
                'EDIT_DATE' => now(),
                'EDIT_EMPID' => auth()->id(), // Example of capturing authenticated user's ID
                // Add other fields as needed
            ]);

            return redirect()->route('viewemployee')->with('success', 'Employee added successfully!');
        }

        // Load necessary data for the form if needed
        $departments = OrgDepartment::all();
        $positions = OrgPosition::all();

        return view('addemployee', compact('departments', 'positions'));
    }

    public function deleteemployee($id)
    {
        $employee = OrgEmployee::findOrFail($id);
        $employee->delete();

        return redirect()->route('viewemployee')->with('success', 'Employee deleted successfully!');
    }

    public function updateemployee(Request $request)
    {
        $id = $request->input('empId');
        $employee = OrgEmployee::findOrFail($id);

        $request->validate([
            // Define validation rules for updating employee here
        ]);

        $employee->update([
            'REGISTER' => $request->register,
            'FIRSTNAME' => $request->firstname,
            'LASTNAME' => $request->lastname,
            'POS_ID' => $request->pos_id,
            'DEP_ID' => $request->dep_id,
            'EMAIL' => $request->email,
            'PASS' => $request->pass,
            'WORK_DATE' => $request->work_date,
            'STATUS' => $request->status,
            'BIRTHDATE' => $request->birthdate,
            'HANDPHONE' => $request->handphone,
            'HOMEPHONE' => $request->homephone,
            'WORKPHONE' => $request->workphone,
            'FINGERID' => $request->fingerid,
            'SEX' => $request->sex,
            'PICTURE_LINK' => $request->picture_link,
            'EDIT_DATE' => now(),
            'EDIT_EMPID' => auth()->id(), // Example of capturing authenticated user's ID
            // Add other fields as needed
        ]);

        return redirect()->route('viewemployee')->with('success', 'Employee updated successfully!');
    }
}
