<?php

namespace App\Traits;

trait ErrorHandling
{
    public function formatErrors(Object $errors)
    {
        $formattedErrors = collect($errors)->map(function ($error) {
            return $error[0];  // Take the first error message from the array
        });

        return $formattedErrors;
    }
}
