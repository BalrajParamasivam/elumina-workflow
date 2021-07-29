<?php

namespace App\Http\Controllers;

use View;

use App\Register;
use Illuminate\Http\Request;

use Workflow;

use App\Events\RegisterStatusUpdateEvent;

use Illuminate\Support\Facades\Mail;
use App\Mail\Registered;

use Illuminate\Support\Facades\Auth;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //get all the record
        $data = Register::all();

        //return value
        return View::make('register.form')->with('register',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //laravel validator
        $validator = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'date_of_birth' => 'required',
            ],[
                    'firstname.required' => 'FirstName is required',

                    'lastname.required' => 'LastName is required',

                    'email.required' => 'Email is required ',

                    'date_of_birth.required' => 'DateOfBirth is required ',
                ]


          );

          //request values
          $firstname=$request->input('firstname');
          $lastname=$request->input('lastname');
          $email=$request->input('email');
          $date_of_birth=date('Y-m-d',strtotime($request->input('date_of_birth')));

          //new register
            $register = Register::create([
			'firstname' => $firstname,
			'lastname' => $lastname,
			'email' => $email,
			'dateofbirth' => $date_of_birth,
			'status' => 'draft',
		]);

        //response
        return redirect('/')->with('response','added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function show(Register $register)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function edit(Register $register)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Register $register)
    {
        //get status
        $status=$request->status;

        //workflow
        $workflow = Workflow::get($register);

        $workflowchange= $workflow->can($register, $status); // True

        if($workflowchange==true){

        // Apply a transition
        $workflow->apply($register, $status);
        $register->save(); // Don't forget to persist the state

        //success response
        $response="success";

        //message
        $message=" Updated Successfully";

         // call our event here
       event(new RegisterStatusUpdateEvent($register));

        //mail funtion
        }
        else
        {
        //failed response
        $response="failed";
        $trans=' ';
            // Get the post transitions
        foreach ($register->workflow_transitions() as $transition) {
            $trans.=$transition->getName().' ';
        }

        //message
        $message="Available Transitions Are:".$trans;

        }



        //collect all records
        $data = Register::all();

        //return response
        return redirect('/')->with(['register'=>$data,'response'=>$response,'message'=>$message]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function destroy(Register $register)
    {
        //
    }


    public function login(Request $request)
    {

	$name=$request->input('name');
    $password=$request->input('password');


	if (Auth::attempt(['name' => $name, 'password' => $password])) {


        $user = Auth::user();

        return redirect('/')->with('loginresponce','success');

	}
	else
	{
	   return redirect('/')->with(['loginresponce' => 'failed' , 'name' => $name]);
	}

	}


    public function logout(Request $request)
    {
    	Auth::logout();

    	return redirect('/');

    }
}
