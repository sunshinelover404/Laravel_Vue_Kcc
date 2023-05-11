<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Question;

class AskFormController extends Controller
{
     public function createask(Request $request)
     {
          $category = $request->input('cat');

          return view('askform.askform', ['category' => $category]);
     }
     public function storeask(Request $request)
     {
        
          $q_title = $request->input('title');
          $q_description = $request->input('description');
          $user = Auth::user('admin');
          $q_user = $user->id;
          $q_name = $user->name;
          $q_email = $user->email;
          $q_department = $user->departments;
          $q_program = $user->interests;


          $CreateQuestion = Question::create([
               'q_user' => $q_user,
               'q_name' => $q_name,
               'q_email' => $q_email,
               'q_department' => $q_department,
               'q_programe' => $q_program,
               'q_title' => $q_title,
               'q_description' => $q_description
          ]);
          if ($CreateQuestion->save()) {
              return redirect()->route('user.dashboard');
          } else {
               echo "failed";
          }
     }
}
