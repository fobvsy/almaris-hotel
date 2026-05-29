<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out - Almaris Hotel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --color-navy: #0F172A;
            --color-gold: #D4AF37;
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: var(--color-navy);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .logout-container {
            text-align: center;
            padding: 40px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 400px;
            width: 90%;
            animation: fadeIn 0.8s ease-out;
        }

        .spinner-custom {
            width: 3rem;
            height: 3rem;
            color: var(--color-gold);
            margin-bottom: 20px;
        }

        .brand-text {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: white;
            letter-spacing: 2px;
            margin-bottom: 30px;
            display: block;
        }

        h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.25rem;
            font-weight: 500;
            margin-bottom: 10px;
        }

        p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <!-- Redirect Script after 2.5 seconds -->
    <script>
        setTimeout(function() {
            window.location.href = "index.php"; // Redirect to landing page
        }, 2500);
    </script>
</head>
<body>

    <div class="logout-container">
        <span class="brand-text">ALMARIS</span>
        
        <div class="spinner-border spinner-custom" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        
        <h2>Logging Out...</h2>
        <p>Please wait while we safely sign you out of your account.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
