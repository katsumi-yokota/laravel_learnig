<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; 
use App\Models\ContactCategory;
use App\Models\ContactTag;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactForm;

use App\Http\Requests\Contact\StoreRequest;

use Illuminate\Support\Facades\File;
use Kyslik\ColumnSortable\SortableLink;
use Symfony\Component\Console\Input\Input;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort;
        $contactsQuery = Contact::sortable();

        // 絞り込み
        $selectedContactCategoryId = (int)$request->input('contact_category_id');
        if (!empty($selectedContactCategoryId))
        {
            $contactsQuery->where('contact_category_id', $selectedContactCategoryId);
        }

        $selectedContactTagId = 0;
        if (!empty($request->input('contact_tag_id')))
        {
            $selectedContactTagId = (int)$request->input('contact_tag_id');
            $contactsQuery->whereIn('id', function($query) use($selectedContactTagId)
            {
                $query->select('contact_id')
                    ->from('contact_contact_tag')
                    ->where('contact_tag_id', $selectedContactTagId);
            });
        }

        // 検索
        $keyword = trim($request->input('keyword'));
        if (!empty($keyword))
        {
            $escapedKeyword = '%' . addcslashes($keyword, '%_\\') . '%';
            $contactsQuery->where('title', 'LIKE', $escapedKeyword)->orWhere('name', 'LIKE', $escapedKeyword);
        }

        $contacts = $contactsQuery->paginate(20);

        $contactCategories = ContactCategory::all();
        $contactTags = ContactTag::all();
        
        return view('contact.index', ['contacts' => $contacts, 'sort' => $sort, 'contactCategories' => $contactCategories, 'contactTags' => $contactTags, 'selectedContactCategoryId' => $selectedContactCategoryId, 'selectedContactTagId' => $selectedContactTagId,'keyword' => $keyword]);
    }

    public function create()
    {
        // お問合せフォームにタグを表示
        $contactTags = ContactTag::all();
        $contactCategories = ContactCategory::all();
        return view('contact.create', ['contactTags' => $contactTags, 'contactCategories' => $contactCategories]);
    }

    public function store(StoreRequest $storeRequest)
    {
        $inputs = $storeRequest->validated();
        $uploadedFile = $storeRequest->file('file');
        if (isset($uploadedFile))
        {
            $movedFile = $uploadedFile->store('protected/contact');
            if (empty($movedFile))
            {
                return back()->withInput()->with('warning','保存に失敗しました。');
            }
            $inputs['file_name'] = $uploadedFile->getClientOriginalName();
            $inputs['file_path'] = storage_path("app/$movedFile");
        }
        $inputs['status'] = Contact::OPEN;
        Contact::create($inputs);
        Contact::latest()->first()->contactTags()->sync($storeRequest->contact_tag_id);

        Mail::to(config('mail.admin'))->send(new ContactForm($inputs));
        Mail::to($inputs['email'])->send(new ContactForm($inputs));

        return back()->with('succeed','保存に成功しました。メールをご確認ください。');
    }

    public function download(Contact $contact)
    {
        $fileName = $contact->file_name;
        $filePath = $contact->file_path;
        $mimeType = File::mimeType($filePath);
        $headers = [['Content-Type' => $mimeType]];
        return response()->download($filePath, $fileName, $headers);
    }

    public function show($id)
    {
        $contact = Contact::find($id);
        return view('contact.show', compact('contact'));
    }

    public function preview($id)
    {
        $contact = Contact::findOrFail($id);
        $filePath = $contact->file_path;

        if (empty($filePath))
        {
            abort(404);
        }
        if (!File::exists($filePath))
        {
            abort(404);
        }
        if (preg_match('/.+\.(png|jpe?g|gif|bmp)$/', $contact->file_name))
        {
            return response()->file($filePath);
        }
        else
        {
            abort(400);
        }
    }
}
