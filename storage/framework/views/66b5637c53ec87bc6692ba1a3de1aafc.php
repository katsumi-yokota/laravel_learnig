<?php $user = App\Models\Contact::find(1); // アクセサ ?>

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
<!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<div class="container">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('title', 'タイトル'));?></th>
        <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('name', '名前'));?></th>
        <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('body', '内容'));?></th>
        <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('created_at', '受付日時'));?></th>
        <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('file_name', 'ファイルダウンロード'));?></th>
        <th>ファイルプレビュー</th>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($contact->title); ?></td>
        <td><?php echo e($contact->name); ?></td>
        <td><?php echo nl2br(e($contact->body)); ?></td>
        <td><?php echo e($contact->created_at); ?></td>
          <?php if(!$contact->file_path): ?>
          <td></td>
          <td>ファイルが添付されていません。</td>
          <?php elseif(File::exists("$contact->file_path")): ?>
          
          <td><a href="<?php echo e(route('contact.download', $contact->id)); ?>"><?php echo e($contact->file_name); ?></a></td>
          <td><img src="<?php echo e(asset("storage/contact/$contact->file_name")); ?>" alt=""></td>
          <?php else: ?>
          <td></td>
          <td>ファイルが削除された可能性があります。<?php echo e($contact->storage_file_path); ?></td>
        <?php endif; ?>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo e($contacts->appends(request()->query())->links()); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/laravel_learning/resources/views/contact/index.blade.php ENDPATH**/ ?>