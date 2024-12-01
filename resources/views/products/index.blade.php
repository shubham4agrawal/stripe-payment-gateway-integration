<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        /* Reset some default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body and general styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            color: #333;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            color: #444;
            font-size: 2.5rem;
        }

        /* Flexbox container for the product cards */
        .product-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 items per row */
            gap: 20px;
            justify-content: center;
            margin: 0 auto;
        }

        /* Product card styling */
        .product-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        .product-card h3 {
            font-size: 1.6rem;
            margin-bottom: 10px;
            color: #333;
        }

        .product-card p {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: #777;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Media Query for smaller screens */
        @media (max-width: 1024px) {
            .product-container {
                grid-template-columns: repeat(2, 1fr); /* 2 items per row */
            }
        }

        @media (max-width: 600px) {
            .product-container {
                grid-template-columns: 1fr; /* 1 item per row */
            }
            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <h1>Product List</h1>
    <div class="product-container">
        @foreach($products as $product)
            <div class="product-card">
                <h3>{{ $product->name }}</h3>
                <p>Price: ₹{{ $product->price }}</p>
                <form method="GET" action="{{ route('products.show', $product->id) }}">
                    <button type="submit">Buy Now</button>
                </form>
            </div>
        @endforeach
    </div>

    <!-- Optional: Add JavaScript for additional interactivity -->
    <script>
        // Example: Add a smooth scroll effect when clicking on buttons
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
