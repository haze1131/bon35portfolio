<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($data['profile']['name']); ?> | Portfolio</title>
    <link rel="icon" type="image/svg+xml" href="/assets/logo.svg">
    <script>
        /* Terapkan tema tersimpan sebelum halaman tampil (hindari kedip) */
        try { document.documentElement.dataset.theme = localStorage.getItem('theme') || 'dark'; } catch (e) {}
    </script>
    <link rel="stylesheet" href="/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gasoek+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
</head>
<body>
    <div class="pageCurtain" id="pageCurtain" aria-hidden="true"></div>

    <?php echo $__env->make('portfolio.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="body">
        <?php echo $__env->make('portfolio.home', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('portfolio.about', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('portfolio.skills', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('portfolio.interests', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('portfolio.projects', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('portfolio.experience', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('portfolio.certificates', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('portfolio.cv', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('portfolio.blog', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('portfolio.testimonials', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('portfolio.feedback', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </main>

    <?php echo $__env->make('portfolio.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <button type="button" class="backToTop" id="backToTop" aria-label="Kembali ke atas">↑</button>

    <dialog id="projectModal">
        <div class="modalBox">
            <button type="button" class="modalClose" aria-label="Tutup">✕</button>
            <div class="modalContent"></div>
        </div>
    </dialog>
    <dialog id="lightbox" class="lightbox"><img src="" alt=""></dialog>

    <script>window.PROJECTS = <?php echo json_encode($projects, 15, 512) ?>;</script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="/app.js"></script>
</body>
</html>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/welcome.blade.php ENDPATH**/ ?>