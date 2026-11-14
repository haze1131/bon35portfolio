<header class="topbar">
    <div class="logo" data-aos="flip-left">
        <a href="<?php echo e(route('admin')); ?>" aria-label="Admin"><img src="/assets/logo.svg" width="36" height="36" alt="Logo"></a>
    </div>
    <div class="navWrap">
        <button type="button" class="navArrow" data-dir="-1" aria-label="Geser menu ke kiri">‹</button>
        <nav class="navScroll" id="navScroll" aria-label="Navigasi utama">
            <ul>
                <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="#<?php echo e($id); ?>"><?php echo e($label); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </nav>
        <button type="button" class="navArrow" data-dir="1" aria-label="Geser menu ke kanan">›</button>
    </div>
    <button type="button" class="themeBtn" id="themeToggle" aria-label="Ganti tema">☀</button>
</header>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/portfolio/header.blade.php ENDPATH**/ ?>