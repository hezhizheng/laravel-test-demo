<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> free-pic 上传测试</title>
</head>
<body>

<form action="{{ url('free-pic') }}" method="post" enctype="multipart/form-data">
    <label for="file">文件名：</label>
    <input type="file" name="file" id="file"><br>
    <input type="submit" name="submit" value="提交">
</form>


</body>
</html>
