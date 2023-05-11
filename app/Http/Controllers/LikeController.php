<?php

namespace App\Http\Controllers;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request){
      
  
    $user= Auth::user('admin');
    $userid=$user->id;
    $result= Like::create([
         'q_id'=> $userid,
         'q_user'=> $request->q_user,
     ]);

    if($result){
        return response()->json( $request->q_user);
    }

    }
}
