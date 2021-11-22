<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Score;
use App\Logintrack;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
    public function store(Request $request){
        $data = [];
        $validator = Validator::make($request->all(), [ 
            'key' => 'required', 
            'value' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all();
        $existed = Score::where('key','=',$input['key'])->first();
        if($existed){
            return[
                "message" => "Record has existed",
                "success" => false,
                "status" => 201
            ];
        }else{
           // $input['value'] = json_encode($input['value']);
            $str = json_encode($input['value']);
            $input['value'] = json_decode($str, true);
    	    $insert = Score::create($input);
            $data['message'] =  'Record has saved successfully!';
            $data['success'] = true;
            $data['status'] = 200;
            return $data; 
        }
        
    }

    public function updateResult($key, Request $request){
        $input = $request->all();
        $validator = Validator::make($request->all(), [ 
            'value' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $str = json_encode($input['value']);
        $input['value'] = json_decode($str, true);
        
        // $input['value'] = json_encode($input['value']);
        $obj = Score::where('key','=',$key)->first();
        if($obj){
            
            $obj->update(['value' => $input['value']]);
            return[
                'data' => $obj,
                'message' => 'Record has updated successfully!',
                'success' => true,
                'status' => 200
            ];
        }else{
            $validator = Validator::make($request->all(), [ 
                'key' => 'required', 
                'value' => 'required',
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);            
            }
            $insert = Score::create($input);
            return[
                'data' => $insert,
                'message' => 'Record has saved successfully!',
                'success' => true,
                'status' => 200
            ];
           
        }
         
    }
    
    public function getResult(){
        $res = [];
        $results = Score::all();
        if(!is_null($results)){
            foreach($results as $data){
                $res[$data->key] = json_decode($data->value);
            }
        }
        
        return [
            'data' => $res,
            'success' => true,
            'status' =>200
        ];
        
    }
    public function result($key){
        // $results = Score::find($id);
        $data = [];
        $results = Score::where('key','=',$key)->first();
        if($results){
            $data["key"] = $results->key;
            $data["value"] = json_decode($results->value, true);
            return [
                    'data' => $data,
                    // 'value' => $value,
                    'success' => true,
                    'status' => 200
                ];
        }else{
            return [
                'value' => '',
                'success' => false,
                'status' => 401
            ];
        }
        
    }
    /** veeva login */
    public function veevaLogin(Request $request){
        $veeva_id = $request->veeva_id;
        $validator = Validator::make($request->all(), [ 
            'veeva_id' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $verify = Score::where('key','=',$veeva_id)->first();
        if ($verify != null) {
            $res = Logintrack::where('veeva_id','=',$veeva_id)->first();
            if($res == null){
                $res = new Logintrack;
            }
            $res->veeva_id = $veeva_id;
            $res->active = 1;
            $res->save();
            return [
                'message' => 'Login success!',
                'success' => true,
                'status' => 201
            ];
        }else{
            return [
                'message' => 'Veeva Id is not authorized',
                'success' => false,
                'status' => 401
            ];
        }
        
    }
    public function deleteResult($key){
        $results = Score::where('key','=',$key)->first();
        // $info = Score::findOrFail($id);
        $results->delete();
        return [
            'status' => 200,
            'message' => 'Delete successfully'
        ];
    }
    public function truncateData(){
        Score::truncate();
        return [
            'message' => 'All the record are deleted!',
            'status' => 200,
            'success' => true
        ];
    }
}
