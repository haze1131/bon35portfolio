<?php
    $profile = $data['profile'];
    $contacts = collect($links)->map(fn ($l) => $l['label'] === 'Email' || str_contains($l['href'], 'mailto:') ? $l['label'] : $l['href'])->values();
?>
<div data-aos="fade-up" class="section s10" id="cv">
    <section>
        <h1>CV Digital</h1>
        <div class="btnRow">
            <?php if(!empty($data['cv_file'])): ?>
                <a class="btn" href="/uploads/<?php echo e($data['cv_file']); ?>" target="_blank" rel="noopener noreferrer" download>Unduh CV (PDF)</a>
            <?php endif; ?>
            <button type="button" class="btn ghost" id="printCv">Cetak / Simpan PDF</button>
        </div>

        <article class="cvSheet">
            <div class="cvHead">
                <h1><?php echo e($profile['name']); ?></h1>
                <p><b><?php echo e($profile['headline']); ?></b></p>
                <p><?php echo e(collect([$profile['class'], $profile['competency'], $profile['school']])->filter()->implode(' · ')); ?></p>
                <p><?php echo e($contacts->implode(' | ')); ?></p>
            </div>

            <?php if($data['about']): ?>
                <h2>Profil</h2>
                <p class="prewrap"><?php echo e($data['about']); ?></p>
            <?php endif; ?>

            <?php if($data['educations']): ?>
                <h2>Pendidikan</h2>
                <?php $__currentLoopData = $data['educations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <h3><?php echo e($edu['school'] ?? ''); ?> <small><?php echo e($edu['period'] ?? ''); ?></small></h3>
                    <?php if(!empty($edu['desc'])): ?><p><?php echo e($edu['desc']); ?></p><?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <div class="cvCols">
                <?php $__currentLoopData = ['hard' => 'Hard Skill', 'soft' => 'Soft Skill']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($skillGroups[$key]): ?>
                        <div>
                            <h2><?php echo e($title); ?></h2>
                            <ul><?php $__currentLoopData = $skillGroups[$key]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($skill['name']); ?> — <?php echo e($skill['level']); ?>%</li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php $__currentLoopData = ['PLK' => 'Pengalaman PLK', 'Organisasi' => 'Organisasi / Kepanitiaan', 'Lomba' => 'Lomba']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($experienceGroups[$group]): ?>
                    <h2><?php echo e($title); ?></h2>
                    <?php $__currentLoopData = $experienceGroups[$group]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <h3><?php echo e($item['title'] ?? ''); ?> <small><?php echo e($item['period'] ?? ''); ?></small></h3>
                        <?php if(!empty($item['place'])): ?><p><?php echo e($item['place']); ?></p><?php endif; ?>
                        <?php if(!empty($item['desc'])): ?><p><?php echo e($item['desc']); ?></p><?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if($data['certificates']): ?>
                <h2>Sertifikat &amp; Prestasi</h2>
                <ul>
                    <?php $__currentLoopData = $data['certificates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($cert['title'] ?? ''); ?><?php if(!empty($cert['issuer'])): ?> — <?php echo e($cert['issuer']); ?><?php endif; ?> <?php if(!empty($cert['year'])): ?>(<?php echo e($cert['year']); ?>)<?php endif; ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>

            <?php if($projects): ?>
                <h2>Proyek</h2>
                <ul>
                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($project['title']); ?><?php if($project['tech']): ?> — <?php echo e(implode(', ', $project['tech'])); ?><?php endif; ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
        </article>
    </section>
</div>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/portfolio/cv.blade.php ENDPATH**/ ?>