<?php
    $profile = $data['profile'];
    $classLine = collect([$profile['class'], $profile['competency'], $profile['school']])->filter()->implode(' · ');
?>
<div data-aos="fade-up" class="section s01" id="home">
    <section class="row2">
        <div data-aos="fade-up" class="boxD">
            <h2>Hello! I'm</h2>
            <h1 class="namaGweh"><?php echo e($profile['name']); ?></h1>
            <?php if($profile['headline']): ?>
                <div class="secondaryColoredBox"><h3><?php echo e($profile['headline']); ?></h3></div>
            <?php endif; ?>
            <?php if($classLine): ?><p class="classLine"><?php echo e($classLine); ?></p><?php endif; ?>
            <?php if($profile['tagline']): ?><p><?php echo e($profile['tagline']); ?></p><?php endif; ?>

            <?php if($mainSkills): ?>
                <div class="chips" aria-label="Keahlian utama">
                    <?php $__currentLoopData = $mainSkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><span class="chip static"><?php echo e($skill); ?></span><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <div class="btnRow">
                <a href="#project" class="btn">Lihat Portfolio</a>
                <a href="#cv" class="btn ghost">Lihat CV</a>
                <a href="#contact" class="btn ghost">Hubungi Saya</a>
            </div>
        </div>
        <div data-aos="fade-up" class="boxD centeredDiv">
            <?php if(!empty($data['profile_photo'])): ?>
                <img src="/uploads/<?php echo e($data['profile_photo']); ?>" class="profilePhoto" alt="Foto <?php echo e($profile['name']); ?>">
            <?php else: ?>
                <div class="avatarFallback" aria-hidden="true"><?php echo e(mb_strtoupper(mb_substr($profile['name'], 0, 1))); ?></div>
            <?php endif; ?>
        </div>
    </section>
</div>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/portfolio/home.blade.php ENDPATH**/ ?>