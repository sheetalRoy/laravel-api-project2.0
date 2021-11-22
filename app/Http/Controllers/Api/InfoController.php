<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Information;
use App\Result;
use Illuminate\Support\Facades\Auth;
use Validator;

class InfoController extends Controller
{
    public function getInfos(){
        $info = Information::paginate(50);
        return [
            'data' => $info,
            'success' => true,
            'message' => "Success",
            'status' => 200
        ]; 
    }
	/* Get All Data */
    public function getAllInfos(){
        $info = Information::all();
        return [
            'data' => $info,
            'success' => true,
            'message' => "Success",
            'status' => 200
        ]; 
    }
    public function getInfo($id){
        $info = [];
        $info = Information::find($id);
        if($info){
            return [
                'data' => $info,
                'success' => true,
                'message' => "Success",
                'status' => 200
            ]; 
        }else{
            return [
                'data' => $info,
                'success' =>false,
                'status' => 201,
                'message' => "No Record"
            ];    
        }
        
    }
    public function saveInfo(Request $request){
        $data = [];
        $validator = Validator::make($request->all(), [ 
            'name' => 'required|regex:/^[a-zA-Z\s]+$/', 
            'vorname' => 'required|regex:/^[a-zA-Z\s]+$/',
            'strasse' => 'required',
            'ort' => 'required',
            'land' => 'required',
            'plz' => 'numeric',
            'e_mail_adresse' => 'email:rfc',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all();
        // $input['value'] = json_encode($input['value']);
    	$insert = Information::create($input);
        if($insert){
            $data['message'] =  'Record added';   
            return[
                "message" => "Record has saved successfully!",
                "success" => true,
                "status" => 200
            ]; 
        }else{
            return[
                "message" => "Record not added!",
                "success" => false,
                "status" => 201
            ]; 
        }
       
        // return response()->json(['data'=>$data], 200); 
    }
	 
    public function updateInfo($id, Request $request){
        $validator = Validator::make($request->all(), [ 
            'name' => 'required|regex:/^[a-zA-Z]+$/u', 
            'vorname' => 'required|regex:/^[a-zA-Z]+$/u',
            'strasse' => 'required',
            'ort' => 'required',
            'land' => 'required',
            'plz' => 'numeric',
            'e_mail_adresse' => 'email:rfc',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all();
        // $input['value'] = json_encode($input['value']);
        $obj = Information::find($id);
        if($obj){
            $obj->update($input);
            return[
                "data" => $obj,
                "message" => "Record has updated successfully!",
                "success" => true,
                "status" => 200
            ];
        }else{
            $insert = Information::create($input);
            return[
                "message" => "Record has saved successfully!",
                "success" => true,
                "status" => 200
            ]; 
        }     
    }
    /* Search */
    public function searchInfo(Request $request){
        $input = $request->all();
        $from = $request->input('from');
        $to = $request->input('to');
        $fromD = date($from);
        $dateTo = date($to);
        // $d->format('dd/mm/Y')
    //    $obj = Information::whereBetween('created_at', ['2021-08-18','2021-08-19'])
    //     ->get();
        $obj = Information::whereDate('created_at','>=', $fromD)
            ->whereDate('created_at','<=', $to)
            ->get();
        return [
            'data' => $obj
        ];
    }

    public function deleteInfo($id){
        $info = Information::findOrFail($id);
        $info->delete();
        return [
            'status' => 200,
            'message' => 'Delete successfully'
        ];
    }
}
