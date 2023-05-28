<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Room::all();
        return view('room.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $roomtypes=RoomType::all();
        return view('room.create',['roomtypes'=>$roomtypes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $roomtype=new Room;
        $roomtype->titre=$request->input('titre');
        $roomtype->id_type=$request->rt_id;
        $roomtype->save();

        return redirect('admin/room/create')->with('success','Data has been added ');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data=Room::find($id);
        return view('room.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roomtypes=RoomType::all();
        $data=Room::find($id);
        return view('room.edit',['data'=>$data,'roomtypes'=>$roomtypes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=Room::find($id);
        $data->titre=$request->input('titre');
        $data->id_type=$request->rt_id;
        $data->save();
        return redirect('admin/room/'.$id.'/edit')->with('success','Data has been updated ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Room::where('id',$id)->delete();
        return redirect('admin/room')->with('success','Data has been deleted ');
    }
}
