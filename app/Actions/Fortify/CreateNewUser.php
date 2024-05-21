<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $first_name = $input['first_name'];
        $last_name = $input['last_name'];
        $class = $input['class'];
        $email = $input['email'];
        $gender = $input['gender'];
        // $phone_number = $input['phone_number'];

        $student = new Student;
        $student->first_name = $first_name;
        $student->last_name = $last_name;
        $student->class = $class;
        $student->gender = $gender;
        // $student->phone_number = $phone_number;
        $student->email = $email;
        $student->save();

        return User::create([
            'name' => $first_name.' '.$last_name,
            'user_type' => 'student',
            'email' => $email,
            'password' => Hash::make($input['password']),
        ]);
    }
}
