<?php
    $profile = $data['profile'];
    $profileFields = [
        'name'        => ['Nama lengkap', 'text'],
        'headline'    => ['Headline / profesi', 'text'],
        'class'       => ['Kelas', 'text'],
        'school'      => ['Sekolah', 'text'],
        'competency'  => ['Kompetensi keahlian', 'text'],
        'tagline'     => ['Deskripsi singkat / personal branding', 'textarea'],
        'main_skills' => ['Keahlian utama (pisahkan dengan koma)', 'text'],
        'birth'       => ['Tempat, tanggal lahir', 'text'],
        'address'     => ['Alamat', 'text'],
        'tech_fields' => ['Bidang teknologi yang dikuasai (pisahkan dengan koma)', 'text'],
        'career_goal' => ['Cita-cita / tujuan karir', 'textarea'],
    ];
?>

<div id="profile">
    <div class="section">
        <h2>Foto Profil</h2>
        <div class="profile-section">
            <div class="profile-current">
                <?php if(!empty($data['profile_photo'])): ?>
                    <img src="/uploads/<?php echo e($data['profile_photo']); ?>" alt="Foto profil">
                <?php else: ?>
                    <div class="no-photo">No Photo</div>
                <?php endif; ?>
            </div>
            <div class="profile-form">
                <form method="POST" action="<?php echo e(route('admin.photo')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <label>Upload Foto Baru</label>
                    <input type="file" name="photo" accept="image/*">
                    <?php if(!empty($data['profile_photo'])): ?>
                        <label class="delete-img-row"><input type="checkbox" name="delete_photo" value="1"> Hapus foto sekarang</label>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-green">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <div class="section">
        <h2>Informasi Profil</h2>
        <form method="POST" action="<?php echo e(route('admin.profile')); ?>">
            <?php echo csrf_field(); ?>
            <?php $__currentLoopData = $profileFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => [$label, $type]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label><?php echo e($label); ?></label>
                <?php if($type === 'textarea'): ?>
                    <textarea name="<?php echo e($name); ?>"><?php echo e($profile[$name] ?? ''); ?></textarea>
                <?php else: ?>
                    <input type="text" name="<?php echo e($name); ?>" value="<?php echo e($profile[$name] ?? ''); ?>" <?php if($name === 'name'): ?> required <?php endif; ?>>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <button type="submit" class="btn btn-green">Simpan</button>
        </form>
    </div>

    <div class="section">
        <h2>About Me</h2>
        <form method="POST" action="<?php echo e(route('admin.about')); ?>">
            <?php echo csrf_field(); ?>
            <label>Teks About</label>
            <textarea name="about"><?php echo e($data['about'] ?? ''); ?></textarea>
            <button type="submit" class="btn btn-green">Simpan</button>
        </form>
    </div>

    <div class="section">
        <h2>Kontak & Social Media</h2>
        <form method="POST" action="<?php echo e(route('admin.socials')); ?>">
            <?php echo csrf_field(); ?>
            <?php $__currentLoopData = ['email' => 'Email', 'github' => 'Link GitHub', 'instagram' => 'Link Instagram', 'linkedin' => 'Link LinkedIn']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label><?php echo e($label); ?></label>
                <input type="text" name="<?php echo e($name); ?>" value="<?php echo e($data['socials'][$name] ?? ''); ?>">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <button type="submit" class="btn btn-green">Simpan</button>
        </form>
    </div>

    <div class="section">
        <h2>File CV (PDF)</h2>
        <?php if(!empty($data['cv_file'])): ?>
            <p class="hint">CV saat ini: <a href="/uploads/<?php echo e($data['cv_file']); ?>" target="_blank"><?php echo e($data['cv_file']); ?></a></p>
        <?php endif; ?>
        <form method="POST" action="<?php echo e(route('admin.cv')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <label>Upload CV baru (PDF, maks. 5 MB)</label>
            <input type="file" name="cv" accept="application/pdf" required>
            <button type="submit" class="btn btn-green">Upload</button>
        </form>
        <?php if(!empty($data['cv_file'])): ?>
            <form method="POST" action="<?php echo e(route('admin.cv')); ?>" onsubmit="return confirm('Hapus file CV?')" style="margin-top:10px">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="delete_cv" value="1">
                <button type="submit" class="btn btn-red">Hapus file CV</button>
            </form>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/admin/profile.blade.php ENDPATH**/ ?>