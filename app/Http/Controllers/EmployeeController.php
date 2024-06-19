<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrgEmployee;
use App\Models\OrgDepartment;
use App\Models\OrgPosition;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = DB::table('ORG_EMPLOYEE')
            ->join('ORG_POSITION', 'ORG_EMPLOYEE.POS_ID', '=', 'ORG_POSITION.POS_ID')
            ->join('ORG_DEPARTMENT', 'ORG_EMPLOYEE.DEP_ID', '=', 'ORG_DEPARTMENT.DEP_ID')
            ->select('ORG_EMPLOYEE.*', 'ORG_POSITION.POS_NAME', 'ORG_DEPARTMENT.DEP_NAME')
            ->get();

        $departments = DB::table('ORG_DEPARTMENT')->get();
        $positions = DB::table('ORG_POSITION')->get();

        // Assuming STATUS is relevant for employees, not positions
        foreach ($employees as $employee) {
            if ($employee->STATUS == 'A') {
                $employee->STATUSVALUE = 'Идэвхитэй';
            } elseif ($employee->STATUS == 'N') {
                $employee->STATUSVALUE = 'Идэвхгүй';
            } else {
                $employee->STATUSVALUE = 'Unknown Status';
            }
        }

        return view('viewemployee', compact('employees', 'departments', 'positions'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'REGISTER' => 'required|string|regex:/^[A-Za-z]{2}[0-9]{8}$/|max:10',
            'FIRSTNAME' => 'required|string|regex:/^[^0-9]*$/|max:255',
            'LASTNAME' => 'required|string|regex:/^[^0-9]*$/|max:255',
            'POS_ID' => 'required|integer',
            'DEP_ID' => 'required|integer',
            'EMAIL' => 'required|string|email|max:255',
            'WORK_DATE' => 'required|date',
            'STATUS' => 'required|string|max:1',
            'BIRTHDATE' => 'required|date',
            'HANDPHONE' => 'required|string|regex:/^[6-9][0-9]{7}$/|max:8',
            'HOMEPHONE' => 'nullable|string|regex:/^[6-9][0-9]{7}$/|max:8',
            'WORKPHONE' => 'nullable|string|regex:/^[6-9][0-9]{7}$/|max:8',
            'SEX' => 'required|string|in:male,female',
            'PICTURE_LINK' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $employee = new OrgEmployee();
        $employee->fill($validatedData);
        $employee->PASS = bcrypt('default_password');
        $employee->FINGERID = 0;

        if ($request->hasFile('PICTURE_LINK')) {
            $file = $request->file('PICTURE_LINK');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('pictures', $filename, 'public');
            $employee->PICTURE_LINK = '/storage/' . $path;
        }

        $employee->save();

        return redirect()->back()->with('success', 'Employee added successfully');
    }

    public function edit($id)
    {
        $employee = OrgEmployee::findOrFail($id);

        if (request()->ajax()) {
            $departments = OrgDepartment::all();
            $positions = OrgPosition::all();

            return view('partials.editemployeeform', compact('employee', 'departments', 'positions'));
        }

        return redirect()->route('viewemployee')->with('error', 'Invalid request.');
    }

    public function update(Request $request)
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

    public function destroy($id)
    {
        DB::table('ORG_EMPLOYEE')->where('EMP_ID', $id)->delete();
        return redirect()->route('viewemployee')->with('success', 'Employee deleted successfully.');
    }
}