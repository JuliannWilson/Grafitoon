<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX Insert Data</title>
    <script src="https://code.jquery.com/jquery=3.6.0.min.js"></script>
</head>
<body>
    <h2>Insert Data Using AJAX</h2>
    <form method ="POST" action="insert.php"></form>
    <input type="text" id="name" placeholder="Enter Name">
    <input type="email" id="email" placeholder="Enter Email">
    <button onclick ="sendData()">Submit</button>

    <div id="response"></div>
    <script>
        function sendData(){
            var name = $("#name").val();
            var email = $("#email").val();

            $ajax({
                url:"insert.php", //PHP file to process data
                type: "POST",
                data:{name:name, email:email },//Sending name & email
                success: function(response){
                    $("#response").html(response);//Show response in the div
                    $("#name").val("");//Clear input fields
                    $("#email").val("");
                },

                error: function(){
                    $("#response").html("Error in AJAX request");
                }
            });
        }
    </script>
    <a href="index.html">View Data</a>
</body>
</html>