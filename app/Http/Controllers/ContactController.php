<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; 

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactForm;

use App\Http\Requests\Contact\StoreRequest; // フォームリクエスト store
use Illuminate\Support\Facades\Storage; // ファイルダウンロード
use Illuminate\Support\Str; // ランダム生成

class ContactController extends Controller
{
    public function index(Request $request, Contact $contact)
    {
        $sort = $request->sort;
        $contacts = Contact::query()->sortable()->paginate(100);
        
        return view('contact.index', ['contacts' => $contacts, 'sort' => $sort]);
    }

    public function create()
    {
        return view('contact.create');
    }

    public function store(StoreRequest $request)
    {
        $inputs = $request->validated();
        $fileName = $request->file('file');
        $request->file('file')->store("public/contact");
        $hashName = $fileName->hashName();
        $inputs['file_name'] = $hashName;
        $inputs['file_path'] = storage_path("app/public/contact/$hashName");

        Contact::create($inputs);

        Mail::to(config('mail.admin'))->send(new ContactForm($inputs));
        Mail::to($inputs['email'])->send(new ContactForm($inputs));

        return back()->with('message','メールを送信したのでご確認ください');
    }

    public function download(Contact $contact)
    {
        // ファイルダウンロード
        $fileName = $contact->file_name;
        $filePath = "public/contact/$fileName";
        $mimeType = Storage::mimeType($filePath);
        $headers = [['Content-Type' => $mimeType]];
        return Storage::download($filePath, $fileName, $headers);
    }
}
