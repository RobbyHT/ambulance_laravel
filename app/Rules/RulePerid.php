<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\User;


class RulePerid implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        $account = User::all();
        foreach($account as $a)
        {
            try {
                if( $value == Crypt::decryptString($a->perid))
                {
                    //dd($value == Crypt::decryptString($a->perid));
                    return false;
                }
            } catch (DecryptException $e) {
                //
                $decrypted = 'err';
            }
        }        
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
