<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MerchFee;
use Illuminate\Support\Facades\DB;

class FeeController extends Controller
{
    public function showFeeDetails($id)
    {
        $fee = MerchFee::findOrFail($id);
        
        if ($fee->STATUS == 'A') {
            $fee->STATUSVALUE = 'Идэвхитэй';
        } elseif ($fee->STATUS == 'N') {
            $fee->STATUSVALUE = 'Идэвхгүй';
        } else {
            $fee->STATUSVALUE = 'Unknown Status';
        }
    
        if (request()->ajax()) {
            return view('partials.detailsFee', compact('fee'));
        }
    
        return redirect()->route('viewfees')->with('error', 'Invalid request.');
    }
    

    // Method to view the list of fees
    public function viewFees()
    {
        // Retrieve all fees where STATUS is not 'D'
        $fees = MerchFee::where('STATUS', '!=', 'D')
            ->orderBy('FEE_ID')
            ->get();
        foreach ($fees as $fee) {
            if ($fee->STATUS == 'A') {
                $fee->STATUSVALUE = 'Идэвхитэй';
            } elseif ($fee->STATUS == 'N') {
                $fee->STATUSVALUE = 'Идэвхгүй';
            } else {
                $fee->STATUSVALUE = 'Unknown Status';
            }
        }

        // Return the view with the fees data
        return view('viewFee', compact('fees'));
    }

    // Method to load the edit form for a specific fee
    public function editFee($id)
    {
        $fee = MerchFee::findOrFail($id);

        if (request()->ajax()) {
            return view('partials.editFeeform', compact('fee'));
        }

        return redirect()->route('viewfees')->with('error', 'Invalid request.');
    }

    // Method to update a fee
    public function updateFee(Request $request, $id)
    {
        $fee = MerchFee::findOrFail($id);
    
        // Validate request data
        $request->validate([
            'feeName' => 'required|string|max:500',
            'feeDescr' => 'nullable|string|max:1000',
            'feeType' => 'required|string|max:50',
            'feeOrder' => 'required|integer',
            'feeStatus' => 'required|string|max:1',
            'feeTXN' => 'required|string|max:200',
            'start_date' => 'required|date',
            'feesql' => 'required|string|max:1250',
        ]);
    
        // Update fee details
        $fee->FEE_NAME = $request->feeName;
        $fee->FEE_DESCR = $request->feeDescr;
        $fee->FEE_TYPE = $request->feeType;
        $fee->ORDER_NO = $request->feeOrder;
        $fee->STATUS = $request->feeStatus;
        $fee->TXN_DESC = $request->feeTXN;
        $fee->FEE_STARTDATE = $request->start_date;
        $fee->FEE_SQL = $request->feesql;
        $fee->UPDATE_EMPID = auth()->user()->id ?? '6666'; // Example for demo, replace with actual user ID
        $fee->UPDATE_DATE = now();
    
        // Save updated fee
        $fee->save();
    
        return redirect()->route('viewfees')->with('success', 'Fee updated successfully!');
    }
    

    // Method to load the add form and handle fee addition
    public function addFee(Request $request)
    {
        if ($request->isMethod('post')) {
            // Validate request data
            $request->validate([
                'feeName' => 'required|string|max:500',
                'feeDescr' => 'nullable|string|max:1000',
                'feeType' => 'required|string|max:50',
                'feeOrder' => 'required|integer',
                'feeStatus' => 'required|string|max:1',
                'feeTXN' => 'required|string|max:200',
                'start_date' => 'required|date',
                'feesql' => 'required|string|max:1250',
            ]);
    
            // Create new fee
            $fee = new MerchFee();
            $fee->FEE_NAME = $request->feeName;
            $fee->FEE_DESCR = $request->feeDescr;
            $fee->FEE_TYPE = $request->feeType;
            $fee->ORDER_NO = $request->feeOrder;
            $fee->STATUS = $request->feeStatus;
            $fee->TXN_DESC = $request->feeTXN;
            $fee->FEE_STARTDATE = $request->start_date;
            $fee->FEE_SQL = $request->feesql;
            $fee->UPDATE_EMPID = auth()->user()->id ?? '6666'; // Example for demo, replace with actual user ID
            $fee->UPDATE_DATE = now();
    
            // Save new fee
            $fee->save();
    
            return redirect()->route('viewfees')->with('success', 'Fee added successfully!');
        }
    
        return view('modal.addfee');
    }
    

    // Method to delete a fee
    public function deleteFee($id)
    {
        $fee = MerchFee::findOrFail($id);
        $fee->STATUS = 'D'; // Set status to 'D' for deletion/deactivation
        $fee->save();

        return redirect()->route('viewfees')->with('success', 'Fee deleted successfully!');
    }
}
