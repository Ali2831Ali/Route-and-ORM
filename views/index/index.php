<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="public/js/jquery-3.4.1.js"></script>
    <title>SabzLearn | js | 16</title>
</head>
<body>
<h1>hello world</h1>
<form id="form" method="post" action="index/ali">
    <input type="hidden" name="_method" value="put" />
    <button onclick="postrequest()">
        submit
    </button>
</form>

<script>
    function postrequest(){
        $('#form').submit();
    }
</script>
</body>
</html>
