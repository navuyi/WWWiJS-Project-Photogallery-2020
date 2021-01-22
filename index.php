<?php
    session_start(); //starting session

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    define("IN_INDEX",1);
    include("config.inc.php");
    require __DIR__ . '/vendor/autoload.php';
    //connection with database
    if (isset($config) && is_array($config)) {

        try {
            $dbh = new PDO('mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'] . ';charset=utf8mb4', $config['db_user'], $config['db_password']);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Nie mozna polaczyc sie z baza danych: " . $e->getMessage();
            exit();
        }

    } else {
        exit("Nie znaleziono konfiguracji bazy danych.");
    }
?>


<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
        <base href="/" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>        
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css"/>
        
        <style>
        	li{
        		margin-left: 20px;
        	}
        	nav{
        		height: 60px;
        	}
        	body{
        		background-color: #bfbfbf;
                height: 150%;
        	}
            span{
                font-family: "Consolas";
            }
            .navig-links{
                font-size: 20px;
            }

        </style>
	</head>
	<body>
		<nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top navbar-collapse">
			<div class="container">
				<h><b><span style="color: white; font-size: 25px; margin-right: 10px;">PhotoGallery</b></span></h>

				<div class="navbar-collapse">
					<u1 class="navbar-nav">
						<li class="nav-item active">
							<a href="/"><span class="navig-links" style="color:white;">Strona glowna</span></a>
						</li>
						<li class="nav-item active">
							<a href="/photoAdd"><span class="navig-links" style="color:white;">Dodaj zdjęcie</span></a>
						</li>
						<li>
							<a href="/categories"><span class="navig-links" style="color:white;">Kategorie</span></a>
						</li>
                        <li>
                            <a href="/instruction"><span class="navig-links" style="color:white;">Instrukcja</span></a>
                        </li>

					</u1>
				</div>
			

			</div>
		</nav>
	</body>

	</html>


	<?php
    //setting subpages allowed to open
    $allowed_pages = ['main', 'photoAdd', 'categories','category','photoEdit','instruction'];
    if (isset($_GET['page']) && $_GET['page'] && in_array($_GET['page'], $allowed_pages)) {
        if (file_exists($_GET['page'] . '.php')) {
            include($_GET['page'] . '.php');
        } else {
            print 'Plik ' . $_GET['page'] . '.php nie istnieje.';
        }
    } else {
        include('main.php');
    }
?>