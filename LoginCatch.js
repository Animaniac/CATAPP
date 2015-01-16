<script language = "javascript" TYPE = "text/javascript">
$.ajax({
  type: "POST",
  url: LoginCatch.php,
  data: POST['user'],
  success: success,
  dataType: dataType
});
 </script>