<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings=Reservation::all();
        return view('reservation.index',['data'=>$bookings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms=DB::SELECT("SELECT * FROM rooms WHERE reserver=0" );
        $customers=Customer::all();
        return view('reservation.create',['data'=>$customers,'rooms'=>$rooms]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id'=>'required',
            'room_id'=>'required',
            'checkin_date'=>'required',
            'checkout_date'=>'required',
            'total_adults'=>'required',
        ]);
        $data=  new Reservation;
        $data->customer_id=$request->customer_id;
        $data->room_id=$request->room_id;
        $data->checkin_date=$request->checkin_date;
        $data->checkout_date=$request->checkout_date;
        $data->total_adults=$request->total_adults;
        $data->total_children=$request->total_children;
        $data->save();
        $d=Room::find($data->room_id);
        $d->reserver=1;
        $d->save();
        return redirect('admin/reservation/create')->with('success','Data has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data=Reservation::find($id);
        $d=Room::find($data->room_id);
        $d->reserver=0;
        $d->save();
        Reservation::where('id',$id)->delete();
        return redirect('admin/reservation')->with('success','Data has been deleted ');
        
    }
}
