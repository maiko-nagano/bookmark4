<?php
// 0. SESSION開始！！
session_start();

// 1. DB接続します
require_once('funcs.php');
loginCheck();

// 1. POSTデータ取得
$date = $_POST['date'];
$book_name = $_POST['book_name'];
$book_url = $_POST['book_url'];
$book_comment = $_POST['book_comment'];
$id = $_POST['id'];

// 2. DB接続します
$pdo = db_conn();

// 3. 画像のアップロード処理
if (!empty($_FILES['image']['tmp_name'])) {
    $target_file = 'img/' . uniqid() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        // データベースを更新
        $stmt = $pdo->prepare("UPDATE gs_bookmark_table SET date = :date, book_name = :book_name, book_url = :book_url, book_comment = :book_comment, image = :image WHERE id = :id");
        $stmt->bindValue(':image', $target_file, PDO::PARAM_STR);
    } else {
        echo "画像のアップロードに失敗しました。";
        exit;
    }
} else {
    // 画像がアップロードされていない場合は、画像以外のデータのみ更新
    $stmt = $pdo->prepare("UPDATE gs_bookmark_table SET date = :date, book_name = :book_name, book_url = :book_url, book_comment = :book_comment WHERE id = :id");
}

// 4. データベースの更新
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':book_name', $book_name, PDO::PARAM_STR);
$stmt->bindValue(':book_url', $book_url, PDO::PARAM_STR);
$stmt->bindValue(':book_comment', $book_comment, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// 5. データ更新処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect('select.php');
}
?>