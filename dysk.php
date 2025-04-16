<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}

$servername = "81.171.31.232";
$username = "dj98";
$password = "Nowehaslo7777";
$dbname = "dj98";


$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Połączenie nieudane: " . $conn->connect_error);
}

// Pobranie liczby nieprzeczytanych wiadomości
$sql = "SELECT COUNT(*) as nowe_wiadomosci FROM wiadomosci WHERE odbiorca_id = ? AND przeczytana = FALSE";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$nowe_wiadomosci = $row['nowe_wiadomosci'];

$stmt->close();
$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> ಠ_ಠ _๔ค๓ןคภן๏t_ 👨‍💻</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="myProjects/webProject/icofont/css/icofont.min.css">


    <link rel="stylesheet" href="../css/main.css">

    <script src="https://kit.fontawesome.com/ef9d577567.js" crossorigin="anonymous"></script>

    <link rel="website icon" type="png" href="../img/kossmo.png">

    <meta name="description" content="website">
</head>
<body>
<!-- _________________________________________________________________________________________ -->
    
<!-- <p>Wybierz jedną z poniższych opcji:</p> -->



<body data-bs-spy="scroll" data-bs-target="#navId" class="headzdj">



    <!-- =========================NAV======================================= -->

    <nav class="navbar navbar-expand-lg position-fixed top-0 w-100" id="navId">
        <div class="container">
            <a class="navbar-brand" href="../dashboard.php"><img src="../img/kossmo.png" style="width: 50px;" alt="logo"></a>
            
                   <h3 class="text-center"> <?php echo $_SESSION['imie']; ?></h3>

            
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <!-- <i class="fa-solid fa-bars"></i> -->
                <i class="fa-solid fa-align-justify"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">

                    <a href="../dashboard.php" type="button" class="button btn btn-outline-primary position-relative">Home <i class="fa-solid fa-house"></i></a>
                <!--    <a href="###" type="button" class="button btn btn-outline-primary position-relative"> <i class="fa-solid fa-sd-card"></i></a>   -->

                    
        <div class="btn-group">
            <button type="button" class="button btn btn-outline-primary position-relative dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                 Współdzielony <i class="fa-solid fa-people-group"></i>
            </button>
                <ul class="dropdown-menu dropdown-menu-end"> 
                    
                    <a href="./note.php" type="button" class="button btn btn-outline-primary position-relative">Notatnik treści<i class="fa-solid fa-sd-card"></i></a>
                    <a href="http://edyt.j.pl/" type="button" class="button btn btn-outline-primary position-relative">Terminal kodu Live<i class="fa-solid fa-terminal"></i></a>
                <!--    <a href="./portfel.php" type="button" class="button btn btn-outline-primary position-relative">Portfel <i class="fa-brands fa-cc-visa"></i></a>  -->
                    <a href="./dysk/dysk.php" type="button" class="button btn btn-outline-primary position-relative">Dysk do zapisu<i class="fa-solid fa-sd-card"></i></a>
                    
                                    
            </ul>
        </div>                          
                    
                    
        <div class="btn-group">
            <button type="button" class="button btn btn-outline-primary position-relative dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                 Prywatne <i class="fa-solid fa-eye-slash"></i>
            </button>
                <ul class="dropdown-menu dropdown-menu-end"> 
                    
                    <a href="./notatnik/dashboard.php" type="button" class="button btn btn-outline-primary position-relative">Twój notes <i class="fa-solid fa-sd-card"></i></a>
               <!--     <a href="http://edyt.j.pl/" type="button" class="button btn btn-outline-primary position-relative">Terminal <i class="fa-solid fa-terminal"></i></a>    -->
                    <a href="./portfel.php" type="button" class="button btn btn-outline-primary position-relative">Twój portfel <i class="fa-brands fa-cc-visa"></i></a>
                <!--    <a href="http://dysk.j.pl/" type="button" class="button btn btn-outline-primary position-relative">Dysk <i class="fa-solid fa-sd-card"></i></a> -->
                    
                                    
            </ul>
        </div>                             
                    
                    
                    
        <div class="btn-group">
            <button type="button" class="button btn btn-outline-primary position-relative dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                 Profil <i class="fa-solid fa-circle-user"></i>
            </button>
                <ul class="dropdown-menu dropdown-menu-end"> 
                
            <!--       <a href="lista_kont.php" type="button" class="button btn btn-outline-success position-relative">Lista użytkowników <i class="fa-solid fa-users"></i></a> -->

                    <a href="profil.php" type="button" class="button btn btn btn-outline-secondary position-relative">Edytuj profil <i class="fa-solid fa-user-pen"></i></a>
                    
            <!--        <a href="profil.php" type="button" class="button btn btn btn-outline-secondary position-relative">Ustawienia<i class="fa-solid fa-gear"></i></a>    -->

                    <a href="logout.php" type="button" class="button btn btn-outline-info position-relative">Wyloguj się <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                
            </ul>
        </div>      
                    
                    
                    
   
            
                </div>
            </div>
        </div>
    </nav>            
            
    <!-- ================================ -->
            



