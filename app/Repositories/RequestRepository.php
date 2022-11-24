<?php
namespace App\Repositories;

use App\Contracts\RequestContract;
use App\Models\Request;
use App\Models\User;
use Auth;

class RequestRepository implements RequestContract
{
    public function getSuggession($request){
        $data=[];
        $sender_ids = Request::where('receiver_id','=',Auth::user()->id)->groupBy('sender_id')->pluck('sender_id');
        $receiver_ids = Request::where('sender_id','=',Auth::user()->id)->groupBy('receiver_id')->pluck('receiver_id');
        $data['data'] =  User::where('id','!=',Auth::user()->id)
        ->whereNotIn('id',$sender_ids)->whereNotIn('id',$receiver_ids)->skip($request->offset)->take($request->limit)->get();
        $data['count'] = User::where('id','!=',Auth::user()->id)
        ->whereNotIn('id',$sender_ids)->whereNotIn('id',$receiver_ids)->count();
        return $data;
    }
    public function getSentRequest($request){
        $data=[];
        $data['data'] = Request::with('receiver:id,name,email')->where('sender_id',Auth::user()->id)->where('status','requested')->skip($request->offset)->take($request->limit)->get();
        $data['count'] = Request::with('receiver:id,name,email')->where('sender_id',Auth::user()->id)->where('status','requested')->count();
        return $data;
    }
    public function getReceiveRequest($request){
        $data=[];
        $data['data'] = Request::with('sender:id,name,email')->where('receiver_id',Auth::user()->id)->where('status','requested')->skip($request->offset)->take($request->limit)->get();
        $data['count'] = Request::with('sender:id,name,email')->where('receiver_id',Auth::user()->id)->where('status','requested')->count();
        return $data;
    }
    public function getConnectedRequest($request){
        $data=[];
        $common =[]; 
        $data['data'] = Request::with('sender:id,name,email','receiver:id,name,email')->where('status','accepted')
        ->where(function ($query) {
            $query->where('receiver_id',Auth::user()->id)
                  ->orWhere('sender_id',Auth::user()->id);
        })->skip($request->offset)->take($request->limit)->get();
        $data['count'] = Request::with('sender:id,name,email','receiver:id,name,email')->where('status','accepted')
        ->where(function ($query) {
            $query->where('receiver_id',Auth::user()->id)
                  ->orWhere('sender_id',Auth::user()->id);
        })->count();

        
        $auth_connection = $this->common(Auth::user()->id);
        foreach($auth_connection as $key=>$conn){
            
            array_push($common,$this->common_connection($auth_connection,$conn)) ;
             
        }
        foreach($data['data'] as $key=> $final){
            $final->common_user = $common;
        }
        return $data;
    }
    public function common_connection($auth_connection=null,$con){
        if($auth_connection==null){
            $auth_connection = $this->common(Auth::user()->id);
        }
       $comm_connection = [];
        $conn = $this->common($con);
        foreach($conn as $connections){
            if(in_array($connections,$auth_connection)){
                $user_val = User::find($connections);
                array_push($comm_connection,$user_val);
            }
        }  
        return $comm_connection;
    }
    public function common($user_id){
        $connection_arr = [];

        $user_data = Request::with('sender:id,name,email','receiver:id,name,email')->where('status','accepted')
        ->where(function ($query) use($user_id) {
            $query->where('receiver_id',$user_id)
                  ->orWhere('sender_id',$user_id);
        })->get();

        foreach($user_data as $connection){
            if($connection->sender_id == $user_id){
                array_push($connection_arr, $connection->receiver_id);
            }
            else{
                array_push($connection_arr,$connection->sender_id);
            }
        }
            return $connection_arr;
    }
    public function connectionRequest($request){
        $sentRequest = new Request;
        $sentRequest->sender_id = $request->userId;
        $sentRequest->receiver_id = $request->suggesstionId;
        $sentRequest->status = 'requested';
        $sentRequest->save();
        return $sentRequest;
    }
    public function withdrawRequest($request){
        $withdrawRequest = Request::find($request->id);
        $withdrawRequest->delete();
        return $withdrawRequest;
    }
    public function acceptRequest($request){
        $acceptRequest = Request::find($request->id);
        $acceptRequest->status = 'accepted';
        $acceptRequest->save();
        return $acceptRequest;
    }
    public function cancelRequest($request){
        $cancelRequest = Request::find($request->id);
        $cancelRequest->status = 'cancel';
        $cancelRequest->delete();
        return $cancelRequest;
    }
}