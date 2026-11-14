<div class="section" id="messages">
    <h2>Pesan Masuk (Kesan & Pesan)</h2>
    <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="item-row">
            <div class="message-box <?php echo e(empty($message['read']) ? 'unread' : ''); ?>">
                <div class="message-head">
                    <b><?php echo e($message['name'] ?? ''); ?></b>
                    <?php if(!empty($message['relation'])): ?><span class="hint">(<?php echo e($message['relation']); ?>)</span><?php endif; ?>
                    <span class="hint"><?php echo e($message['created_at'] ?? ''); ?></span>
                </div>
                <?php if(!empty($message['email'])): ?><div class="hint"><?php echo e($message['email']); ?></div><?php endif; ?>
                <p><?php echo e($message['message'] ?? ''); ?></p>
            </div>
            <div class="action-btns">
                <?php if(empty($message['read'])): ?>
                    <form method="POST" action="<?php echo e(route('admin.message.read')); ?>">
                        <?php echo csrf_field(); ?> <input type="hidden" name="id" value="<?php echo e($message['id']); ?>">
                        <button class="btn btn-yellow">Tandai dibaca</button>
                    </form>
                <?php endif; ?>
                <form method="POST" action="<?php echo e(route('admin.message.delete')); ?>" onsubmit="return confirm('Hapus pesan ini?')">
                    <?php echo csrf_field(); ?> <input type="hidden" name="id" value="<?php echo e($message['id']); ?>">
                    <button class="btn btn-red">Hapus</button>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="hint">Belum ada pesan masuk.</p>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\ASUS\Documents\xampp\portfoliofix\resources\views/admin/messages.blade.php ENDPATH**/ ?>