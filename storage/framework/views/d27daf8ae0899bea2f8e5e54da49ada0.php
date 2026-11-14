<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="/assets/logo.svg">
    <link rel="stylesheet" href="/admin.css">
    <title>Admin Panel</title>
</head>
<body>

<?php if(!$loggedIn): ?>
    <?php echo $__env->make('admin.login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php else: ?>
    <div class="top-bar">
        <h1>Admin Panel</h1>
        <div class="top-bar-links">
            <a href="/" target="_blank">← Lihat Portfolio</a>
            <a href="<?php echo e(route('admin')); ?>?logout=1" class="logout">Logout</a>
        </div>
    </div>

    <nav class="admin-nav" aria-label="Menu admin">
        <a href="#profile">Profil</a>
        <a href="#messages">Pesan <?php if($unread = collect($messages)->where('read', false)->count()): ?><span class="badge"><?php echo e($unread); ?></span><?php endif; ?></a>
        <?php $__currentLoopData = config('portfolio.sections'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $cfg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="#sec-<?php echo e($slug); ?>"><?php echo e($cfg['label']); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>

    <?php if(session('msg')): ?>
        <div class="msg">✓ <?php echo e(session('msg')); ?></div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="login-error">
            <strong>Periksa input berikut:</strong>
            <ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
        </div>
    <?php endif; ?>

    <?php echo $__env->make('admin.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('admin.messages', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php $__currentLoopData = config('portfolio.sections'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $cfg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('admin.section', ['slug' => $slug, 'cfg' => $cfg], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

</body>
</html>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/admin.blade.php ENDPATH**/ ?>