メッセージフィールド中で、"変数"を利用できます。この変数は、ユーザにとって適切な値で置換されます。
<br />変数は<b>[NAME]</b>のような形式で使用する必要があり、NAMEは、属性の一つの名前で置換されます。 
<br />例えば、もし属性"First Name"をもっているなら、メッセージ中で、受信者の"First Name"の値を挿入する必要がある位置に[FIRST NAME]と記述してください。
</p><p>現在次の属性を定義できます。
<?php

print listPlaceHolders();

if (ENABLE_RSS) {
?>
  <p>RSSアイテムを配信するためにメッセージのテンプレートを設定することができます。RSSアイテムを配信するためには、"スケジュール"タブをクリックして、メッセージの頻度を指定してください。 メッセージは、そのとき、頻度を設定しているリスト上のユーザに、アイテムのリストを送信するために使用されます。上手くいくためには、メッセージ中にプレースホルダー[RSS]を含める必要があります。</p>
<?php }
?>

<p>ウェブページのコンテンツを送信するためには、メッセージのコンテンツに下記を追加してください。<br/>
<b>[URL:</b>http://www.example.org/path/to/file.html<b>]</b></p>
<p>このURLに基本的なユーザ情報を含めることもできます。属性情報は含めることはできません。</br>
<b>[URL:</b>http://www.example.org/userprofile.php?email=<b>[</b>email<b>]]</b><br/>
</p>
