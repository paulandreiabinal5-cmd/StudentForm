<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class studentcontroller extends Controller
{
    public function studentlist(){
        return view ('student');
    }

    public function studentinfo(){
        return view('student', ['id'=>'001', 
                                'name'=>'Euji Nueva', 
                                'courseyear'=>'BSIT3C'] );
    }


    public function studentarray(){
        $data = ['studentlist' => [
            ['id'=>'001', 'name'=>'Euji Nueva', 'courseyear'=>'BSIT3C'],
            ['id'=>'002', 'name'=>'Karsten Turalde', 'courseyear'=>'BSIT3C'],
            ['id'=>'003', 'name'=>'Kenji Turiano', 'courseyear'=>'BSIT3C'],
            ['id'=>'004', 'name'=>'Kevin Regino', 'courseyear'=>'BSIT3C'],
            ['id'=>'005', 'name'=>'Anrei Regalario', 'courseyear'=>'BSIT3C'],
        ]
        ];
  
        return view('student', $data);
    }

    public function studWith(){
        $student = [
            ['id'=>'001', 'name'=>'Euji Nueva', 'courseyear'=>'BSIT3C'],
            ['id'=>'002', 'name'=>'Karsten Turalde', 'courseyear'=>'BSIT3C'],
            ['id'=>'003', 'name'=>'Kenji Turiano', 'courseyear'=>'BSIT3C'],
            ['id'=>'004', 'name'=>'Kevin Regino', 'courseyear'=>'BSIT3C'],
            ['id'=>'005', 'name'=>'Andrei Regalario', 'courseyear'=>'BSIT3C'],
            ['id'=>'006', 'name'=>'Paul Abinal', 'courseyear'=>'BSIT3C'],

        ];
    
            return view ('student')->with('studentlist', $student);
    }

    public function studcompact(){
         $studentlist = [
             ['id'=>'001', 'name'=>'Euji Nueva', 'courseyear'=>'BSIT3C'],
            ['id'=>'002', 'name'=>'Karsten Turalde', 'courseyear'=>'BSIT3C'],
            ['id'=>'003', 'name'=>'Kenji Turiano', 'courseyear'=>'BSIT3C'],
            ['id'=>'004', 'name'=>'Kevin Regino', 'courseyear'=>'BSIT3C'],
            ['id'=>'005', 'name'=>'Andrei Regalario', 'courseyear'=>'BSIT3C'],
            ['id'=>'006', 'name'=>'Paul Abinal', 'courseyear'=>'BSIT3C'],
            ['id'=>'007', 'name'=>'Mark Laurence Taway', 'courseyear'=>'BSIT3C'],

        ];
        return view ('student', compact('studentlist'));
    }

    public function studmasterlist(Request $request){
         $studentlist = $request->session()->get('students',[]);
        $search = $request->input('search');
             if (!empty($search)) {
        $filtered = [];
             foreach ($studentlist as $student) {
             if (strpos(strtolower($student['name']), strtolower($search)) !== false) {
         $filtered[] = $student;
         }
     }
     $studentlist = $filtered;
     }
    return view('student', compact('studentlist'));
 }
    public function addstudent(Request $request){
        $request->validate([
            'id'=>'required',
            'name' =>'required',
            'courseyear' =>'required'
        ]);

        $studentlist = $request->session()->get('students',[]);

        $studentlist[]= [
            'id' => $request ->id,
            'name' =>$request ->name,
            'courseyear' => $request->courseyear,
        ];
        $request->session()->put('students', $studentlist);

        return redirect()->route('student.list');
    }
    public function editstudent(Request $request, $index) {
        $studentlist = $request->session()->get('students', []);
        if (!isset($studentlist[$index])) {
            return redirect()->route('student.list')->with('error', 'Student not found.');
        }
        $student = $studentlist[$index];
        return view('student_edit', compact('student', 'index'));
    }

    public function updatestudent(Request $request, $index) {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'courseyear' => 'required',
        ]);
     $studentlist = $request->session()->get('students', []);
         if (isset($studentlist[$index])) {
         $studentlist[$index] = [
             'id' => $request->id,
             'name' => $request->name,
             'courseyear' => $request->courseyear,
    ];
         $request->session()->put('students', $studentlist);
         }
             return redirect()->route('student.list')->with('success', 'Student updated successfully.');
    }
    public function deletestudent(Request $request, $index) {
        $studentlist = $request->session()->get('students', []);
        if (isset($studentlist[$index])) {
            unset($studentlist[$index]);
            $request->session()->put('students', array_values($studentlist)); // reindex array
        }
        return redirect()->route('student.list')->with('success', 'Student deleted successfully.');
    }
}
