<html>
 <head>
  <title> �������� </title>
  <link rel="stylesheet" href="../css/survey.css" type="text/css">	
  <meta charset="euc-kr">
  <script>
      function update()
      {
        var vote;
        var length = document.survey_form.composer.length; 

        for (var i=0; i<length; i++)
        {
           if (document.survey_form.composer[i].checked == true)
           {
                vote= document.survey_form.composer[i].value;
                break;
           }
        }

        if (i == length)
        {
           alert("������ �����ϼ���!");
           return;
        }

        window.open("update.php?composer="+vote , "", 
              "left=200, top=200, width=160, height=250, status=no, scrollbars=no");
    }

  	  function result()
    {
         window.open("result.php" , "", 
              "left=200, top=200, width=160, height=250, status=no, scrollbars=no");
    }
</script>

 </head> 
<body>
  <form name=survey_form method=post > 
    <table border=0 cellspacing=0 cellpdding=0 width='200' align='center'>
      <input type=hidden name=kkk value=100>
        <tr height=40>
          <td><img src="../img/bbs_poll.gif"></td>
        </tr>
        <tr height=1 bgcolor=#cccccc><td></td></tr>
       <tr height=7><td></td></tr>
       <tr><td><b> �� ���� �߻��� �İ��� �л���?</b></td></tr>
       <tr><td><input type=radio name='composer' value='ans1' >1. ������</td></tr>
       <tr height=5><td></td></tr>
       <tr><td><input type=radio name='composer' value='ans2' >2. ������</td></tr>
       <tr height=5><td></td></tr>
       <tr><td><input type=radio name='composer' value='ans3' >3. ���ؿ�</td></tr>
       <tr height=5><td></td></tr>
       <tr><td><input type=radio name='composer' value='ans4' >4. �����</td></tr>
       <tr height=7><td></td></tr>
       <tr height=1 bgcolor=#cccccc><td></td></tr>
       <tr>
       <tr height=7><td></td></tr>
       <tr>
         <td align=middle><img src="../img/b_vote.gif" border="0"  style='cursor:hand' 
            onclick=update()></a>
           <img src="../img/b_result.gif" border="0"  style='cursor:hand' 
               onclick=result()></a></td></tr>
    </table>
  </form>
</body>
</html>
