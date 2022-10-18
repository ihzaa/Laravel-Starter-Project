<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;

/**
 * @group Registration
 *
 */
class RegisterController extends Controller
{
    /**
     * Register user
     *
     * API for register a user.
     *
     */
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
    }
}
