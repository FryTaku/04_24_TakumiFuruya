<?php
//1. POSTデータ取得
//まず前のphpからデーターを受け取る（この受け取ったデータをもとにbindValueと結びつけるため）

$Name_A = $_POST["Name_A"];
$TriggerGS = $_POST["TriggerGS"];
$Checkbox = $_POST["Checkbox"];
$Details = $_POST["Details"];

//2. DB接続します xxxにDB名を入力する
//ここから作成したDBに接続をしてデータを登録します xxxxに作成したデータベース名を書きます
try {
  $pdo = new PDO('mysql:dbname=gs_contact;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成 //ここにカラム名を入力する
//xxx_table(テーブル名)はテーブル名を入力します
$stmt = $pdo->prepare("INSERT INTO gs_contact_table(id, Name_A, TriggerGS, Checkbox, Details )VALUES(NULL, :Name_A, :TriggerGS, :Checkbox, :Details)");
$stmt->bindValue(':Name_A', $Name_A, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':TriggerGS', $TriggerGS, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':Checkbox', $Checkbox, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':Details', $Details, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //５．index.phpへリダイレクト 書くときにLocation: in この:　のあとは半角スペースがいるので注意！！
  header("Location: select.php");
  exit;

}
?>