<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userdata;
// use App\Http\Controllers\userRegisteration\generateName;
use Illuminate\Support\Facades\Storage;
class UserRegisteration extends Controller
{
    // public function generateName(Request $req){
    
    //     if($req->hasFile('userImage')){
    //         $name=$req->file('userImage',PATHINFO_FILENAME);
    //         $extension=$req->file('userImage')->extension();
    //         $newName=$name.'_'.time().$extension();
        
    //     }
    //     else{
    //         return 'noimage.jpg';
    //     }
    //     return $newName;
    // }
    
    public function register( Request $req)
    {
        $newName;
        if($req->hasFile('userImage')){
            $file= $req->file('userImage');
            $orignalName=$req->file('userImage')->getClientOriginalName();
            $name=pathinfo($orignalName,PATHINFO_FILENAME);
            $extension=$req->file('userImage')->extension();
            $newName=time().'_'.$name.'.'.$extension;
            // $path=$req->file('userImage')->storeAs('public/upload_Images',$newName);
            $file->move('uploads/appsetting/', $newName);
        }
        else{
            $newName= 'noimage.jpg';
        }
        

        $userdata= new userdata;
        $userdata->user_email=$req->email;
        $userdata->user_pass=$req->password;
        $userdata->user_address= $req->address;
        $userdata->user_address_2=$req->address_2;
        $userdata->user_state= $req->state;
        $userdata->user_city= $req->city;
        $userdata->user_zip= $req->zip;
        $userdata->user_dataFile=$newName;
        $userdata->save();
        return redirect('/');
        
        
        // return $req->all();
    }

    public function show()
    {
       $data= userdata::all();
       return view('show',['data'=>$data]);
    }


    public function update(Request $req, $id)
    {
        $userdata= userdata::find($id);
        $userdata->user_email=$req->email;
        $userdata->user_pass=$req->password;
        $userdata->user_address= $req->address;
        $userdata->user_address_2=$req->address_2;
        $userdata->user_state= $req->state;
        $userdata->user_city= $req->city;
        $userdata->user_zip= $req->zip;
        $userdata->save();
        return redirect('show');
    }

    public function delete($id)
    {
        $userdata=userdata::find($id);
        $userdata->delete();
        return redirect('show');
    }

}
