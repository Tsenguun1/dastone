<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrgDepartment;
use App\Models\OrgEmployee;
use App\Models\OrgPosition;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
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
}