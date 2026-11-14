<div data-aos="fade-up" class="section s03" id="skill">
    <section>
        <h1>Skills</h1>
        <div class="skillCols">
            <?php $__currentLoopData = ['hard' => 'Hard Skill (Teknis)', 'soft' => 'Soft Skill (Non-teknis)']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div>
                    <h3 class="subTitle"><?php echo e($title); ?></h3>
                    <?php $__empty_1 = true; $__currentLoopData = $skillGroups[$key]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="skillItem" data-aos="fade-up">
                            <div class="skillHead"><span><?php echo e($skill['name']); ?></span><span><?php echo e($skill['level']); ?>%</span></div>
                            <?php if(!empty($skill['desc'])): ?><small><?php echo e($skill['desc']); ?></small><?php endif; ?>
                            <div class="bar" role="progressbar" aria-valuenow="<?php echo e($skill['level']); ?>" aria-valuemin="0" aria-valuemax="100" aria-label="<?php echo e($skill['name']); ?>">
                                <span style="--level: <?php echo e($skill['level']); ?>%"></span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="muted">Belum ada skill.</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
</div>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/portfolio/skills.blade.php ENDPATH**/ ?>