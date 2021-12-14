<!DOCTYPE html>
<html>
<head>
 <title>Aplikasi Live Date and Time</title>
 <style>
 body {
  font-size: 12px;
  font-family: verdana;
 }
 a { text-decoration: none; color: blue; }
 a:hover { text-decoration: underline; }
 </style>
</head>
<body>
<h1>Aplikasi Web Dengan Live Date And Time</h1>
<hr>
<div style="float: left;margin-bottom: 5px;">
 <a href="index.php">Home</a> | 
 <a href="index.php#">About</a> |
</div>
<div style="float: right;margin-bottom: 5px;">
 <span id="date_time"></span>
</div>
<div style="clear: both;">
<hr>
<div style="height: 200px;">
Welcome to mysite
</div>
<hr>
Copyright &copy;2020 - belajarwebpedia.com
</body>
<script type="text/javascript" src="datetime.js"></script>
<script type="text/javascript">window.onload = date_time('date_time');</script>
</html>