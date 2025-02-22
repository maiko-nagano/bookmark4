<?php
// 最初にSESSIONを開始！！ココ大事！！
session_start();

// POST値を受け取る
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];

// 1. DB接続します
require_once('funcs.php');
$pdo = db_conn();

// 2. データ登録SQL作成
// gs_user_tableに、IDとWPがあるか確認する。SELECTは調べる
$stmt = $pdo->prepare('SELECT * FROM gs_user_table WHERE lid = :lid');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

// 3. SQL実行時にエラーがある場合STOP
if ($status === false) {
    sql_error($stmt);
}

// 4. 抽出データ数を取得
$val = $stmt->fetch();

// パスワードの照合
if ($val['id'] != '' && password_verify($lpw, $val['lpw'])) {
    // Login成功時 該当レコードがあればSESSIONに値を代入
    $_SESSION['chk_ssid'] = session_id();
    $_SESSION['kanri_flg'] = $val['kanri_flg'];
    $_SESSION['name'] = $val['name'];
    $_SESSION['user_id'] = $val['id']; //SESSION内のuser_idの部分に$valのidを保存する

    header('Location: select.php');
} else {
    // Login失敗時(Logout経由)
    header('Location: login.php');
}

exit();
?>