<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\withTrashed;

use App\Http\Requests\ContactResponse\StoreRequest;
use App\Http\Requests\ContactResponse\UpdateRequest;

class ContactResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Contact $contact)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Contact $contact)
    {
        $inputs = $request->validated();
        $inputs['user_id'] = Auth::id();
        $contact->contactResponses()->create($inputs);
        return back()->with('succeed', 'レスポンスしました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(int $contactId, ContactResponse $contactResponse)
    public function edit(int $contactId, int $contactResponseId)
    {
        $contactResponse = ContactResponse::findOrFail($contactResponseId);
        if (Auth::id() === (int)$contactResponse['user_id'])
        {
            return view('contact-response.edit', ['contactResponse' => $contactResponse]);
        }
        else
        {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($contactId, $contactResponseId, UpdateRequest $updateRequest)
    {
        $validatedDataAtUpdate = $updateRequest->validated();
        $contactResponse = contactResponse::findOrFail($contactResponseId);
        $contactResponse->fill($validatedDataAtUpdate)->save(); // TO DO : fill()を使わない方法の検討
        return redirect()->route('contact.show', ['contact' => $contactId])->with('succeed', '編集に成功しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($contactId, $contactResponseId)
    {
        contactResponse::findOrFail($contactResponseId)->delete();
        return back()->with('warning', '削除しました。');
    }
}
