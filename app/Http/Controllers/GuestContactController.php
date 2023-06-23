<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;
use App\Models\ContactResponse;

class GuestContactController extends Controller
{
    public function show($id, $shareCode)
    {
        $contact = Contact::where('share_status', Contact::SHARED)
            ->where('share_code', $shareCode)
            ->findOrFail($id);
        return view('contact-interaction.show', ['contact' => $contact]);
    }
}
