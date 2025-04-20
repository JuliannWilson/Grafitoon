php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX Insert Data</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <h2>Register</h2>

    <form action="" method="post">
        <input type="text" id="name" placeholder="Enter Name" required>
        <input type="email" id="email" placeholder="Enter Email" required>
        <button type="submit" class="btn">Register</button>
    </form>

    <div id="response"></div>

    <script>
        $(document).ready(function(){
            $('#registerForm').on('submit', function(e){
                e.preventDefault(); // prevent default form submission

                var name = $('#name').val();
                var email = $('#email').val();

                $.ajax({
                    url: 'insert.php',
                    type: 'POST',
                    data: { name: name, email: email },
                    success: function(response){
                        $('#response').html(response);
                        $('#name').val('');
                        $('#email').val('');
                    },
                    error: function(){
                        $('#response').html("Error in AJAX request");
                    }
                });
            });
        });
    </script>

    <a href="Grafitoon_index.php">View Site</a>

</body>
</html>
