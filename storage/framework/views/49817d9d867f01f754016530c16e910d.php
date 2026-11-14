<div data-aos="fade-up" class="section s07" id="certificate">
    <section>
        <h1>Certificates & Achievements</h1>
        <div data-aos="fade-up" class="flexWrap cardGrid">
            <?php $__empty_1 = true; $__currentLoopData = $data['certificates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="card">
                    <?php if(!empty($item['image'])): ?>
                        <img src="/uploads/<?php echo e($item['image']); ?>" alt="<?php echo e($item['title'] ?? ''); ?>" data-lightbox>
                    <?php endif; ?>
                    <?php if(!empty($item['category'])): ?><span class="cardBadge"><?php echo e($item['category']); ?></span><?php endif; ?>
                    <h2><?php echo e($item['title'] ?? ''); ?></h2>
                    <?php if(!empty($item['issuer'])): ?><p><?php echo e($item['issuer']); ?></p><?php endif; ?>
                    <?php if(!empty($item['year'])): ?><p><small><?php echo e($item['year']); ?></small></p><?php endif; ?>
                    <?php if(!empty($item['desc'])): ?><p class="prewrap"><?php echo e($item['desc']); ?></p><?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="muted">No certificates added yet.</p>
            <?php endif; ?>
        </div>
    </section>
</div>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/portfolio/certificates.blade.php ENDPATH**/ ?>