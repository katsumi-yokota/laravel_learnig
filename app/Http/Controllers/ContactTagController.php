<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactTag; 

use App\Http\Requests\ContactTag\StoreRequest;

class ContactTagController extends Controller
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
