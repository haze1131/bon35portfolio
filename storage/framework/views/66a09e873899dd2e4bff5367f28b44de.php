<div data-aos="fade-up" class="section s11" id="feedback">
    <section>
        <h1>Kesan &amp; Pesan</h1>
        <p>Punya kesan atau pesan setelah melihat portfolio ini? Tinggalkan di sini.</p>

        <form class="formCard" method="POST" action="<?php echo e(route('feedback.send')); ?>">
            <?php echo csrf_field(); ?>
            <?php if(session('feedback_status')): ?>
                <div class="alert ok" role="status"><?php echo e(session('feedback_status')); ?></div>
            <?php endif; ?>
            <?php if($errors->feedback->any()): ?>
                <div class="alert err" role="alert">
                    <ul><?php $__currentLoopData = $errors->feedback->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
                </div>
            <?php endif; ?>

            <div class="hp" aria-hidden="true">
                <label for="website">Jangan diisi</label>
                <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
            </div>

            <label for="fbName">Nama</label>
            <input type="text" id="fbName" name="name" value="<?php echo e(old('name')); ?>" maxlength="100" required>

            <label for="fbRelation">Sebagai (guru, teman, pengguna, dll.)</label>
            <input type="text" id="fbRelation" name="relation" value="<?php echo e(old('relation')); ?>" maxlength="100">

            <label for="fbEmail">Email (opsional)</label>
            <input type="email" id="fbEmail" name="email" value="<?php echo e(old('email')); ?>" maxlength="150">

            <label for="fbMessage">Kesan dan pesan</label>
            <textarea id="fbMessage" name="message" maxlength="2000" required><?php echo e(old('message')); ?></textarea>

            <button type="submit" class="btn">Kirim</button>
        </form>
    </section>
</div>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/portfolio/feedback.blade.php ENDPATH**/ ?>