<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; 
use App\Models\ContactCategory;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactForm;

use App\Http\Requests\Contact\StoreRequest;

use Illuminate\Support\Facades\File;
use Kyslik\ColumnSortable\SortableLink;

use Illuminate\Support\Str; // 文字置換

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort;
        $contactsQuery = Contact::sortable();

        // 絞り込み
        $selectedContactCategoryID = $request->input('contact_category_id');
        if (!empty($selectedContactCategoryID))
        {
            $contactsQuery->where('contact_category_id', $selectedContactCategoryID);
        }

        // 検索
        $keyword = trim($request->input('keyword'));
        if (!empty($keyword))
        {
            $escapedKeyword = addcslashes($keyword, '%_');
            $contactsQuery->where('title', 'LIKE', "%{$escapedKeyword}%")->orWhere('name', 'LIKE', "%{$escapedKeyword}%");
            // あいまい検索
        }

        $contacts = $contactsQuery->paginate(20);

        $contactCategories = ContactCategory::all();
        
        return view('contact.index', ['contacts' => $contacts, 'sort' => $sort, 'contactCategories' => $contactCategories, 'selectedContactCategoryID' => $selectedContactCategoryID, 'keyword' => $keyword]);
    }

    public function create()
    {
        // お問合せフォームにカテゴリーを表示
        $contactCategories = ContactCategory::all();
        return view('contact.create', ['contactCategories' => $contactCategories]);
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
        return response()->download($filePath, $fileName, $headers);
    }
}
