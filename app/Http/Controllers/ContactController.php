<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create(Request $request)
    {
        try {

            $validated = $request->validate([
                'name'    => 'required|string|max:255',
                'email'   => 'required|email|max:255',
                'phone'   => 'nullable|string|max:50',
                'subject' => 'nullable|string|max:255',
                'message' => 'required|string',
            ]);

            $contact = Contact::create($validated);

            return $this->response(
                true,
                'Contact message submitted successfully',
                $contact,
                201
            );

        } catch (\Illuminate\Validation\ValidationException $e) {

            return $this->response(
                false,
                'Validation failed',
                $e->errors(),
                422
            );

        } catch (\Exception $e) {

            return $this->response(
                false,
                'Something went wrong while submitting contact message',
                ['error' => $e->getMessage()],
                500
            );
        }
    }

}
