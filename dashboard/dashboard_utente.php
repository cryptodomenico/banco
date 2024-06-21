
  
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>cs</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="../css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="../css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="../images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">
   <?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../login.html');
	exit;
}
?>
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="../images/loading.gif"  /></div>
      </div>
      <div class="wrapper">
         <!-- end loader -->
         <div class="sidebar">
            <!-- Sidebar  -->
            <nav id="sidebar">
               <div id="dismiss">
                  <i class="fa fa-arrow-left"></i>
               </div>
               <ul class="list-unstyled components">
                  <!--<li>
                     <a href="#about">About</a>
                  </li>-->
                  <li>
                     <a href="profile.php">Profilo</a>
                  </li>
                  <li>
                     <a href="logout.php">Logout</a>
                  </li>
               </ul>
            </nav>
         </div>
         <div id="content">
            <!-- header -->
            <header>
               <!-- header inner -->
               <div class="head_top">
                  <div class="header">
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-md-3 logo_section">
                              <div class="full">
                                 <div class="center-desk">
                                    <div class="logo">
                                       <a href="dashboard_utente.php"><img src="../images/logo.png"></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-9">
                              <div class="right_header_info">
                                 <ul>
                                    <!--<li class="menu_iconb">
                                       <a href="Javascript:void(0)">Login</a>
                                    </li>-->
                                    <li>
                                       <button type="button" id="sidebarCollapse">
                                       <img src="../images/menu_icon.png" alt="#" />
                                       </button>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </header>
            <!-- end header inner -->
            <!-- end header -->
            <section class="slider_section">
               <div class="banner_main">
                  <img src="../images/bg_main.jpg" alt="#"/>
                  <div class="container-fluid padding3">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="text-bg">
                              <a href="gioco.php">Play now</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         <!-- Categories -->
         <!-- casino -->
         <div id="game" class="casino">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="titlepage">
                        <h2>Our Casino Games</h2>
                        <span></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4 padding_bottom">
                     <div class="game_box">
                        <figure><img src="../images/game1.jpg" alt="#"/></figure>
                     </div>
                     <div class="game">
                        <h3>Game 1</h3>
                     </div>
                  </div>
                 
                     <div class="game">
              <figure><img src="../iamges/game2.jpg" alt="1"></figure>
                     <h3>Game 6</h3>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end casino -->
         <!--  footer -->
         <footer>
            <div class="footer">
               <div class="container">
                  <div class="row">
                    
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="row">
                           <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                              <div class="address">
                                 <h3>Links</h3>
                                 <ul class="Menu_footer">
                                    <li class="active"> <a href="dashboard_utente.php">Home</a> </li>
                                    <li><a href="#about">About</a> </li>
                                    <li><a href="#game">Game</a> </li>
                                    <li><a href="#customer">Customer</a> </li>
                                    <li><a href="#conatct">Conatct</a></li>
                                 </ul>
                              </div>
                           </div>
                           <div class="address Menu_footer" style="text-align: right;">
                                 <h3>Contact us</h3>
                                 <ul style="text-align: right;">
                                    <li>Contact information</li>
                                 </ul>
                              </div>
                           <!--<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                              
                           </div>-->
                        </div>
                     </div>
                  </div>
               </div>
               <div class="copyright">
                  <div class="container">
                     <p>Copyright</p>
                  </div>
               </div>
            </div>
         </footer>
         <!-- end footer -->
      </div>
      <div class="overlay"></div>
      <!-- Javascript files-->
      <script src="../js/jquery.min.js"></script>
      <script src="../js/popper.min.js"></script>
      <script src="../js/bootstrap.bundle.min.js"></script>
      <script src="../js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
       <script src="../js/custom.js"></script>
      <script type="text/javascript">
         $(document).ready(function() {
             $("#sidebar").mCustomScrollbar({
                 theme: "minimal"
             });
         
             $('#dismiss, .overlay').on('click', function() {
                 $('#sidebar').removeClass('active');
                 $('.overlay').removeClass('active');
             });
         
             $('#sidebarCollapse').on('click', function() {
                 $('#sidebar').addClass('active');
                 $('.overlay').addClass('active');
                 $('.collapse.in').toggleClass('in');
                 $('a[aria-expanded=true]').attr('aria-expanded', 'false');
             });
         });
      </script>
      <script>
         $(document).ready(function() {
             $(".fancybox").fancybox({
                 openEffect: "none",
                 closeEffect: "none"
             });
         
             $(".zoom").hover(function() {
         
                 $(this).addClass('transition');
             }, function() {
         
                 $(this).removeClass('transition');
             });
         });
      </script>
     <script>
    // Dopo un certo intervallo di tempo (ad esempio, 3 secondi), rimuovi l'elemento con la classe "loader_bg"
    setTimeout(function() {
        $(".loader_bg").fadeOut("slow"); // FadeOut dell'elemento con la classe "loader_bg"
    }, 3000); // Tempo in millisecondi (3000 millisecondi = 3 secondi)
</script>
   </body>
</html>