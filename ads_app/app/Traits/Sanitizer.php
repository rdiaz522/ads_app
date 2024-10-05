<?php

namespace App\Traits;

trait Sanitizer
{
    /**
     * Sanitize Data Dynamically 
     *
     * @param [type] $data
     * @return void
     */
    protected function sanitize($data)
    {
        $type = gettype($data);
        switch ($type) {
            case 'string':
                $data = $this->sanitizeString($data);
                break;
            case 'array':
                $data = $this->sanitizeArray($data);
                break;
            case 'object':
                $data = $this->sanitizeObject($data);
                break;
            default:
                break;
        }

        return $data;
    }

    /**
     * Sanitize String Data
     *
     * @param string $input
     * @return string
     */
    protected function sanitizeString(string $input): string
    {
        return htmlspecialchars(trim(strip_tags($input)), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Sanitize Array Data
     *
     * @param array $data
     * @return array
     */
    protected function sanitizeArray(array $data): array
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    // If the value is an array, call the function recursively
                    $data[$key] = $this->sanitizeArray($value);
                } else {
                    // Apply sanitization to individual elements
                    $data[$key] = $this->sanitize($value);
                }
            }
        }
        return $data;
    }

    /**
     * Sanitize Object Data
     *
     * @param object $data
     * @return object
     */
    protected function sanitizeObject(object $data): object
    {
        $data = collect($data)->map(function ($item) {
            return $this->sanitize($item);
        });

        return $data;
    }
}
