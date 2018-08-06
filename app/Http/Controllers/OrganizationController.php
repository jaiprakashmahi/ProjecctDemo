<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Organization;
use App\User;
use Illuminate\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth;


class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizationData=[];
        $organizationData=Organization::all();
        return view('organization-add',['organizationData'=>$organizationData]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::User()->id >0)
        {
            $this->validate($request, [
                'description'=>'required',
                'organizationName'=> 'required|unique:organizations,organizationName'
            ]);

            $organizationName=Input::get('organizationName');
            $description=Input::get('description');
            $dataSave=new Organization();
            $dataSave->organizationName=$organizationName;
            $dataSave->description=$description;
            $dataSave->userId=Auth::User()->id;
            $dataSave->save();
            return redirect('add-organization')->with('success', 'organization Added Successfully');
        }
        else
        {
            return redirect('add-organization')->with('error', 'Not Valid user');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::User()->id >0)
        {
            $organizationData=[];
            $organizationData=Organization::all();
            $organizationDataEdit=Organization::findOrfail($id);
            return view('organization-edit',['organizationData'=>$organizationData,'organizationDataEdit'=>$organizationDataEdit]);
        }
        else
        {
            return redirect('add-organization')->with('error', 'Not Valid user');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(Auth::User()->id >0)
        {   $id=Input::get('id');
            $this->validate($request, [
                'description'=>'required',
                //'organizationName'=> 'required|unique:organizations,organizationName,id'.$id
            ]);

            $organizationName=Input::get('organizationName');
            $description=Input::get('description');
            $orgid=Input::get('id');

            $dataSave= Organization::findOrfail($orgid);
            $dataSave->organizationName=$organizationName;
            $dataSave->description=$description;
            $dataSave->userId=Auth::User()->id;
            $dataSave->save();
            return redirect('add-organization')->with('success', 'organization Edit Successfully');
        }
        else
        {
            return redirect('add-organization')->with('error', 'Not Valid user');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if(Auth::User()->id >0)
        {
        $organization = Organization::find($id);
        $organization->delete();
        return redirect('/add-organization')->with('success', 'organization has been deleted!!');
        }
        else
        {
            return redirect('/add-organization')->with('error', 'Invalid User!!');
        }
    }
}
