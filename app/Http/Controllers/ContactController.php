<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'number' => 'nullable|string',
            'message' => 'required|string|min:5',
        ]);

        Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'number'   => $request->number,
            'message' => $request->message,
        ]);

        return redirect()->route('contact')->with('success', 'Message sent successfully!');
    }
}
