<?php
//SESSION使うよ！
session_start();

// 関数群の読み込み
require_once('funcs.php');
loginCheck();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームから送信されたデータを取得
    $name = $_POST['name'];
    $lid = $_POST['lid'];
    $lpw = password_hash($_POST['lpw'], PASSWORD_DEFAULT); // パスワードをハッシュ化
    $kanri_flg = $_POST['kanri_flg'];

    // データベースに接続    
    $pdo = db_conn();

    // データベースにユーザー情報を挿入
    $sql = "INSERT INTO gs_user_table(name,lid,lpw,kanri_flg,life_flg)VALUES(:name,:lid,:lpw,:kanri_flg,0)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':lid', $lid, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)

    // 実行
    $status = $stmt->execute();

    // データ登録処理後
    if ($status == false) {
        sql_error($stmt);
      } else {
        redirect('user.php');
      }
} 
?>
