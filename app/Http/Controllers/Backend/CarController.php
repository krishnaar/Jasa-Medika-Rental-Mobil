<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\RentCar;
use DB, Validator, Auth, Str;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $car = Car::all();
        return view( 'backend.car.index', compact('car') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view( 'backend.car.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         try {
            $validator = Validator::make($request->all(), [
                'merk' => 'required',
                'model' => 'required',
                'plat' => 'required',
                'rate' => 'required',
            ]);
            
            if ($validator->fails()) {
                // return $validator->fails();
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            if($request->hasFile("file")) {
                $path = public_path("uploads/car/");
                if(!is_dir($path)) {
                    mkdir($path,755,true);
                }
                $image = $request->file('file');
                $newName = "image_".date("YmdHis").Str::random(5).".".$image->getClientOriginalExtension();
                $move = $image->move($path,$newName);
                $request['image'] = $newName;
            }else {
                $request['image'] = null;
            }
            // return $request;
            $car = Car::create(
                [
                'merk' => $request->merk,
                'model' => $request->model,
                'plat' => $request->plat,
                'rate' => $request->rate,
                'image' => $request->image,
            ]);
            DB::commit();
            return redirect('admin/car')->with('status', 'Data berhasil ditambah');

        } catch (Exception $e) {
            DB::rollback();
            return back()->with('status', 'Oops something went wrong :(');
        }
    }

    /**
     * Display the specified resource.
     */
    public function detail(string $id)
    {
        $car = Car::find($id);
        if (!empty($car->rent[0])) {
            if ($car->rent[0]->status == "Disetujui" || $car->rent[0]->status == "Menunggu Persetujuan") {
                $status = "Tidak Tersedia";
            }else{
                $status = "Tersedia";
            }
        }else {
            $status = "Tersedia";
        }
        return view( 'backend.car.detail', compact('car', 'status') );
    }

      /**
     * Store a newly created resource in storage.
     */
    public function rent(Request $request, $id)
    {
         try {
            $validator = Validator::make($request->all(), [
                'from_date' => 'required',
                'to_date' => 'required',
            ]);
            
            if ($validator->fails()) {
                // return $validator->fails();
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }
            $car = Car::find($id);
            $date1=date_create($request->from_date);
            $date2=date_create($request->to_date);
            $diff=date_diff($date1,$date2);
            $fee = $car->rate * ($diff->format("%a") + 1);
            // return $diff->format("%a");
            $car = RentCar::create(
                [
                'user_id' => Auth::user()->id,
                'car_id' => $id,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'fee' => $fee,
                'status' => "Menunggu Persetujuan",
            ]);
            DB::commit();
            return redirect()->back()->with('status', 'Data berhasil ditambah');

        } catch (Exception $e) {
            DB::rollback();
            return back()->with('status', 'Oops something went wrong :(');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $car = Car::find($id);
        // return $array_data->value[1];
        return view( 'backend.car.edit', compact('car') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
             $validator = Validator::make($request->all(), [
                'merk' => 'required',
                'model' => 'required',
                'plat' => 'required',
                'rate' => 'required',
            ]);
            
            if ($validator->fails()) {
                // return $validator->fails();
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }
           $findcurrent = Car::find($id);
            // return $request;
            $car = $findcurrent->update(
                [
                'merk' => $request->merk,
                'model' => $request->model,
                'plat' => $request->plat,
                'rate' => $request->rate,
            ]);
            
           
            DB::commit();
            return redirect('admin/car')->with('status', 'Data berhasil diedit');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('status', 'Oops something went wrong :(');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         DB::beginTransaction();
        try {
            $car = Car::find($id);
            $car->delete();

            DB::commit();
            return redirect()->route('admin.car.index')->with('status', 'Data berhasil dihapus');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('status', 'Oops something went wrong :(');
        }
    }
}
