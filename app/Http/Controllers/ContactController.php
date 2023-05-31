<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; 

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactForm;

use App\Http\Requests\Contact\StoreRequest; // フォームリクエスト store

use Illuminate\Support\Facades\Storage; // ファイルダウンロード
use Illuminate\Support\Facades\File;

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
        $uploadedFile = $request->file('file');
        if (isset($uploadedFile))
        {
            $movedFile = $uploadedFile->store("protected/contact");
            if (empty($movedFile))
            {
                return back()->withInput()->with('warning','保存に失敗しました。');
            }
            $inputs['file_name'] = $uploadedFile->getClientOriginalName();
            $inputs['file_path'] = storage_path("app/$movedFile");

        }
        Contact::create($inputs);
        Mail::to(config('mail.admin'))->send(new ContactForm($inputs));
        Mail::to($inputs['email'])->send(new ContactForm($inputs));
        return back()->with('succeed','保存に成功しました。メールをご確認ください。');
    }

    public function download(Contact $contact)
    {
        // ファイルダウンロード
        $fileName = $contact->file_name;
        $filePath = $contact->file_path;
        $mimeType = File::mimeType($filePath);
        $headers = [['Content-Type' => $mimeType]];
        return Storage::download($filePath, $fileName, $headers);
    }
}
