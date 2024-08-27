<?php
// 0. SESSION開始！！
session_start();

// 1.  関数群の読み込み
require_once('funcs.php');

loginCheck();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ブックマーク登録</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav>
            <span><?= htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8') ?>さん</span>
            <a href="select.php">ブックマーク一覧</a>
            <a href="user.php">ユーザー登録</a>
            <form class="logout-form" action="logout.php" method="post" onsubmit="return confirm('本当にログアウトしますか？');">
                <button type="submit" class="logout-button">ログアウト</button>
            </form>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <main>
        <form method="POST" action="insert.php" enctype="multipart/form-data">
            <fieldset>
                <legend>ブックマーク登録</legend>
                <label for="book_name">サイト名</label>
                <input type="text" id="book_name" name="book_name" required placeholder="タイトル">

                <label for="book_url">URL</label>
                <input type="text" id="book_url" name="book_url" required placeholder="https://xxx.com">

                <label for="book_comment">コメント</label>
                <textarea id="book_comment" name="book_comment" rows="4" required placeholder="メモを残しましょう"></textarea>

                <label for="image">画像</label>
                <input type="file" id="image" name="image">

                <input type="submit" value="送信する">
            </fieldset>
        </form>
    </main>
    <!-- Main[End] -->

</body>

</html>