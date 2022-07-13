<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $emailRule = Rule::unique((new User)->getTable());
        if (request()->isMethod('put')) {
            // we update user, let's ignore its own email
            // consider your route like : PUT /users/{user}
            $emailRule->ignore($this->route('user'));
        }
        return [
            'name' => 'required|max:20|min:3',
            'email' => "required|max:20|min:5|email|$emailRule",
        ];
    }
}
