<div data-aos="fade-up" class="section s05" id="project">
    <section data-filter>
        <h1>Projects</h1>

        <div class="filterBar">
            <input type="search" placeholder="Cari proyek..." aria-label="Cari proyek">
            <?php if($projectTags): ?>
                <button type="button" class="chip active" data-tag="">Semua</button>
                <?php $__currentLoopData = $projectTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><button type="button" class="chip" data-tag="<?php echo e($tag); ?>"><?php echo e($tag); ?></button><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <div class="flexWrap">
            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card project filterItem" data-aos="fade-up"
                     data-search="<?php echo e(mb_strtolower($project['title'] . ' ' . $project['desc'] . ' ' . implode(' ', $project['tech']))); ?>"
                     data-tags="<?php echo e(implode('|', $project['tech'])); ?>">
                    <?php if($project['image']): ?><img src="<?php echo e($project['image']); ?>" alt="<?php echo e($project['title']); ?>"><?php endif; ?>
                    <h2><?php echo e($project['title']); ?></h2>
                    <?php if($project['tech']): ?><p><small><?php echo e(implode(' · ', $project['tech'])); ?></small></p><?php endif; ?>
                    <p><?php echo e(\Illuminate\Support\Str::limit($project['desc'], 110)); ?></p>
                    <div class="btnRow">
                        <button type="button" class="btn" data-preview="<?php echo e($project['id']); ?>">Preview</button>
                        <?php if($project['demo_url']): ?><a class="btn ghost" href="<?php echo e($project['demo_url']); ?>" target="_blank" rel="noopener noreferrer">Demo</a><?php endif; ?>
                        <?php if($project['source_url']): ?><a class="btn ghost" href="<?php echo e($project['source_url']); ?>" target="_blank" rel="noopener noreferrer">GitHub</a><?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <p class="filterEmpty muted" <?php if(count($projects)): ?> hidden <?php endif; ?>>Tidak ada proyek yang cocok.</p>
    </section>
</div>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/portfolio/projects.blade.php ENDPATH**/ ?>