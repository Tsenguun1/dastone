<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrgDepartment;
use App\Models\OrgEmployee;
use App\Models\OrgPosition;
use Illuminate\Support\Facades\DB;

class NewController extends Controller
{
    public function viewPlaces()
{
    $departments = DB::table('ORG_DEPARTMENT')
        ->select('DEP_ID', 'DEP_NAME', 'STATUS', 'SORT_ORDER', 'PARENT_DEPID', 'DIRECTOR_EMPID', 'APPROVE_EMPID', 'EDIT_EMPID', 'EDIT_DATE')
        ->where('STATUS', '!=', 'D')
        ->orderBy('SORT_ORDER')
        ->get();

    $employees = DB::table('ORG_EMPLOYEE')
        ->select(
            'ORG_EMPLOYEE.EMP_ID',
            DB::raw("CONCAT(ORG_EMPLOYEE.FIRSTNAME, '.', LEFT(ORG_EMPLOYEE.LASTNAME, 1)) AS EMPNAME"),
            'ORG_POSITION.POS_NAME',
            'ORG_DEPARTMENT.DEP_NAME'
        )
        ->join('ORG_DEPARTMENT', 'ORG_EMPLOYEE.DEP_ID', '=', 'ORG_DEPARTMENT.DEP_ID')
        ->join('ORG_POSITION', 'ORG_EMPLOYEE.POS_ID', '=', 'ORG_POSITION.POS_ID')
        ->where('ORG_EMPLOYEE.STATUS', '!=', 'D')
        ->orderBy('ORG_EMPLOYEE.DEP_ID')
        ->orderBy('ORG_EMPLOYEE.FIRSTNAME')
        ->get();

    return view('viewplace', ['departments' => $departments, 'employees' => $employees]);
}

    public function viewAddPlaceForm()
{
    $departments = OrgDepartment::all();
    $employees = OrgEmployee::where('STATUS', '!=', 'D')->orderBy('DEP_ID')->orderBy('FIRSTNAME')->get();

    return view('modal.addplace', compact('departments', 'employees'));
}   

    public function viewemployee()
    {
        return view('viewemployee');
    }

