<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Gestion de Restaurant</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        /* Fixer la navbar en haut */
        .navbar-fixed {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1020; /* Assure que la navbar reste au-dessus du contenu */
        }

        /* Fixer la sidebar sur le côté gauche */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background-color: rgb(31, 42, 61);
            color: white;
            z-index: 1000;
            padding-top: 70px; /* Espacement pour la navbar fixe */
        }
        .navbars{
            background-color: rgb(31, 42, 61);
            color: white;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 5px;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgb(31, 42, 61);
        }

        .sidebar .nav-link.active {
            color: #fff;
            background-color: #023184;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        /* Espacement du contenu principal à côté de la sidebar */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            margin-top: 80px; /* Espacement pour la navbar */
        }
    </style>
</head>
