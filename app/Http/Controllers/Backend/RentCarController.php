<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentCar;
use DB, Validator;
use Auth;
class RentCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role_id == 1) {
            $rent = RentCar::all();
        }else{
            $rent = RentCar::where('user_id', Auth::user()->role_id)->get();

        }
        
        return view( 'backend.rentcar.index', compact('rent') );
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
             $validator = Validator::make($request->all(), [
                'status' => 'required',
            ]);
            
            if ($validator->fails()) {
                // return $validator->fails();
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }
           $findcurrent = RentCar::find($id);
           if ($request->status == "Dikembalikan") {
                $return_date = Date('Y-m-d');

                $date1=date_create($findcurrent->from_date);
                $date2=date_create(Date('Y-m-d'));
                $diff=date_diff($date1,$date2);
                $fee = $findcurrent->car->rate * ($diff->format("%a") + 1);

           }else {
                $return_date = $findcurrent->return_date;
                $fee = null;
           }
            $car = $findcurrent->update(
                [
                'status' => $request->status,
                'return_date' => $return_date,
                'total_fee' => $fee,

            ]);
            
           
            DB::commit();
            return redirect('admin/rentcar')->with('status', 'Status berhasil diubah');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('status', 'Oops something went wrong :(');
        }
    }

    
}