    public function addFormemployee(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'reg_number' => 'required|string|max:255',
                'position' => 'required|integer',
                'email' => 'required|email|max:255',
                'phone_number' => 'required|string|max:20',
                'gender' => 'required|string|max:10',
                'birth_date' => 'required|date',
                'start_date' => 'required|date',
                'home_number' => 'nullable|string|max:20',
                'work_number' => 'nullable|string|max:20',
                'photo' => 'nullable|string|max:255',
                'state' => 'required|string|max:10',
                'place' => 'required|integer',
            ]);

            $employee = new OrgEmployee();
            $employee->register = $request->reg_number;
            $employee->firstname = $request->first_name;
            $employee->lastname = $request->last_name;
            $employee->pos_id = $request->position;
            $employee->dep_id = $request->place;
            $employee->email = $request->email;
            $employee->pass = 'pass'; // Consider encrypting passwords
            $employee->work_date = $request->start_date;
            $employee->status = $request->state;
            $employee->birthdate = $request->birth_date;
            $employee->handphone = $request->phone_number;
            $employee->homephone = $request->home_number;
            $employee->workphone = $request->work_number;
            $employee->fingerid = '12345678';
            $employee->sex = $request->gender;
            $employee->picture_link = $request->photo;
            $employee->edit_date = now();
            $employee->edit_empid = '6666';
            $employee->pass_date = now();
            $employee->pass_expire_term = '3';
            $employee->pass_enddate = now();
            $employee->last_logindate = now();

            $employee->save();

            return redirect()->route('viewemployee');
        }

        return view('addFormemployee');
    }

    public function deleteemployee($id)
    {
        $employee = OrgEmployee::findOrFail($id);
        $employee->delete();

        return redirect()->route('viewemployee');
    }

    public function viewposition()
    {
        return view('viewposition');
    }

    public function addFormpos(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'posName' => 'required|string|max:255',
                'status' => 'required|string|max:10',
                'sortOrder' => 'required|integer',
            ]);

            $position = new OrgPosition();
            $position->pos_name = $request->posName;
            $position->status = $request->status;
            $position->edit_date = now();
            $position->edit_empid = '6666';
            $position->sort_order = $request->sortOrder;

            $position->save();

            return redirect()->route('viewposition');
        }

        return view('addFormpos');
    }

    public function deleteposition($id)
    {
        $position = OrgPosition::findOrFail($id);
        $position->delete();

        return redirect()->route('viewposition');
    }

    public function viewplace()
    {
        return view('viewplace');
    }


 public function addForm(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'depName' => 'required|string|max:255',
                'status' => 'required|string|max:10',
                'sortOrder' => 'nullable|integer', // Make sure 'sortOrder' can be nullable if not required
                'parentDepId' => 'required|integer',
                'directorEmpId' => 'required|integer',
            ]);

            $department = new OrgDepartment();
            $department->dep_name = $request->depName;
            $department->status = $request->status;
            $department->sort_order = $request->sortOrder ?? 0; // Default to 0 if not provided
            $department->parent_depid = $request->parentDepId;
            $department->director_empid = $request->directorEmpId;
            $department->approve_empid = '9999';
            $department->edit_empid = '6666';
            $department->edit_date = now();

            $department->save();

            return redirect()->route('viewplace');
        }

        // Load necessary data for the form if needed
        $departments = OrgDepartment::all();
        $employees = OrgEmployee::all();
        
        return view('addForm', compact('departments', 'employees'));
    }



    public function deleteplace($id)
    {
        $place = OrgDepartment::findOrFail($id);
        $place->delete();

        return redirect()->route('viewplace');
    }

    public function updateplace(Request $request)
    {
        $id = $request->input('depId');
        $place = OrgDepartment::findOrFail($id);
    
        $request->validate([
            'depName' => 'required|string|max:255',
            'status' => 'required|string|max:10',
            'sortOrder' => 'required|integer',
            'parentDepId' => 'required|integer',
            'directorEmpId' => 'required|integer',
        ]);
    
        $place->dep_name = $request->depName;
        $place->status = $request->status;
        $place->sort_order = $request->sortOrder;
        $place->parent_depid = $request->parentDepId;
        $place->director_empid = $request->directorEmpId;
        $place->approve_empid = '9999';
        $place->edit_empid = '6666';
        $place->edit_date = now();
    
        $place->save();
    
        return redirect()->route('viewplace')->with('success', 'Department updated successfully!');
    }
    
    

    public function updateposition(Request $request, $id)
    {
        $position = OrgPosition::findOrFail($id);

        if ($request->isMethod('post')) {
            $request->validate([
                'posName' => 'required|string|max:255',
                'status' => 'required|string|max:10',
                'sortOrder' => 'required|integer',
            ]);

            $position->pos_name = $request->posName;
            $position->status = $request->status;
            $position->edit_date = now();
            $position->edit_empid = '6666';
            $position->sort_order = $request->sortOrder;

            $position->save();

            return redirect()->route('viewposition');
        }

        return view('updateposition', compact('position'));
    }

    public function updateemployee(Request $request, $id)
    {
        $employee = OrgEmployee::findOrFail($id);

        if ($request->isMethod('post')) {
            $request->validate([
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'reg_number' => 'required|string|max:255',
                'position' => 'required|integer',
                'email' => 'required|email|max:255',
                'phone_number' => 'required|string|max:20',
                'gender' => 'required|string|max:10',
                'birth_date' => 'required|date',
                'start_date' => 'required|date',
                'home_number' => 'nullable|string|max:20',
                'work_number' => 'nullable|string|max:20',
                'photo' => 'nullable|string|max:255',
                'state' => 'required|string|max:10',
                'place' => 'required|integer',
            ]);

            $employee->register = $request->reg_number;
            $employee->firstname = $request->first_name;
            $employee->lastname = $request->last_name;
            $employee->pos_id = $request->position;
            $employee->dep_id = $request->place;
            $employee->email = $request->email;
            $employee->pass = 'pass'; // Consider encrypting passwords
            $employee->work_date = $request->start_date;
            $employee->status = $request->state;
            $employee->birthdate = $request->birth_date;
            $employee->handphone = $request->phone_number;
            $employee->homephone = $request->home_number;
            $employee->workphone = $request->work_number;
            $employee->fingerid = '12345678';
            $employee->sex = $request->gender;
            $employee->picture_link = $request->photo;
            $employee->edit_date = now();
            $employee->edit_empid = '6666';
            $employee->pass_date = now();
            $employee->pass_expire_term = '3';
            $employee->pass_enddate = now();
            $employee->last_logindate = now();

            $employee->save();

            return redirect()->route('viewemployee');
        }

        return view('updateemployee', compact('employee'));
    }
}
