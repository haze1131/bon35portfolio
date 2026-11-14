<div data-aos="fade-up" class="section s08" id="learning-log">
    <section data-filter>
        <h1>Blog / Catatan Ngoding</h1>

        <div class="filterBar">
            <input type="search" placeholder="Cari artikel..." aria-label="Cari artikel">
            <?php if(count($logCategories) > 1): ?>
                <button type="button" class="chip active" data-tag="">Semua</button>
                <?php $__currentLoopData = $logCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><button type="button" class="chip" data-tag="<?php echo e($category); ?>"><?php echo e($category); ?></button><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <div class="flexWrap cardGrid">
            <?php $__empty_1 = true; $__currentLoopData = $data['learning_logs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <article class="card filterItem" data-aos="fade-up"
                         data-search="<?php echo e(mb_strtolower(($item['title'] ?? '') . ' ' . ($item['excerpt'] ?? '') . ' ' . ($item['content'] ?? ''))); ?>"
                         data-tags="<?php echo e($item['category'] ?? ''); ?>">
                    <?php if(!empty($item['image'])): ?><img src="/uploads/<?php echo e($item['image']); ?>" alt="<?php echo e($item['title'] ?? ''); ?>" data-lightbox><?php endif; ?>
                    <?php if(!empty($item['category'])): ?><span class="cardBadge"><?php echo e($item['category']); ?></span><?php endif; ?>
                    <h2><?php echo e($item['title'] ?? ''); ?></h2>
                    <?php if(!empty($item['date'])): ?><small><?php echo e($item['date']); ?></small><?php endif; ?>
                    <?php if(!empty($item['excerpt'])): ?><p><?php echo e($item['excerpt']); ?></p><?php endif; ?>
                    <?php if(!empty($item['content'])): ?>
                        <details>
                            <summary>Baca selengkapnya</summary>
                            <p class="prewrap"><?php echo e($item['content']); ?></p>
                        </details>
                    <?php endif; ?>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="muted">No articles added yet.</p>
            <?php endif; ?>
        </div>
        <p class="filterEmpty muted" hidden>Tidak ada artikel yang cocok.</p>
    </section>
</div>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/portfolio/blog.blade.php ENDPATH**/ ?>