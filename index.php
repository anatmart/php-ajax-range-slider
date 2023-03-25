<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jRange demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/jquery.range.css">
	<style>
	#price_range {
		-ms-touch-action: none;
		touch-action: none;
	}
	</style>
</head>

<body>
    <header>
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4 class="text-white">About</h4>
                        <p class="text-white">Anatmart, I am an ordinary guy.</p>
                    </div>
                    <div class="col-sm-4 offset-md-1 py-4">
                        <h4 class="text-white">Contact</h4>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white">Follow on Twitter</a></li>
                            <li><a href="#" class="text-white">Like on Facebook</a></li>
                            <li><a href="#" class="text-white">Email me</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                        <circle cx="12" cy="13" r="4" />
                    </svg>
                    <strong>Project</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </header>

    <main>

        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">jRange Slider Price with PHP and ajax</h1>
                    <p class="lead text-muted"></p>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <input type="hidden" id="price_range" value="0,3000"></p>
                    <button onclick="filterProducts()" class="btn btn-outline-primary">Filter Products</button>
                </div>
                <div class="col-lg-6 wrapper" id="productContainer">
                    <?php
                    // Include database configuration file 
                    include "dataconn_mysqli.php";

                    // Fetch products from database 
                    $query = "SELECT * FROM product ORDER BY id ";
                    $result = $mysqli->query($query);


                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <div class="list-item">
                                <h2><?php echo $row["name"]; ?></h2>
                                <h4>Price: $<?php echo $row["price"]; ?></h4>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p>Product(s) not found...</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="js/jquery.range.js"></script>

    <script>
        $(function() {

            $('#price_range').jRange({
                from: 0,
                to: 3000,
                step: 50,
                format: '$%s BHT',
                width: 300,
                showLabels: true,
                isRange: true
            }, {
                passive: false
            });
        }, {
            passive: false
        });
    </script>
    <script>
        function filterProducts() {
            var price_range = $('#price_range').val();

            $.ajax({
                type: 'POST',
                url: 'fetchProducts.php',
                data: 'price_range=' + price_range,
                beforeSend: function() {
                    $('.wrapper').css("opacity", ".5");
                },
                success: function(html) {
                    $('#productContainer').html(html);
                    $('.wrapper').css("opacity", "");
                }
            });
        }
    </script>
</body>

</html>