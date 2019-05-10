<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\CollectionRepository as Collections;

class PortalRequest extends FormRequest
{
    public function __construct(Collections $collections)
    {
        $this->collections = $collections;
    }

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
     * @return array
     */
    public function rules()
    {
        return [
        ];
    }

    public function portal()
    {
        // The application url with no subdomain
        $noSubDomainHost = parse_url(config('app.url'), PHP_URL_HOST);

        // Remove that from the actual request host that may have a subdomain
        $str = trim(str_replace($noSubDomainHost, '', $this->getHttpHost()));

        // After removing, check if the string has anything in it.
        if (0 === strlen($str)) {
            abort(404);
        }

        $portal = strtolower(str_replace('.', '', $str));

        // If it does, look for collection matching subdomain
        return  $this->collections->forPortal($portal);
    }
}
