<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactCategory;
use App\Models\Contact;

class ContactCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactCategories = ContactCategory::withCount('contacts')->paginate(20);
        return view('contact-category.index', ['contactCategories' => $contactCategories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact-category.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $contactCategories = new ContactCategory();
        $contactCategories->name = $request->category;
        $contactCategories->save();
        return redirect()->route('contact-category.index')->with('succeed', '保存に成功しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contactCategory = ContactCategory::find($id); // 主キー（id）を指定
        return view('contact-category.show', ['contactCategory' => $contactCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contactCategory = ContactCategory::find($id); // 主キー（id）を指定
        return view('contact-category.edit', ['contactCategory' => $contactCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactCategory $contactCategory)
    {
        $contactCategory->contact_category = $request->category;
        $contactCategory->save();
        return redirect()->route('contact-category.index')->with('succeed', '編集に成功しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactCategory $contactCategory)
    {
        $contactCategory->delete();
        return redirect()->route('contact-category.index')->with('warning', '削除しました。');
    }
}
