<!DOCTYPE html>
<html>
    <head>
        <title>questions</title>
</head>
<body>
    <div id='lets see'></div>
    <script>
        $.getJSON(
            "display.php",
            function(data){
                console.log(data);
            }
        )
    </script>
</body>
</html>