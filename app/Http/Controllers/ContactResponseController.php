<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\withTrashed;

use App\Http\Requests\ContactResponse\StoreRequest;
use App\Http\Requests\ContactResponse\UpdateRequest;
use App\Http\Requests\ContactResponse\PatchRequest;

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
    public function edit(int $contactId, int $contactResponseId)
    {
        $contactResponse = ContactResponse::where('contact_id', $contactId)
            ->where('id', $contactResponseId)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        return view('contact-response.edit', ['contactResponse' => $contactResponse]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $updateRequest, $contactId, $contactResponseId)
    {
        $validatedDataAtUpdate = $updateRequest->validated();
        $contactResponse = ContactResponse::where('contact_id', $contactId)
            ->where('id', $contactResponseId)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        $contactResponse->fill($validatedDataAtUpdate)->save();
        return redirect()->route('contact.show', ['contact' => $contactId])->with('succeed', '編集に成功しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($contactId, $contactResponseId)
    {
        ContactResponse::where('contact_id', $contactId)
            ->where('id', $contactResponseId)
            ->where('user_id', Auth::id())
            ->firstOrFail()
            ->delete();
        return back()->with('warning', '削除しました。');
    }

    public function patch(PatchRequest $patchRequest, $contactId, $contactResponseId)
    {
        $validatedDataAtPatch = (int)($patchRequest->validated());
        $contact = Contact::find($contactId);
        $contact['status'] = $validatedDataAtPatch;
        $contact->save();
        // $contact->fill($validatedDataAtPatch)->save(); // TO DO : patchなのにfill()で良いのか検討
        return redirect()->route('contact.show', ['contact' => $contactId])->with('succeed', '問合せをクローズしました。');
    }
}
