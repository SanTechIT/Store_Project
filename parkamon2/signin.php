<?php
if (isset($_POST['logout'])){
if($_POST['logout'] == "logout"){
session_start();

// remove all session variables
session_unset(); 

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
// destroy the session 
session_destroy(); 
}
}

if (isset($_POST["logout"])){

} else {
    $_SESSION["loggedIn"] = false;
    $_SESSIO["name"] = "";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/rchang/p2/js/jquery-3.2.1.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/rchang/p2/css/materialize.min.css" rel="stylesheet" type="text/css">
    <link href="/rchang/p2/css/primary.css" rel="stylesheet" type="text/css">
    <link href="/rchang/p2/css/loginpage.css" rel="stylesheet" type="text/css">
    <title> Log in</title>
    <script>
        $(document).ready(function(){
            $("a.login").click((event) => {  
                $(".choosebtns").css("height","0px")
                $(".loginbox").css("max-height","1000px")
                console.log("loginclicked")
            });
            $("a.create").click((event) => {  
                $(".choosebtns").css("height","0px")
                $(".choosebtns").css("margin-top","0px")
                $(".createbox").css("max-height","1000px")
                console.log("createclicked")
            });
        })
    </script>
</head>
<body>
    <div class="container">
        <div class="card logincard">
            <div class="card-content">
                <div class=" col s12">
    </div>
                <form class="col s12" action="loginhandler.php" method="POST">
                        <div class="row">
                          <div class="input-field col s12">
                          <h4>Select Player</h4>

                          <select name="player_id" class="browser-default" style="margin-bottom:5px;" required>
                            <option value="" disabled selected>Choose your option</option>
                            <?php
                                require("config.php");
                                try {
                                    echo "<p>Connecting</p>";
                                    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
                                    $sth = $dbh->prepare("SELECT * FROM player");
                                    $sth->execute();
                                    $players = $sth->fetchAll(); //an array of arrays
                                    echo "<p>Connected</p>";
                                }
                                catch (PDOException $e) {
                                    echo "<p>Error connecting to database!</p>" . $e;
                                }
                                foreach ($players as $player) {
                                    echo '<option value='. $player['id'] .'>' . $player['name'] . '</a>';
                                }
                            ?>
                            </select>
                          </div>
                          <div class="input-field col s12">
                            <input placeholder="Password" name="password" type="password" required>
                          </div>
                        </div>
                        <input class="btn waves-effect waves-light" type="submit" value="Catch" name="action">  </input>
                </form>
            </div>
        </div>
    </div>
</body>
</html>