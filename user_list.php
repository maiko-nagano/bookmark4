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
    <title>ユーザー一覧</title>
    <link href="css/style2.css" rel="stylesheet">
</head>
<body>
<nav class="navbar">
<span><?= htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8') ?>さん</span>
    <a href="select.php">ブックマーク一覧</a>
    <a href="user.php">ユーザー登録</a>
    <form class="logout-form" action="logout.php" method="post" onsubmit="return confirm('本当にログアウトしますか？');">
    <button type="submit" class="logout-button">ログアウト</button>
  </form>
</nav>
<div class="jumbotron">
    <h2>ユーザー一覧</h2>
    <table>
        <tr>
            <th>名前</th>
            <th>Login ID</th>
            <th>管理者フラグ</th>
            <th>有効フラグ</th>
        </tr>
        <?php
        require_once('funcs.php');
        $pdo = db_conn();

        // ユーザー一覧を取得
        $sql = "SELECT * FROM gs_user_table";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // 表示
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . htmlspecialchars($row['lid'], ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . ($row['kanri_flg'] == 1 ? '管理者' : '一般') . '</td>';
            echo '<td>' . ($row['life_flg'] == 1 ? '無効' : '有効') . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>
</body>
</html>