{{-- @extends('layouts.app')
@section('content') --}}
<!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
{{-- メッセージ --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
@if (session('succeed'))
    <div class="alert-success h2 text-center">
        {{ session('succeed') }}
    </div>
@endif
@if (session('warning'))
    <div class="alert-danger h2 text-center">
        {{ session('warning') }}
    </div>
@endif
<body>
    <div class="row">
        <div class="col-10 col-md-8 col-lg-6 mx-auto mt-6">
            <div class="card-body">
                <h1 class="mt4  mb-3">お問い合わせ</h1>
                <form method="post" action="{{  route('contact.store')  }}" enctype="multipart/form-data" name="form" id="form">
                @csrf
                    <div class="form-group">
                        <select name="contact_category_id" class="my-3">
                        @foreach ($contactCategories as $contactCategory)
                            <option value="{{ $contactCategory->id }}">{{ $contactCategory->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        @foreach ($contactTags as $contactTag)
                            <label for="contact_tag_{{ $contactTag->id }}">{{ $contactTag->name }}</label>
                            <input type="checkbox" id="contact_tag_{{ $contactTag->id }}" name="contact_tag_id[]" value="{{ $contactTag->id }}">
                        @endforeach
                    </div>
                    <div class="form-group  mt-3">
                        <label for="title">件名</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{  old('title')  }}" placeholder="Enter Title">
                    </div>
                    <div class="form-group mt-3">
                        <label for="name">名前</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{  old('name')  }}" placeholder="Enter Name">
                    </div>
                    <div id="contact_body"></div>
                        <input type="hidden" name="body" value="{{ old('body') }}">
                    <div class="form-group mt-3">
                        <label for="email">メールアドレス</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{  old('email')  }}" placeholder="email">
                    </div>
                    <div class="form-group mt-3">
                        <label for="file">ファイル</label>
                        <input type="file" id="file" name="file" class="form-control">
                    </div>
                    <input type="submit" class="btn btn-success mt-3" name="submit_button" id="submit_button">
                </form>
            </div>
        </div>
    </div>
    <script>
        var quill = new Quill('#contact_body', {
            modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],
                [{'color': []}, {'background': []}],
                ['link', 'blockquote', 'image', 'video'],
                [{ list: 'ordered' }, { list: 'bullet' }]
            ]
            },
            placeholder: 'Write your question here...',
            theme: 'snow',
        });
        document.getElementById('submit_button').addEventListener('click', function() {
            document.querySelector('input[name=body]').value = document.getElementById('contact_body').innerHTML
        });
    </script>
</body>
