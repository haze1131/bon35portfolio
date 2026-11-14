<?php $groupTitles = ['PLK' => 'Pengalaman PLK', 'Organisasi' => 'Pengalaman Organisasi', 'Lomba' => 'Pengalaman Lomba', 'Lainnya' => 'Aktivitas Lainnya']; ?>
<div data-aos="fade-up" class="section s06" id="experience">
    <section>
        <h1>Experience & Activities</h1>
        <?php $hasAny = (bool) array_filter($experienceGroups); ?>
        <?php $__currentLoopData = $groupTitles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($experienceGroups[$group]): ?>
                <div class="expGroup">
                    <h3 class="subTitle"><?php echo e($title); ?></h3>
                    <div data-aos="fade-up" class="column">
                        <?php $__currentLoopData = $experienceGroups[$group]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="longCard">
                                <h3><?php echo e($item['title'] ?? ''); ?></h3>
                                <?php if(!empty($item['period'])): ?><p><?php echo e($item['period']); ?></p><?php endif; ?>
                                <?php if(!empty($item['place'])): ?><p><?php echo e($item['place']); ?></p><?php endif; ?>
                                <?php if(!empty($item['desc'])): ?><p class="prewrap"><?php echo e($item['desc']); ?></p><?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if (! ($hasAny)): ?><p class="muted">No experience added yet.</p><?php endif; ?>
    </section>
</div>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/portfolio/experience.blade.php ENDPATH**/ ?>