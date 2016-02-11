<?php 
  $msg      = "";
  if(isset($_POST['getpdf'])){
    $email  = $_POST['InputEmail'];
    $con    = mysql_connect("localhost","root","root");
    if (!$con){
      die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("newsletter_ykings", $con);
    $sql    ="INSERT INTO subscribers (email_id, status)VALUES('$email','subscribed')";
    if (mysql_query($sql,$con)){
      $msg  ="Thank you for your subscription";
    }else{
      die('Error: ' . mysql_error());
    }
    mysql_close($con);   
    $data = [
    'email'     => $email,
    'status'    => 'subscribed',
    ];

    syncMailchimp($data);
  }


  

function syncMailchimp($data) {

  $apiKey = '12f523751b361d62aa4e19ae9e1f10e7-us12';
  $listId = '28314e9078';

  $memberId = md5(strtolower($data['email']));
    $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
    $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;
    $json = json_encode([
        'email_address' => $data['email'],
        'status'        => $data['status'], // "subscribed","unsubscribed","cleaned","pending"
    ]);


    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);                                                                                                                 

    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $httpCode;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Ykings Newsletter</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/newsletter.css" rel="stylesheet">

    <!-- Custom font css -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  
  <div class="newsletter-container clearfix">
    <div class="logo"><img src="images/logo-ykings.png" alt=""></div>
     <div class="content-wrap">
        <div class="content-inner">
           <div class="logo-res"><img src="images/logo-res.png"></div>
            <h2>DONT GOOGLE YOUR</h2>
            <h1 class="block-title">WORKOUT ROUTINE</h1>
            <h4>To build a fortress, you need a foundation.Get your workout guide, written by professional instructors and athletes to onboard you correctly to bodyweight training.</h4>

            <form class="form-inline" action="" id="form1" name="form1" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <input type="email" class="form-control" id="InputEmail" name="InputEmail" placeholder="Enter your Mail ID">
                <input type="submit" class="btn btn-default" name="getpdf" value="GET PDF">
                <?php 
                  if(!empty($msg)){echo '<span class="message">'.$msg.'</span>';}
                  ?>
                
              </div>
              
            </form>

            <h3><span>Bonus</span> Gift</h3>
            <ul>
            <li><img src="images/check.png">8-weeks calisthenics workout program</li>
            <li><img src="images/check.png">Weekly updates no spam</li>
            <li><img src="images/check.png">complete pdf schedule</li>
            <li><img src="images/check.png">video tutorials for each exercise</li>
            </ul>
        </div> 
        <div class="content-footer">
            <p>
            Detailed moves and skills will be available over our smartphone application.Coming to the stores soon, Ykings provides the opportunity to tailored training, get in touch with a community and track your progress for all skills.
            </p>
        </div>
     </div> 
  </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-2.2.0.min.js"></script>
    <script>
    $(document).ready(function() {
      function setHeight() {
        windowHeight = $(window).innerHeight();
        $('.newsletter-container, .content-wrap').css('min-height', windowHeight + "px");
      };
      setHeight();

      $(window).resize(function() {
        setHeight();
      });
    });
</script>
  </body>
</html>
