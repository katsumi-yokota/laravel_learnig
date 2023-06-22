<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>アクセス用URLをお送りしました。</title>
</head>
<body>
    <p>件名: アクセス用URLをお送りしました。</p>
    <p>アクセス用URLは下記です。</p>
    -----
    <p>URL: {{ $email . /contact-interaction/$contact->share_code }}</p>
    -----
</body>
</html>
