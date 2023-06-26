<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ContactInteraction\StoreRequest;

use App\Models\Contact;
use App\Models\ContactResponse;
use App\Models\GuestContact;

class GuestContactController extends Controller
{
    public function show($shareCode)
    {
        $contact = Contact::where('share_status', Contact::SHARED)
        ->where('share_code', $shareCode)
        ->first();

        $contact = $contact::with('contactResponses')
            ->where('id', $contact->id)
            ->findOrFail(Contact::where('share_code', $shareCode)
            ->firstOrFail()->id);

        $contactResponses = $contact->contactResponses->sortByDesc('created_at');
        dd($contactResponses);
            
        return view('contact-interaction.show', ['contact' => $contact, 'contactResponses' => $contactResponses]);
    }

    public function store(StoreRequest $storeRequest, Contact $contact)
    {
        $inputs = $storeRequest->validated();
        $inputs['user_id'] = GuestContact::GUEST;
        $contact->contactResponses()->create($inputs);
        return back()->with('succeed', 'レスポンスしました。');
    }
}
