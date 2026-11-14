<div data-aos="fade-up" class="section s04" id="interest">
    <section>
        <h1>Interest</h1>
        <div class="interestGrid">
            <?php $__currentLoopData = $data['interests']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $bg = !empty($interest['image']) ? '/uploads/' . $interest['image'] : '/assets/interestImgPlaceholder.png'; ?>
                <a href="<?php echo e(!empty($interest['link']) ? $interest['link'] : '#'); ?>" class="interestCard" style="background-image: url('<?php echo e($bg); ?>')">
                    <div class="interestOverlay">
                        <div class="interestContent">
                            <h2 class="interestTitle"><?php echo e($interest['title']); ?></h2>
                            <p class="interestDesc"><?php echo e($interest['desc'] ?? ''); ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
</div>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/portfolio/interests.blade.php ENDPATH**/ ?>