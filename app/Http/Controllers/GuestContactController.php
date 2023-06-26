<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ContactInteraction\StoreRequest;

use App\Models\Contact;
use App\Models\ContactResponse;
use App\Models\GuestContact;
use Illuminate\Support\Facades\DB;

class GuestContactController extends Controller
{
    public function show($shareCode)
    {
        $contact = Contact::where('share_status', Contact::SHARED)
            ->where('share_code', $shareCode)
            ->with([
                'contactResponses' => function($query) {
                    $query->orderBy('created_at', 'desc');
                },
            ])
            ->firstOrFail();

        return view('contact-interaction.show', ['contact' => $contact]);
    }

    public function store(StoreRequest $storeRequest, Contact $contact)
    {
        $inputs = $storeRequest->validated();
        $inputs['user_id'] = GuestContact::GUEST;
        $contact->contactResponses()->create($inputs);
        return back()->with('succeed', 'レスポンスしました。');
    }
}
