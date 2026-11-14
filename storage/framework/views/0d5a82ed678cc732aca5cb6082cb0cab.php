
<?php $__currentLoopData = $cfg['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $value = $item[$name] ?? ($field['default'] ?? '');
        $required = str_contains($field['rules'], 'required');
        $listId = !empty($field['suggest']) ? 'dl-' . $slug . '-' . $name : null;
    ?>
    <label><?php echo e($field['label']); ?></label>
    <?php if($field['type'] === 'textarea'): ?>
        <textarea name="<?php echo e($name); ?>" placeholder="<?php echo e($field['placeholder'] ?? ''); ?>" <?php if($required): ?> required <?php endif; ?>><?php echo e($value); ?></textarea>
    <?php elseif($field['type'] === 'select'): ?>
        <select name="<?php echo e($name); ?>">
            <?php $__currentLoopData = $field['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optValue => $optLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($optValue); ?>" <?php if((string) $value === (string) $optValue): echo 'selected'; endif; ?>><?php echo e($optLabel); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    <?php else: ?>
        <input type="<?php echo e($field['type']); ?>" name="<?php echo e($name); ?>" value="<?php echo e($value); ?>" placeholder="<?php echo e($field['placeholder'] ?? ''); ?>"
               <?php $__currentLoopData = ($field['attr'] ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr => $attrValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($attr); ?>="<?php echo e($attrValue); ?>" <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <?php if($listId): ?> list="<?php echo e($listId); ?>" <?php endif; ?>
               <?php if($required): ?> required <?php endif; ?>>
        <?php if($listId): ?>
            <datalist id="<?php echo e($listId); ?>"><?php $__currentLoopData = $field['suggest']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($option); ?>"><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></datalist>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php if(!empty($cfg['image'])): ?>
    <?php $imageField = $cfg['image']; ?>
    <?php if(!empty($item[$imageField])): ?>
        <img class="img-preview" src="/uploads/<?php echo e($item[$imageField]); ?>" alt="">
        <label class="delete-img-row"><input type="checkbox" name="delete_image" value="1"> Hapus gambar sekarang</label>
    <?php endif; ?>
    <label><?php echo e(empty($item[$imageField]) ? 'Upload gambar' : 'Ganti gambar'); ?></label>
    <input type="file" name="<?php echo e($imageField); ?>" accept="image/*">
<?php endif; ?>

<?php if(!empty($cfg['gallery'])): ?>
    <?php $galleryField = $cfg['gallery']; ?>
    <?php if(!empty($item[$galleryField])): ?>
        <label>Dokumentasi saat ini (centang untuk menghapus)</label>
        <div class="gallery-edit">
            <?php $__currentLoopData = $item[$galleryField]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="gallery-thumb">
                    <img src="/uploads/<?php echo e($file); ?>" alt="">
                    <input type="checkbox" name="remove_<?php echo e($galleryField); ?>[]" value="<?php echo e($file); ?>"> hapus
                </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
    <label>Tambah foto dokumentasi proses (bisa lebih dari satu)</label>
    <input type="file" name="<?php echo e($galleryField); ?>[]" accept="image/*" multiple>
<?php endif; ?>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/admin/fields.blade.php ENDPATH**/ ?>