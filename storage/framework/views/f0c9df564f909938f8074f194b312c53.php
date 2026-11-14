
<?php
    $items = $data[$cfg['key']] ?? [];
    $imageField = $cfg['image'] ?? null;
?>
<div class="section" id="sec-<?php echo e($slug); ?>">
    <h2><?php echo e($cfg['label']); ?> <span class="count"><?php echo e(count($items)); ?></span></h2>

    <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="item-row">
            <details>
                <summary>
                    <?php if($imageField && !empty($item[$imageField])): ?><img class="thumb" src="/uploads/<?php echo e($item[$imageField]); ?>" alt=""><?php endif; ?>
                    <span class="item-title"><?php echo e($item[$cfg['title']] ?? ''); ?></span>
                    <?php $__currentLoopData = $cfg['meta']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metaField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $field = $cfg['fields'][$metaField];
                            $metaValue = $item[$metaField] ?? '';
                            if (!empty($field['options'])) $metaValue = $field['options'][$metaValue] ?? $metaValue;
                            if ($metaField === 'level') $metaValue .= '%';
                        ?>
                        <?php if($metaValue !== '' && $metaValue !== '%'): ?><small class="meta"><?php echo e(\Illuminate\Support\Str::limit((string) $metaValue, 50)); ?></small><?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </summary>
                <form method="POST" action="<?php echo e(route('admin.' . $slug . '.edit')); ?>" enctype="multipart/form-data" class="add-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="<?php echo e($item['id']); ?>">
                    <?php echo $__env->make('admin.fields', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <button type="submit" class="btn btn-green">Simpan perubahan</button>
                </form>
            </details>
            <form method="POST" action="<?php echo e(route('admin.' . $slug . '.delete')); ?>" onsubmit="return confirm('Hapus data ini?')">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($item['id']); ?>">
                <button type="submit" class="btn btn-red">Hapus</button>
            </form>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="hint">Belum ada data.</p>
    <?php endif; ?>

    <div class="add-form">
        <b>Tambah <?php echo e($cfg['item']); ?></b>
        <form method="POST" action="<?php echo e(route('admin.' . $slug . '.add')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo $__env->make('admin.fields', ['item' => []], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <button type="submit" class="btn btn-green">Tambah</button>
        </form>
    </div>
</div>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/admin/section.blade.php ENDPATH**/ ?>