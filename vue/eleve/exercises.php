<?php
require_once __DIR__ . '/../../includes/functions.php';
startSession();

if (empty($_SESSION['user_id'])) {
    redirect(BASE_URL . '/login');
}

$user = getUserData($_SESSION['user_id']);
if (!$user) {
    redirect(BASE_URL . '/login');
}

$exercises = getExercisesByStudent($_SESSION['user_id']);
?>

<?php include('../../includes/header.php'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.59.4/codemirror.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.59.4/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.59.4/mode/python/python.min.js"></script>

<div class="exercise">
    <h3><?= htmlspecialchars($exercise['title']) ?></h3>
    <p><?= htmlspecialchars($exercise['description']) ?></p>

    <form method="post" action="<?= BASE_URL . '/submit_exercise' ?>">
        <textarea id="code-editor" name="code"><?= htmlspecialchars($exercise['code']) ?></textarea>
        <button type="submit">Soumettre</button>
    </form>
</div>

<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("code-editor"), {
        lineNumbers: true,
        mode: "python",
        theme: "default"
    });
</script>

<?php include('../includes/footer.php'); ?>
