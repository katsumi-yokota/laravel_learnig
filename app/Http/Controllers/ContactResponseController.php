<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactResponse;
use Illuminate\Support\Facades\Auth;

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
    public function edit(string $id)
    {
        $contactResponse = ContactResponse::findOrFail($id);
        return view('contact-response.edit', ['contactResponse' => $contactResponse]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $updateRequest, $id)
    {
        $validatedDataAtUpdate = $updateRequest->validated();
        $contactResponse = contactResponse::findOrFail($id);
        $contactResponse->fill($validatedDataAtUpdate)->save(); // TO DO : 複数カラムのupdateではないのでfill()を使わない方法の検討
        return back()->with('succeed', '編集に成功しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
