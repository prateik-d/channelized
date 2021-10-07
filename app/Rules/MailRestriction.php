<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MailRestriction implements Rule
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
        $public_mails = [
            '@gmail.com',
            '@yahoo.com',
            '@ymail.com',
            '@rediff.com'
        ];

        foreach($public_mails as $public_mail){
            if (strpos(strtolower($value), $public_mail) !== false) {
                return false;
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
        return 'Only use your work mail';
    }
}
