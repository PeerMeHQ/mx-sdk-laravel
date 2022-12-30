<?php

namespace Peerme\Multiversx\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class ElrondAddressRule implements InvokableRule
{
    const Regex = '/erd1[a-z0-9]{58}/';

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (! preg_match_all(self::Regex, $value)) {
            $fail('The :attribute must be a valid Elrond address.');
        }
    }
}
