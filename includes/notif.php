<?php if (isset($_GET['error'])): ?>
    <div id="notification" class="alert error">
        <?= htmlspecialchars($_GET['error']) ?>
    </div>
    <?php elseif (isset($_GET['success'])): ?>
    <div id="notification" class="alert success">
        <?= htmlspecialchars($_GET['success']) ?>
    </div>
<?php endif; ?>
