<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactTag; 

use App\Http\Requests\ContactTag\StoreRequest;
use App\Http\Requests\ContactTag\UpdateRequest;

class ContactTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactTags = contactTag::withCount('contacts')->get();
        // dd($contactTags);
        return view('contact-tag.index', ['contactTags' => $contactTags]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ContactTag $contactTag)
    {
        return view('contact-tag.create', ['contactTag' => $contactTag]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $inputs = $request->validated();
        ContactTag::create($inputs);
        return back()->with('succeed', 'タグの追加に成功しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contactTag = ContactTag::find($id);
        return view('contact-tag.show', ['contact_tag_id' => $id, 'contactTag' => $contactTag]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contactTag = ContactTag::find($id);
        return view('contact-tag.edit',['contact_tag_id' => $id, 'contactTag' => $contactTag]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $updateRequest, ContactTag $contactTag)
    {
        $contactTag->fill($updateRequest->validated())->save();
        return redirect()->route('contact-tag.index')->with('succeed', '編集しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ContactTag::find($id)->delete();
        return redirect()->route('contact-tag.index')->with('warning', '削除しました。');
    }
}
