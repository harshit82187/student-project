<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index(){
        $students = Student::all();
        return view('index', compact('students'));
    }

    public function register(Request $req){

        // dd($req->all());
        try{

            $req->validate([
                'name' => 'required|string',
                'fname' => 'required|string',
                'mobile_no' => 'required|digits:10',
                'email'   => 'required|email|unique:students,email',
                'dob'    => 'required|date',
            ]);

            $student = new Student();
            $student->name = $req->name;
            $student->fname = $req->fname;
            $student->mobile_no = $req->mobile_no;
            $student->email = $req->email;
            $student->dob = $req->dob;
            $student->save();
            return back()->with('success','Student Registration Successfully!');


        }catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        }catch(\Exception $e){
            return back()->with('error', 'Warning : ' .$e->getMessage());
        }
    }

    public function update(Request $req){
        // dd($req->all());

        try{

            $req->validate([
                'name' => 'required|string',
                'fname' => 'required|string',
                'dob'    => 'required|date',
            ]);

            $student = Student::findOrFail($req->id);
            $data = [
                'name' => $req->name,
                'fname' => $req->fname,
                'dob' => $req->dob,               
            ]; 
            
            if($req->email != $student->email){
                $req->validate([                   
                    'email'   => 'required|email|unique:students,email',
                ]);
                $data['email'] = $req->email;
            }

            if($req->mobile_no != $student->mobile_no){

                $req->validate([                   
                    'mobile_no' => 'required|digits:10|unique:students,mobile_no',
                ]);
                $data['mobile_no'] = $req->mobile_no;
            }

          
            $student->update($data);
            return back()->with('success','Student Details Update Successfully!');


        }catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        }catch(\Exception $e){
            return back()->with('error', 'Warning : ' .$e->getMessage());
        }
    }

    public function delete($id){
        $student = Student::find($id);
        if($student){
            $student->delete();
            return back()->with('success','Student Details Delete Successfully!');

        }else{
            return back()->with('error','Record Not Found!');
        }
    }
}
