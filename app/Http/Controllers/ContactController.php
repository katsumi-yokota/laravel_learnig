<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; 

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactForm;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort;
        $contacts = Contact::query()->sortable()->paginate(5);
        return view('contact.index', ['contacts' => $contacts, 'sort' => $sort]);
    }

    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $inputs = request()->validate([
            'title' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'body' => 'required',
            'file' => 'nullable',
        ]);

        // ファイルがアップされている
        if ($request->hasFile('file')) 
        {
            // storage/app/public/fileにオリジナル名で保存
            $fileName = $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs("public/file", $fileName);
        }

        Contact::create($inputs);

        Mail::to(config('mail.admin'))->send(new ContactForm($inputs));
        Mail::to($inputs['email'])->send(new ContactForm($inputs));

        return back()->with('message','メールを送信したのでご確認ください');
    }
}
