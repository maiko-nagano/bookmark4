<?php
// 0. SESSION開始！！
session_start();

//   関数群の読み込み
require_once('funcs.php');

loginCheck();


// 1. POSTデータ取得
$book_name = $_POST['book_name']; // ブックマーク名を取得
$book_url = $_POST['book_url']; // URLを取得
$book_comment = $_POST['book_comment']; // コメントを取得
//SESSIONからuser_id番号をとってくる
$user_id = $_SESSION['user_id'];

// 2. URLのバリデーション
if (filter_var($book_url, FILTER_VALIDATE_URL)) {
    // 正しいURLの場合の処理
    // データベースに登録などの処理を追加してください

// 2-2.画像アップロードの処理
$image_path = '';

//isset 該当するデータが存在するかチェックする関数
//ファイルデータが送られてきた場合のみ画像保存に関連する処理を行う
if(isset($_FILES['image'])){

    //imageの部分はinput type"file"のname属性に相当する 必要に応じ書き換える場所
    $upload_file = $_FILES['image']['tmp_name'];
    // var_dump($_FILES['image']);

    //フォルダ名を取得。今回は直書き
    $dir_name = 'img/';

    //画像の拡張子を取得。jpgとかpngとかの部分
    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    //画像名を取得。uniqid()を使って独自のIDを付与
    $file_name = uniqid() . '.' . $extension;

    //画像の保存場所を設定
    $image_path = $dir_name . $file_name;

    //一時的に保管されてるファイルをimage_pathに移動させる
    //if文の中で関数自体が実行される書き方をする場合、成功か失敗かが条件に設定される
    //失敗した場合はエラー表示を出して終了にする
    //どのファイルをどの場所に？
    if(!move_uploaded_file($upload_file, $image_path)){
        exit('ファイルの保存に失敗しました');
    }
}


    // 3. DB接続します
    require_once('funcs.php');
    $pdo = db_conn();

    // 4. データ登録SQL作成
    $stmt = $pdo->prepare("INSERT INTO gs_bookmark_table(user_id, book_name, book_url, book_comment, image, date) VALUES(:user_id, :book_name, :book_url, :book_comment, :image, NOW())");

    // 5. バインド変数を用意
    // Integer 数値の場合 PDO::PARAM_INT
    // String文字列の場合 PDO::PARAM_STR
    $stmt->bindValue(':book_name', $book_name, PDO::PARAM_STR);
    $stmt->bindValue(':book_url', $book_url, PDO::PARAM_STR);
    $stmt->bindValue(':book_comment', $book_comment, PDO::PARAM_STR);
    $stmt->bindValue(':image', $image_path, PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    

    // 6. 実行
    $status = $stmt->execute();

    // 7. データ登録処理後
    if ($status == false) {
        sql_error($stmt);
      } else {
        redirect('index.php');
      }
} else {
    // 正しくないURLの場合の処理
    echo '無効なURLです。<br>'; // 改行を追加
    echo '<a href="index.php">ブックマーク登録画面に戻る</a>'; // リンクを表示
}
?>