<?

include("min/dbc.php");
include('inc/funs.php');

$msg="Welcome to admin!";
$link="login.php";

@session_start();
if(isset($_SESSION['user_name']) && isset($_SESSION['user_id'])){
	$log=true;
	$link="./index.php";
	header("Location: $link");
}
if(isset($_REQUEST['out'])){
    @session_destroy();
    unset($_SESSION['l']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_id']);
    unset($_SESSION['type']);
    unset($_SESSION['type']);

    $msg="See you later!";
}else{

}

if(isset($_POST['user']) && isset($_POST['pass'])){

    $user= trim($_POST['user']);
    $getpass= trim($_POST['pass']);
    $pass= md5($getpass);

    $result = mysql_query("select * from `users` where un='$user' and pw= '$pass' limit 1");
    $num = mysql_num_rows($result);

    if($num > 0){
        $user_type=mysql_result($result,0,'user_type');
        $user_name=mysql_result($result,0,'fname');
        $user_id=mysql_result($result,0,'id');

        session_start();
        $_SESSION['l']='OK';
        $_SESSION['user_name']=$user_name;
        $_SESSION['user_id']=$user_id;
        $_SESSION['type']=$user_type;
        $_SESSION['if_orders_up'] = CHECK_LAST_UPDATE('ord_opr');
        $_SESSION['if_items_up'] = CHECK_LAST_UPDATE('inv_opr');
        $_SESSION['if_customers_up'] = CHECK_LAST_UPDATE('customers');



        header("Location: $link");

    }else{
        $msg="Please try agin";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin - Login</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
    <link rel="shortcut icon" href="favicon.png">
    <!---CSS Files-->
    <link rel="stylesheet" href="css/core.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/ui.css">
    <!---jQuery Files-->
    <script src="library/jquery/jquery.js"></script>
    <script src="library/jquery/inputs.js"></script>
</head>
<body>

<div id="wrapper">

    <div id="header">
        <div id="logo"></div>
        <h1>LOGIN</h1>
    </div>

    <div id="body">
        <div id="head">
            <span class="icon">K</span>
            <h2>Enter your credentials to login</h2>
            <br class="clear">
        </div>
        <form id="alt-lg-form" name="login" method="post" action="login.php">
            <div id="middle">
                <ul id="lg-input">
                    <li id="usr-li">
                        <input type="text" name="user" id="usr" class="required" placeholder="User Name" value="">
                        <span class="icon">a</span>
                    </li>
                    <li id="psw-li">
                        <input type="password" name="pass" id="psw" class="required" placeholder="Password">
                        <span class="icon">/</span>
                    </li>
                </ul>
            </div>
            <div id="bottom">
                <button type="submit" id="lg-submit" name="sub" class="button inset submit">LOGIN</button>
                <br class="clear">
            </div>
        </form>
    </div>

    <div id="notification-area">
        <div class="notification" id="welcome">
            <span class="icon">N</span>
            <p><?=$msg?></p>
        </div>
    </div>

</div>

  <span id="load">
    <img src="images/load.png"><img src="images/spinner.png" id="spinner">
  </span>

<!---jQuery Code-->
<script type='text/javascript'>
    $('#wrapper, .notification, #forgot-psw').hide();
    $('#load').fadeIn(400);
    $(window).load( function() {
        $('#load').fadeOut(400, function() {
            $('#wrapper').fadeIn(600, function() {
                $('#welcome.notification').delay(500).fadeIn(400).loginNotif();
                $('#psw').focus();
            });
        });
    });

    $('#rb-check').flcheck();

    $('#alt-lg-form').validateLogin();

</script>
</body>
</html>
