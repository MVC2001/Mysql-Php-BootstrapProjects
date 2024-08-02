<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Success Page</title>
    <style>
        .hide {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card shadow-lg hide" id="content">
                    <div class="card-header text-white" style="background-color: #0A2D54;">
                        <h5 class="mb-0">
                            <i class="fas fa-check-circle"></i> SUCCESSFULL
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="text-center">Your order has been successfully placed. Please wait for a response., also add current location your, using google map</p>
                         <div class="text-center wait-icon">
                            <i class="fas fa-hourglass-half fa-3x text-muted"></i>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="index.php" class="btn btn-block" style="background-color: #0A2D54; color: white;">Go to Home</a>
                    </div>
                </div>
                <div class="text-center wait-icon" id="loading">
                    <i class="fas fa-hourglass-half fa-3x text-muted"></i>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            document.getElementById('content').classList.remove('hide');
            document.getElementById('loading').classList.add('hide');
        };
    </script>
</body>
</html>
