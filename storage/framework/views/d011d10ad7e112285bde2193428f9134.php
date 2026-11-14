<div class="login-wrap">
    <h1>Admin Log in</h1>
    <?php if(session('msg')): ?>
        <div class="msg"><?php echo e(session('msg')); ?></div>
    <?php endif; ?>
    <?php if(!empty($loginError)): ?>
        <div class="login-error"><?php echo e($loginError); ?></div>
    <?php endif; ?>
    <form method="POST" action="<?php echo e(route('admin')); ?>">
        <?php echo csrf_field(); ?>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" autofocus required>
        <button type="submit" class="btn btn-green" style="width:100%">Masuk</button>
    </form>
</div>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/admin/login.blade.php ENDPATH**/ ?>