<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function validationData(): array
    {
        $this->replace($this->snakeCase($this->all()));

        return $this->all();
    }

    public function rules(): array
    {
        return [];
    }

    function snakeCase(array $array): array
    {
        return array_map(function ($item) {
            if (is_array($item)) {
                $item = $this->snakeCase($item);
            }
            return $item;
        },
            $this->doSnakeCase($array)
        );
    }

    function doSnakeCase(array $array): array
    {
        $result = [];

        foreach ($array as $key => $value) {
            $key = strtolower(preg_replace('~(?<=\\w)([A-Z])~', '_$1', $key));

            $result[$key] = $value;
        }

        return $result;
    }
}
