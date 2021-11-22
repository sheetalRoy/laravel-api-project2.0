<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Result;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Collection;

class ResultController extends Controller
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
        $existed = Result::where('key','=',$input['key'])->first();
        if($existed){
            return[
                "message" => "Record has existed",
                "success" => false,
                "status" => 201
            ];
        }else{
            $arr = [];
            $res = [];
            $bb = collect([1, 2, 3, 4, 5, 8])->avg();
            // $input['value'] = json_encode($input['value']);
            $str = json_encode($input['value']);
            $arr = json_decode($str, true);
            $collection = collect($arr)->toJson();
            echo $collection;die();
            // foreach($arr as $key => $data){
            //     // echo $data->id;
            //     $res[$key] = $data;
            // }
            // echo $res[0]["email"];die();
            $obj = new User();
            // $insert = User::create($res);
            // die();
            // var_dump($res);die();
            // $arr["value"]["id"];
            // echo 999;die();
            return[
                'data'=>$res
            ];
            // $input['value'] = json_decode($str, true);
            
    	    // $insert = Result::create($input);
            // $data['message'] =  'Record has saved successfully!';
            // $data['success'] = true;
            // $data['status'] = 200;
            // return $data; 
        }
        
    }

    public function updateResult($key, Request $request){
        
        $input = $request->all();
        $input['value'] = json_encode($input['value']);
        $obj = Result::where('key','=',$key)->first();
        if($obj){
            $validator = Validator::make($request->all(), [ 
                'value' => 'required',
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);            
            }
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
            $insert = Result::create($input);
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
        $results = Result::all();
        foreach($results as $data){
            $res[$data->key] = json_decode($data->value);
        }
        return [
            'data' => $res,
            'success' => true,
            'status' =>200
        ];
        // return [
        //     'data' => $results,
        //     'status' => 200
        // ];
    }
    public function result($id){
        $results = Result::find($id);
        if($results){
            $key = $results->key;
            $value = json_decode($results->value, true);
            return [
                    'key' => $key,
                    'value' => $value,
                    'success' => true,
                    'status' => 200
                ];
        }else{
            return [
                'value' => '',
                'success' => false,
                'status' => 200
            ];
        }
        // return response()->json(['res'=>$res]);
        
    }
    public function deleteInfo($key){
        // $info = Result::findOrFail($id);
        $obj = Result::where('key','=',$key)->first();
        $obj->delete();
        return [
            'status' => 200,
            'message' => 'Delete successfully'
        ];
    }
}
