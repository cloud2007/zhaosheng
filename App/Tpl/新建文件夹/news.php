<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>News_List</title>
</head>

<body>
<?php
echo "<hr>";
echo $_GET['page'];
?>
<p><li><a href='/news_text/1'>1</a></li><li><a href='/news_text/2'>2</a></li><li><a href='/news_text/3'>3</a></li></p>
<p><a href='/news/?page=1'>1</a> <a href='/news/?page=2'>2</a> <a href='/news/?page=3'>3</a> <a href='/news/?page=4'>4</a> <a href='/news/?page=5'>5</a> <a href='/news/?page=6'>6</a> <a href='/news/?page=7'>7</a></p>
</body>
</html>
