<?php

namespace App\Http\Controllers;

use App\Models\OrgEmployee;
use App\Models\OrgPosition;
use Illuminate\Http\Request;
use App\Models\OrgDepartment;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PlaceController extends Controller
{


    public function viewPlaces()
    {
        // Retrieve departments with basic details
        $departments = DB::table('ORG_DEPARTMENT')
            ->leftJoin('ORG_EMPLOYEE', 'ORG_DEPARTMENT.DIRECTOR_EMPID', '=', 'ORG_EMPLOYEE.EMP_ID')
            ->select(
                'ORG_DEPARTMENT.DEP_ID',
                'ORG_DEPARTMENT.DEP_NAME',
                'ORG_DEPARTMENT.STATUS',
                'ORG_DEPARTMENT.SORT_ORDER',
                'ORG_DEPARTMENT.PARENT_DEPID',
                'ORG_DEPARTMENT.DIRECTOR_EMPID',
                'ORG_DEPARTMENT.EDIT_DATE',
                'ORG_EMPLOYEE.FIRSTNAME as DIRECTOR_FIRSTNAME',
                'ORG_EMPLOYEE.LASTNAME as DIRECTOR_LASTNAME'
            )
            ->where('ORG_DEPARTMENT.STATUS', '!=', 'D') // Exclude deleted departments
            ->orderBy('ORG_DEPARTMENT.SORT_ORDER')
            ->get()
            ->toArray();
    
        foreach ($departments as $department) {
            if ($department->STATUS == 'A') {
                $department->STATUSVALUE = 'Идэвхитэй';
            } elseif ($department->STATUS == 'N') {
                $department->STATUSVALUE = 'Идэвхгүй';
            } else {
                $department->STATUSVALUE = 'Unknown Status';
            }
        }
    
        // Retrieve employees with concatenated name, position name, and department name
        $employees = DB::table('ORG_EMPLOYEE')
            ->select(
                'EMP_ID',
                DB::raw("CONCAT(FIRSTNAME, '.', LEFT(LASTNAME, 1)) AS EMPNAME"),
                'ORG_POSITION.POS_NAME',
                'ORG_DEPARTMENT.DEP_NAME'
            )
            ->join('ORG_DEPARTMENT', 'ORG_EMPLOYEE.DEP_ID', '=', 'ORG_DEPARTMENT.DEP_ID')
            ->join('ORG_POSITION', 'ORG_EMPLOYEE.POS_ID', '=', 'ORG_POSITION.POS_ID')
            ->where('ORG_EMPLOYEE.STATUS', '!=', 'D') // Exclude deleted employees
            ->orderBy('ORG_EMPLOYEE.DEP_ID')
            ->orderBy('ORG_EMPLOYEE.FIRSTNAME')
            ->get();
    
        // Build hierarchical department tree
        $departmentTree = $this->buildTree($departments);
    
        // Pass data to view
        return view('viewplace', [
            'departmentTree' => $departmentTree,
            'employees' => $employees,
            'departments' => $departments, // Adjusted variable name to avoid confusion
        ]);
    }
    

// Method to get places for DataTables
public function placeListTable(Request $request)
{
    $columns = [
        'DEP_NAME',
        'DIRECTOR',
        'STATUSVALUE',
        'SORT_ORDER',
        'EDIT_DATE'
    ];

    $query = DB::table('ORG_DEPARTMENT')
        ->leftJoin('ORG_EMPLOYEE', 'ORG_DEPARTMENT.DIRECTOR_EMPID', '=', 'ORG_EMPLOYEE.EMP_ID')
        ->select(
            'ORG_DEPARTMENT.DEP_ID',
            'ORG_DEPARTMENT.DEP_NAME',
            DB::raw("CONCAT(ORG_EMPLOYEE.FIRSTNAME, ' ', ORG_EMPLOYEE.LASTNAME) AS DIRECTOR"),
            'ORG_DEPARTMENT.STATUS',
            'ORG_DEPARTMENT.SORT_ORDER',
            'ORG_DEPARTMENT.EDIT_DATE',
            DB::raw("CASE 
                        WHEN ORG_DEPARTMENT.STATUS = 'A' THEN 'Идэвхитэй' 
                        WHEN ORG_DEPARTMENT.STATUS = 'N' THEN 'Идэвхгүй' 
                        ELSE 'Unknown Status' 
                     END AS STATUSVALUE")
        )
        ->where('ORG_DEPARTMENT.STATUS', '!=', 'D')
        ->orderBy('ORG_DEPARTMENT.SORT_ORDER');

    // Handle sorting
    if ($request->has('order') && $request->has('columns')) {
        $orderByColumn = $columns[$request->input('order.0.column')];
        $orderByDirection = $request->input('order.0.dir');
        $query->orderBy($orderByColumn, $orderByDirection);
    }

    return DataTables::of($query)
        ->addColumn('action', function ($row) {
            return '
                <form action="' . route('deleteplace', $row->DEP_ID) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger btn-xs" style="margin-left: 5px;">Устгах</button>
                </form>
                <button type="button" class="btn btn-success btn-xs" data-bs-toggle="modal" data-bs-target="#editPlaceModal" data-id="' . $row->DEP_ID . '">Засах</button>';
        })
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
}

    public function editplace($id)
    {
        $place = OrgDepartment::findOrFail($id);
    
        if (request()->ajax()) {
            $departments = DB::table('ORG_DEPARTMENT')
                ->select('DEP_ID', 'DEP_NAME')
                ->where('STATUS', '!=', 'D')
                ->get();
    
            $employees = DB::table('ORG_EMPLOYEE')
                ->select(
                    'EMP_ID',
                    DB::raw("CONCAT(FIRSTNAME, '.', LEFT(LASTNAME, 1)) AS EMPNAME"),
                    'ORG_POSITION.POS_NAME',
                    'ORG_DEPARTMENT.DEP_NAME'
                )
                ->join('ORG_DEPARTMENT', 'ORG_EMPLOYEE.DEP_ID', '=', 'ORG_DEPARTMENT.DEP_ID')
                ->join('ORG_POSITION', 'ORG_EMPLOYEE.POS_ID', '=', 'ORG_POSITION.POS_ID')
                ->where('ORG_EMPLOYEE.STATUS', '!=', 'D')
                ->get();
    
            return view('partials.editplaceform', compact('place', 'departments', 'employees'));
        }
    
        return redirect()->route('viewplace')->with('error', 'Invalid request.');
    }
    
    
    

    public function updateplace(Request $request, $id)
    {
        $place = OrgDepartment::findOrFail($id);

        $request->validate([
            'depName' => 'required|string|max:255',
            'status' => 'required|string|max:10',
            'sortOrder' => 'required|integer',
            'parentDepId' => 'required|integer',
            'directorEmpId' => 'required|integer',
        ]);

        $place->DEP_NAME = $request->depName;
        $place->STATUS = $request->status;
        $place->SORT_ORDER = $request->sortOrder;
        $place->PARENT_DEPID = $request->parentDepId;
        $place->DIRECTOR_EMPID = $request->directorEmpId;
        $place->APPROVE_EMPID = '9999';
        $place->EDIT_EMPID = '6666';
        $place->EDIT_DATE = now();

        $place->save();

        return redirect()->route('viewplace')->with('success', 'Department updated successfully!');
    }

  
    public function buildTree(array $elements, $parentId = null)
    {
        $branch = [];
        foreach ($elements as $element) {
            if ($element->PARENT_DEPID == $parentId) {
                $children = $this->buildTree($elements, $element->DEP_ID);
                if ($children) {
                    $element->children = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
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
        $place->status = 'D'; // Assuming 'D' represents deleted or deactivated status
        $place->save();

        return redirect()->route('viewplace');
    }
}