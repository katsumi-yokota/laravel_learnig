<!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<?php if($errors->any()): ?>
<div class="alert alert-danger">
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>
<?php if(session('message')): ?>
<div class="alert alert-success"><?php echo e(session('message')); ?></div>
<?php endif; ?>
<div class="row">
    <div class="col-10 col-md-8 col-lg-6 mx-auto mt-6">
        <div class="card-body">
            <h1 class="mt4  mb-3">お問い合わせ</h1>
            <form method="post" action="<?php echo e(route('contact.store')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="title">件名</label>
                    <input type="text" name="title" class="form-control" id="title" value="<?php echo e(old('title')); ?>" placeholder="Enter Title">
                </div>
                <div class="form-group mt-3">
                    <label for="name">名前</label>
                    <input type="text" name="name" class="form-control" id="name" value="<?php echo e(old('name')); ?>" placeholder="Enter Name">
                </div>
                <div class="form-group mt-3">
                    <label for="body">本文</label>
                    <textarea name="body" class="form-control" id="body" cols="30" rows="10"><?php echo e(old('body')); ?></textarea>
                </div>
                <div class="form-group mt-3">
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?php echo e(old('email')); ?>" placeholder="email">
                </div>
                <div class="form-group mt-3">
                    <label for="file">ファイル</label>
                    <input type="file" id="file" name="file" class="form-control">
                </div>
                <button type="submit" class="btn btn-success mt-3">送信する</button>
            </form>
        </div>
    </div>
</div><?php /**PATH /home/vagrant/code/laravel_learning/resources/views/contact/create.blade.php ENDPATH**/ ?>