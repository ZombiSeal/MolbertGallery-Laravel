<?php

namespace App\Http\Controllers;


use App\Http\Requests\EmailRequest;
use App\Http\Requests\FirstNameRequest;
use App\Http\Requests\LastNameRequest;
use App\Http\Requests\PasswordRepeatRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;

class RegistrationController extends Controller
{

    public  function  index() {
        return view('/auth/registration');
    }

    private function checkFirstName(array $data):array
    {
        $rules = new FirstNameRequest();
        $validator = Validator::make($data, $rules->rules(), $rules->messages());
        return $validator->errors()->toArray();
    }

    private function checkLastName(array $data):array
    {
        $rules = new LastNameRequest();
        $validator = Validator::make($data, $rules->rules(), $rules->messages());
        return $validator->errors()->toArray();
    }

    private function checkEmail(array $data):array
    {
        $rules = new EmailRequest();
        $validator = Validator::make($data, $rules->rules(), $rules->messages());
        return $validator->errors()->toArray();
    }

    private function checkExistEmail(array $data):array
    {
        $rules = new EmailRequest();
        $validator = Validator::make($data, $rules->rules(), $rules->messages());
        return $validator->errors()->toArray() ;
    }

    private function checkPassword(array $data):array
    {
        $rules = new PasswordRequest();
        $validator = Validator::make($data, $rules->rules(), $rules->messages());
        return $validator->errors()->toArray() ;
    }

    private function checkPasswordRepeat(array $data):array
    {
        $rules = new PasswordRepeatRequest();
        $validator = Validator::make($data, $rules->rules(), $rules->messages());
        return $validator->errors()->toArray() ;
    }

    public function validateData(Request $request)
    {
        $name = $request->name;
        switch ($name) {
            case 'firstName':
                $validator = $this->checkFirstName($request->all());
                break;
            case 'lastName':
                $validator = $this->checkLastName($request->all());
                break;
            case 'email':
                $validator = $this->checkEmail($request->all());
                break;
            case 'emailExist':
                $validator = $this->checkExistEmail($request->all());
                break;
            case 'password':
                $validator = $this->checkPassword($request->all());
                break;
            case 'passwordRepeat':
                $validator = $this->checkPasswordRepeat($request->all());
                break;
        }

        return response()->json(['error' => $validator]);
    }

    public function create(Request $request) {
        $validatorFirstName = $this->checkFirstName($request->all());
        $validatorLastName = $this->checkLastName($request->all());
        $validatorEmail = $this->checkEmail($request->all());
        $validatorEmailExist = $this->checkExistEmail($request->all());
        $validatorPassword = $this->checkPassword($request->all());
        $validatorPasswordRepeat = $this->checkPasswordRepeat($request->all());


        $validatorData = $validatorFirstName + $validatorLastName + $validatorEmail + $validatorEmailExist + $validatorPassword + $validatorPasswordRepeat;
        if(count($validatorData) == 0) {
            $user = User::create([
                'firstname' => $request->firstName,
                'lastname' => $request->lastName,
                'email' => $request->email,
                'password' =>Hash::make($request->password),
            ]);
            return response()->json(['status' => 1, 'data' => "hello"]);
        } else {
            return response()->json(['status' => 0, 'errors' => $validatorData]);
        }
    }

}
