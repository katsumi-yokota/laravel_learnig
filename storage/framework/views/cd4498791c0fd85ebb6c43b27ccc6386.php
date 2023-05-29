<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>お問い合わせを受け付けました</title>
</head>
<body>
    <p>お問い合わせ内容は次のとおりです。</p>
    ーーーー
    <p>件名：<?php echo e($inputs['title']); ?></p>
    <p>お名前：<?php echo e($inputs['name']); ?></p>
    <p>お問い合わせ内容：<?php echo e($inputs['body']); ?></p>
    <p>メールアドレス：<?php echo e($inputs['email']); ?></p>
    <p>ファイル：<?php echo e($inputs['file']); ?></p>
    ーーーー
    <p>担当者よりご連絡いたしますので、今しばらくお待ちください。</p>
</body>
</html<?php /**PATH /home/vagrant/code/laravel_learning/resources/views/contact/mail.blade.php ENDPATH**/ ?>