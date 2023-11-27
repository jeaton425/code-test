<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class DashboardController extends Controller
{

        //TODO: 
        //Add Unit Tests
        //Clean code and Comments
        //Put on GitLabs
    
    //Get and displays all teachers for the spesific school
    public function index(){        

        $client = new \Wonde\Client(env('API_TOKEN'));

        //Assuming that the systems use-case is one school, otherwise you may want to have this so its set.
        $school = $client->school('A1930499544');

        $teachers = [];
        
        //Gets all employees at the school and adds them to the array
        foreach ($school->employees->all() as $employee) {
            $teachers = Arr::prepend($teachers, $employee);
        }
        //Sorts the teachers by Forename in alphabetical order
        $teachers = collect($teachers)->sortBy('forename')->toArray();
        return view('dashboard')->with(array('teachers'=>$teachers));
    }

    //Get and display Teachers classes by ID and going from the current time
    //Note: I'd originally intended to add a date picker and have it to allow the user to spesify the start of the week they wanted to see but have decided to keep it simple and just go off the current date. 
    public function getTeachersClasses($id){

        //Using Carbon to get current date
        //Ideally would pass in the date so the user could see any weeks classes
        $date = Carbon::today();

        //REMOVE AFTER TESTING
        $date->subDays(10);
        
        $client = new \Wonde\Client(env('API_TOKEN')); 
    
        $school = $client->school('A1930499544');

        //Outputs the header
        echo view('teacher-classes-header');

        //Loops for each day you want to see
        //Ideally you would pass a parameter though so the user could modify how many days they wanted to see ahead till
        for ($i = 0; $i <= 7; $i++){
            $classes = [];
            //Outputting Day Card div
            echo "<div class='w-full day-card p-1 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700'>".$date;
            //Finds classes where the related 'lesson' is after the current date (i.e in the future)
            foreach ($school->classes->all(['employees', 'lessons'], ['lessons_start_after' => $date]) as $class){
                if (isset($class->employees->data[0]) && ($class->employees->data[0]->id == $id) && $date->isSameDay($class->lessons->data[0]->start_at->date)){    
                    $classes = Arr::prepend($classes, $class);
                }
            }
            //Outputs the Day Cards (contains a forloop which will output each Class in a different card)
            echo view('teachers-classes')->with(array('classes'=>$classes));
            $date->addDays(1);
            //Close the Day Card div
            echo "</div>";
        }
        //Output the footer
        echo view('teacher-classes-footer');
    }

    //Get and display Students in a selected class
    public function getStudentsInClass($id){

        $client = new \Wonde\Client(env('API_TOKEN')); 
    
        $school = $client->school('A1930499544');

        $students = [];

        //Gets all students in a spesific class and adds them to the array
        foreach ($school->classes->all(['students'], ['mis_id' => $id]) as $class){
            $students = Arr::prepend($students, $class->students->data[0]);
        }
        //Sorts the students by Forename in alphabetical order
        $students = collect($students)->sortBy('forename')->toArray();
        return view('class-overview')->with(array('students'=>$students));
    }
}