<div data-aos="fade-up" class="section s09" id="testimonials">
    <section data-filter>
        <h1>Testimonials</h1>

        <?php if(count($testimonialTypes) > 1): ?>
            <div class="filterBar">
                <button type="button" class="chip active" data-tag="">Semua</button>
                <?php $__currentLoopData = $testimonialTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><button type="button" class="chip" data-tag="<?php echo e($type); ?>"><?php echo e($type); ?></button><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <div class="flexWrap cardGrid">
            <?php $__empty_1 = true; $__currentLoopData = $data['testimonials']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="card filterItem" data-aos="fade-up" data-search="" data-tags="<?php echo e($item['category'] ?? ''); ?>">
                    <?php if(!empty($item['category'])): ?><span class="cardBadge"><?php echo e($item['category']); ?></span><?php endif; ?>
                    <p class="prewrap">“<?php echo e($item['quote'] ?? ''); ?>”</p>
                    <h2><?php echo e($item['name'] ?? ''); ?></h2>
                    <?php if(!empty($item['role'])): ?><p><small><?php echo e($item['role']); ?></small></p><?php endif; ?>
                    <?php if(!empty($item['video_url'])): ?>
                        <p><a href="<?php echo e($item['video_url']); ?>" target="_blank" rel="noopener noreferrer"><b>Tonton video</b></a></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="muted">No testimonials added yet.</p>
            <?php endif; ?>
        </div>
    </section>
</div>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/portfolio/testimonials.blade.php ENDPATH**/ ?>