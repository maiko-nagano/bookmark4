<?php
// 0. SESSION開始！！
session_start();

// 1. DB接続します
require_once('funcs.php');

loginCheck();

// 2. データ取得SQL作成
$pdo = db_conn();
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM gs_bookmark_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// 3. データ表示
if ($status == false) {
    sql_error($stmt);
  } else {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ブックマーク編集</title>
  <link href="css/style.css" rel="stylesheet">
</head>
<body id="main">
  <header>
    <nav>
    <span><?= htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8') ?>さん</span>
      <a href="select.php">ブックマーク一覧</a>
      <form class="logout-form" action="logout.php" method="post" onsubmit="return confirm('本当にログアウトしますか？');">
    <button type="submit" class="logout-button">ログアウト</button>
  </form>
    </nav>
  </header>
  <main>
    <div class="container">
      <h1>ブックマーク編集</h1>
      <form method="POST" action="update.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8') ?>">
        <label for="date">日付:</label>
        <input type="text" name="date" value="<?= htmlspecialchars($result['date'], ENT_QUOTES, 'UTF-8') ?>"><br>
        <label for="book_name">サイト名:</label>
        <input type="text" name="book_name" value="<?= htmlspecialchars($result['book_name'], ENT_QUOTES, 'UTF-8') ?>"><br>
        <label for="book_url">URL:</label>
        <input type="text" name="book_url" value="<?= htmlspecialchars($result['book_url'], ENT_QUOTES, 'UTF-8') ?>"><br>
        <label for="book_comment">コメント:</label>
        <textarea name="book_comment"><?= htmlspecialchars($result['book_comment'], ENT_QUOTES, 'UTF-8') ?></textarea><br>
        <label for="image">画像:</label>
            <input type="file" name="image">
            <?php if (!empty($result['image'])) { echo '<img src="' . h($result['image']) . '" class="image-class">'; } ?>
        <input type="submit" value="更新">
      </form>
    </div>
  </main>
  <script src='js/script.js'></script>
</body>
</html>