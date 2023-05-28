<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Customer::all();
        return view('customer.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'mobile'=>'required',
        ]);
        $img=$request->file('photo');
        $newimg=uniqid().$img->getClientOriginalName();
        $img->move(public_path('upload/photos'),$newimg);
        $data=new Customer;
        $data->full_name=$request->full_name;
        $data->mobile=$request->mobile;
        $data->email=$request->email;
        $data->password=$request->password;
        $data->address=$request->address;
        $data->photo='upload/photos/'.$newimg;
        $data->save();

        return redirect('admin/customer/create')->with('success','Data has been added ');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data=Customer::find($id);
        return view('customer.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=Customer::find($id);
        return view('customer.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'full_name'=>'required',
            'email'=>'required|email',
            'mobile'=>'required',
        ]);

        $img=$request->file('photo');
        $newimg=uniqid().$img->getClientOriginalName();
        $img->move(public_path('upload/photos'),$newimg);
        $data=Customer::find($id);
        $data->full_name=$request->full_name;
        $data->mobile=$request->mobile;
        $data->email=$request->email;
        $data->photo='upload/photos/'.$newimg;
        $data->save();
        return redirect('admin/customer/'.$id.'/edit')->with('success','Data has been updated ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Customer::where('id',$id)->delete();
        return redirect('admin/customer')->with('success','Data has been deleted ');
    }
}
