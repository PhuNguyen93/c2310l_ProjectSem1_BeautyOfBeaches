<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beautiful Beaches</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <style>
        .banner {
            background: url('https://example.com/banner.jpg') no-repeat center center;
            background-size: cover;
            height: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 3rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        .beach-card {
            transition: transform 0.3s ease-in-out;
        }

        .beach-card:hover {
            transform: scale(1.05);
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .sidebar {
            background-color: #f8f9fa;
            padding: 15px;
            margin-top: 20px;
            border-radius: 10px;
        }

        /* Scroll Animation */
        .scroll-in {
            opacity: 0;
            transform: translateY(50px);
            transition: all 1s ease;
        }

        .scroll-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