<div style="height:10vh;"></div>


<div class="phone container">



    <h1 style="text-center">Mój Dysk</h1>
    <hr>

<div class="container">

    
    <div id="file-manager">
        <div id="folder-structure">
            <button id="go-back" class="buttonstyle"><i class="fa-solid fa-arrow-left-long"></i></button>
            <div id="folder-content"></div>
        </div>
        <div id="file-editor">
            <textarea id="editor" class="buttonstyle" placeholder="Edytuj plik..."></textarea>
            <button id="save-file" class="buttonstyle">Zapisz <i class="fa-solid fa-file-circle-check"></i></button>
        </div>
    </div>
    
    <hr>
    
    <h2 style="text-center">Prześlij</h2>

    <div id="controls">
        <form id="upload-form">
            <input class="buttonstyle" type="file" name="file" id="file-upload">
            <button class="buttonstyle" type="submit"><i class="fa-solid fa-file-import"></i></button>
        </form>
        
    </div>
    
    <hr>

    <h2 style="text-center">Dodaj</h2>

   
        <form id="create-form">
            <input class="buttonstyle" type="text" id="new-name" placeholder="podaj nazwe...">
            <select id="type-select" class="buttonstyle">
                <option value="file">Plik</option>
                <option value="folder">Folder</option>
            </select>
            <button type="submit" class="buttonstyle"><i class="fa-solid fa-file-circle-plus"></i></button>
        </form>
    </div>


    
</div>

</div>

    <div class="headzdj-shadow"></div>
    



   <div id="phoneButton" onclick="togglePhone()">


            <a href="../czat.php" type="button" class="btn btn-primary position-relative">
                     
                    <?php if ($nowe_wiadomosci > 0): ?>
                    
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                   <?php echo $nowe_wiadomosci; ?></span>
                    
                        <span class="visually-hidden">unread messages</span>
                    <?php endif; ?>
                    
                    
              <div class="btn-group dropup">
  <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    
    <i class="fa-solid fa-comment">
  </button>
  <form class="dropdown-menu p-4">
           <iframe class="glass-chat" src="../chat.php"  ></iframe>
        <!--   <iframe id="receiver" class="glass" style"min-height: 450px;" src="./chat.php"  ></iframe>   -->
  </form>
</div>                  
                    
                    
                    
                    
                </i>    </a>     

    </div>




<!--


<div class="container text-center">
  <div class="row align-items-center">
    
        <iframe id="receiver" class="glass" src="./chat.php" style="width: 30%;" ></iframe>
   
    
        <iframe id="receiver" class="glass" src="./chat_rozmowa.php" style="width: 70%;" ></iframe>
   

  </div>
</div>

-->






    <!-- ▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀ -->
    <!-- _____________________________footer_____________________________________ -->

    <footer class="bg-dark text-light py-4 text-center ">


        <p class="mb-0"> &copy; 2025 | _๔ค๓ןคภן๏t_ 👨‍💻 </p>

    </footer>



    <!-- ============================================================================= -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>






    <script src="./script.js"></script>
</body>
</html>
