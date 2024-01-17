<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name'     => ['required', 'string', 'max:255'],
            'mobile'   => ['required', 'max:255'],
            'referral_code'=>'sometimes|nullable|string',Rule::exists('users', 'referral_code'),
            'email'    => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        // return dd($input);
        $user = [
            'name'     => $input['name'],
            'email'    => $input['email'],
            'mobile'   => $input['mobile'],
            'password' => Hash::make($input['password']),
        ];
        if(isset($input['referral_code'])){
        $referBy = User::where('referral_code', $input['referral_code'])->first();
        // return dd($referBy);
        if($referBy !=null){
            $user['refer_by'] = $referBy->id;
        }
        }
        // return dd($user);

        return User::create($user);
    }
}
