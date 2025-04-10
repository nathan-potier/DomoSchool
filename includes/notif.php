<?php if (isset($_GET['error'])): ?>
    <div class="alert error">
        <?= htmlspecialchars($_GET['error']) ?>
    </div>
    <?php elseif (isset($_GET['success'])): ?>
    <div class="alert success">
        <?= htmlspecialchars($_GET['success']) ?>
    </div>
    <?php endif; ?>
