<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Mail\NewSiteContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'nullable|string',
            'email' => 'email',
            'message' => 'nullable|string',
        ]);

        $newContact = new Contact();
        $newContact->fill($data);
        $newContact->save;
        Mail::to('admin@sito.com')->send(new NewSiteContactMail($newContact));
        return response()->json($newContact);
    }
}
