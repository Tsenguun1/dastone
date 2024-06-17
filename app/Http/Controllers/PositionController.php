<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrgPosition;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    public function viewpositions()
    {
        $positions = DB::table('ORG_POSITION')
            ->select('POS_ID', 'POS_NAME', 'STATUS', 'SORT_ORDER', 'EDIT_DATE')
            ->where('STATUS', '!=', 'D')
            ->orderBy('SORT_ORDER')
            ->get();

        return view('viewposition', ['positions' => $positions]);
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
            $position->POS_NAME = $request->posName;
            $position->STATUS = $request->status;
            $position->SORT_ORDER = $request->sortOrder;
            $position->EDIT_DATE = now()->addHours(12);
            $position->EDIT_EMPID = '6666'; // Example editor ID

            $position->save();

            return redirect()->route('viewposition');
        }

        return view('addposition');
    }

    public function deleteposition($id)
    {
        $position = OrgPosition::findOrFail($id);
        $position->status = 'D'; // Assuming 'D' represents deleted or deactivated status
        $position->save();

        return redirect()->route('viewposition');
    }

    public function updateposition(Request $request)
    {
        $id = $request->input('posId');
        $position = OrgPosition::findOrFail($id);

        $request->validate([
            'posName' => 'required|string|max:255',
            'status' => 'required|string|max:10',
            'sortOrder' => 'required|integer',
        ]);

        $position->POS_NAME = $request->posName;
        $position->STATUS = $request->status;
        $position->SORT_ORDER = $request->sortOrder;
        $position->EDIT_DATE = now();
        $position->EDIT_EMPID = '6666'; // Example editor ID

        $position->save();

        return redirect()->route('viewposition');
    }
}
