<?php
    $profile = $data['profile'];
    $biodata = array_filter([
        'Nama lengkap'          => $profile['name'],
        'Tempat, tanggal lahir' => $profile['birth'],
        'Alamat'                => $profile['address'],
        'Sekolah'               => $profile['school'],
        'Kelas'                 => $profile['class'],
        'Kompetensi keahlian'   => $profile['competency'],
    ]);
    $interestTitles = array_filter(array_column($data['interests'], 'title'));
    $interestChips  = array_values(array_unique(array_merge($techFields, $interestTitles)));
?>
<div data-aos="fade-up" class="section s02" id="about">
    <section>
        <div class="row2">
            <div data-aos="fade-up" class="boxD">
                <img src="/assets/ask.svg" width="50%" alt="">
            </div>
            <div data-aos="fade-up" class="boxD">
                <h1>About Me</h1>
                <p class="prewrap"><?php echo e($data['about']); ?></p>
            </div>
        </div>

        <div class="aboutGrid">
            <div class="aboutCard" data-aos="fade-up">
                <h3>Biodata Singkat</h3>
                <dl>
                    <?php $__currentLoopData = $biodata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <dt><?php echo e($label); ?></dt><dd><?php echo e($value); ?></dd>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </dl>
            </div>

            <div class="aboutCard" data-aos="fade-up">
                <h3>Riwayat Pendidikan</h3>
                <?php if($data['educations']): ?>
                    <ul class="timeline">
                        <?php $__currentLoopData = $data['educations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <b><?php echo e($edu['school'] ?? ''); ?></b>
                                <?php if(!empty($edu['period'])): ?><small><?php echo e($edu['period']); ?></small><?php endif; ?>
                                <?php if(!empty($edu['desc'])): ?><p class="prewrap"><?php echo e($edu['desc']); ?></p><?php endif; ?>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    <p class="muted">Belum ada riwayat pendidikan.</p>
                <?php endif; ?>
            </div>

            <div class="aboutCard" data-aos="fade-up">
                <h3>Minat &amp; Bidang Teknologi</h3>
                <?php if($interestChips): ?>
                    <div class="chips"><?php $__currentLoopData = $interestChips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><span class="chip static"><?php echo e($chip); ?></span><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
                <?php else: ?>
                    <p class="muted">Belum diisi.</p>
                <?php endif; ?>
            </div>

            <?php $__currentLoopData = ['Organisasi' => 'Pengalaman Organisasi / Kepanitiaan', 'PLK' => 'Pengalaman PLK']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="aboutCard" data-aos="fade-up">
                    <h3><?php echo e($title); ?></h3>
                    <?php $__empty_1 = true; $__currentLoopData = $experienceGroups[$group]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <p><b><?php echo e($item['title'] ?? ''); ?></b><?php if(!empty($item['place'])): ?> — <?php echo e($item['place']); ?><?php endif; ?>
                            <?php if(!empty($item['period'])): ?><br><small class="muted"><?php echo e($item['period']); ?></small><?php endif; ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="muted">Belum ada data.</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="aboutCard" data-aos="fade-up">
                <h3>Cita-cita / Tujuan Karir</h3>
                <?php if($profile['career_goal']): ?>
                    <p class="prewrap"><?php echo e($profile['career_goal']); ?></p>
                <?php else: ?>
                    <p class="muted">Belum diisi.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/portfolio/about.blade.php ENDPATH**/ ?>