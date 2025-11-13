<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Person</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #eef2f5;
            color: #333;
        }

        .container {
            max-width: 700px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            font-size: 32px;
            color: #004aad;
            margin-bottom: 20px;
            font-weight: bold;
            font-family: "Jost", sans-serif;
            font-optical-sizing: auto;
            font-weight: 700;
            font-style: italic;
        }

        p.subtitle {
            font-size: 16px;
            color: #555;
            margin-bottom: 30px;
        }

        .contact-info {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .contact-info li {
            display: flex;
            align-items: center;
            background-color: #f9fbfd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            text-align: left;
        }

        .contact-info li:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .contact-info li i {
            font-size: 24px;
            color: #004aad;
            margin-right: 15px;
        }

        .contact-info li span {
            font-size: 18px;
            color: #333;
        }

        .contact-info li span.bold {
            font-weight: bold;
            color: #004aad;
        }

        .btn-back {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 24px;
            background-color: #004aad;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-back:hover {
            background-color: #00307a;
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 28px;
            }

            .contact-info li {
                padding: 10px;
            }

            .contact-info li span {
                font-size: 16px;
            }

            .btn-back {
                font-size: 16px;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <?= $this->include('users/navbar') ?>

    <div class="container">
        <h1>Contact Person 📞</h1>
        <p class="subtitle">Get in touch with our admin for any queries or support.</p>
        <ul class="contact-info">
            <li>
                <i class="fas fa-envelope"></i>
                <span><span class="bold">For Inquiries ☺ :</span> chelin.audrey.work@gmail.com</span>
            </li>
            <li>
                <i class="fas fa-envelope"></i>
                <span><span class="bold">For Complaints ☹ :</span> nikita.work@gmail.com</span>
            </li>
            <li>
                <i class="fas fa-phone"></i>
                <span><span class="bold">Phone :</span> +62 8128-2109-806</span>
            </li>
            <li>
                <i class="fas fa-map-marker-alt"></i>
                <span>
                    <span class="bold">Address :</span> Jl. Kp. Geulis, Cikeruh, Kec. Jatinangor, Kabupaten Sumedang, Jawa Barat 45363.
                </span>
            </li>
        </ul>
        <a href="<?= base_url('users/home') ?>" class="btn-back">Back to Home</a>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
