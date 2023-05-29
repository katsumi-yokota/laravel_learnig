<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; 

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactForm;

use App\Http\Requests\Contact\StoreRequest; // フォームリクエスト store
use Illuminate\Support\Facades\Storage; // ファイルダウンロード

class ContactController extends Controller
{
    public function index(Request $request, Contact $contact)
    {
        $sort = $request->sort;
        $contacts = Contact::query()->sortable()->paginate(30);
        // $contacts = Contact::query()->sortable()->paginate(5);
        
        $fileName = $contact->file_name;
        $filePath = "public/file/$fileName";
        return view('contact.index', ['contacts' => $contacts, 'sort' => $sort, 'fileName' => $fileName]);
    }

    public function create()
    {
        return view('contact.create');
    }

    public function store(StoreRequest $request)
    {
        $inputs = $request->validated();

        $fileName = $request->file('file')->getClientOriginalName(); // storage/app/public/fileにオリジナル名で保存
        $request->file('file')->storeAs("public/contact", $fileName);
        $inputs['file_name'] = $fileName;
        $inputs['file_path'] = "storage/app/public/$fileName";

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
