<? session_start(); ?>

<meta charset="euc-kr">
<?

	if(!$userid) {
		echo("
		<script>
	     window.alert('�α��� �� �̿��� �ּ���.')
	     history.go(-1)
	   </script>
		");
		exit;
	}

	if(!$subject) {
		echo("
	   <script>
	     window.alert('������ �Է��ϼ���.')
	     history.go(-1)
	   </script>
		");
	   exit;
	}

	if(!$content) {
		echo("
	   <script>
	     window.alert('������ �Է��ϼ���.')
	     history.go(-1)
	   </script>
		");
	   exit;
	}
	$regist_day = date("Y-m-d (H:i)");  // ������ '��-��-��-��-��'�� ����
	include "../lib/dbconn.php";       // dconn.php ������ �ҷ���

	if ($mode=="modify")
	{
		$sql = "update $table set subject='$subject', content='$content' where num=$num";
		mysql_query($sql, $connect);  // $sql �� ����� ��� ����
	}
	else
	{
		if ($html_ok=="y")
		{
			$is_html = "y";
		}
		else
		{
			$is_html = "";
			$content = htmlspecialchars($content);
		}

		if ($mode=="response")
		{
			// �θ� �� ��������
			$sql = "select * from $table where num = $num";
			$result = mysql_query($sql, $connect);
			$row = mysql_fetch_array($result);

			// �θ� �۷� ���� group_num, depth, ord �� ����
			$group_num = $row[group_num];
			$depth = $row[depth] + 1;
			$ord = $row[ord] + 1;

			// �ش� �׷쿡�� ord �� �θ���� ord($row[ord]) ���� ū ��쿣
			// ord �� 1 ���� ��Ŵ
			$sql = "update $table set ord = ord + 1 where group_num = $row[group_num] and ord > $row[ord]";
			mysql_query($sql, $connect);  

			// ���ڵ� ����
			$sql = "insert into $table (group_num, depth, ord, id, name, nick, subject,";
			$sql .= "content, regist_day, hit, is_html) ";
			$sql .= "values($group_num, $depth, $ord, '$userid', '$username', '$usernick', '$subject',";
			$sql .= "'$content', '$regist_day', 0, '$is_html')";    

			mysql_query($sql, $connect);  // $sql �� ����� ��� ����
		}
		else
		{
			$depth = 0;   // depth, ord �� 0���� �ʱ�ȭ
			$ord = 0;

			// ���ڵ� ����(group_num ����)
			$sql = "insert into $table (depth, ord, id, name, nick, subject,";
			$sql .= "content, regist_day, hit, is_html) ";
			$sql .= "values($depth, $ord, '$userid', '$username', '$usernick', '$subject',";
			$sql .= "'$content', '$regist_day', 0, '$is_html')";    
			mysql_query($sql, $connect);  // $sql �� ����� ��� ����

			// �ֱ� auto_increment �ʵ�(num) �� ��������
			$sql = "select last_insert_id()"; 
			$result = mysql_query($sql, $connect);
			$row = mysql_fetch_array($result);
			$auto_num = $row[0]; 

			// group_num �� ������Ʈ 
			$sql = "update $table set group_num = $auto_num where num=$auto_num";
			mysql_query($sql, $connect);
		}
	}

	mysql_close();                // DB ���� ����

	echo "
	   <script>
	    location.href = 'list.php?table=$table&page=$page';
	   </script>
	";
?>