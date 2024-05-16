<?php
include "db.php";
?>
<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Online Shopping</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet"/>

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
		<link type="text/css" rel="stylesheet" href="css/accountbtn.css"/>
		
		
		
         
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    <style>
        #navigation {
          background: #FF4E50;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #F9D423, #FF4E50);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #F9D423, #FF4E50); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

          
        }
        #header {
  
            background: #780206;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #061161, #780206);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #061161, #780206); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

  
        }
        #top-header {
              
  
            background: #870000;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #190A05, #870000);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #190A05, #870000); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */


        }
        #footer {
            background: #7474BF;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #348AC7, #7474BF);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #348AC7, #7474BF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */


          color: #1E1F29;
        }
        #bottom-footer {
            background: #7474BF;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #348AC7, #7474BF);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #348AC7, #7474BF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
          

        }
        .footer-links li a {
          color: #1E1F29;
        }
        .mainn-raised {
            
            margin: -7px 0px 0px;
            border-radius: 6px;
            box-shadow: 0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);

        }
       
        .glyphicon{
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    }
    .glyphicon-chevron-left:before{
        content:"\f053"
    }
    .glyphicon-chevron-right:before{
        content:"\f054"
    }
        

       
        
        </style>

    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
		
			<!-- /TOP HEADER -->
			
			

			<!-- MAIN HEADER -->
			
			<!-- /MAIN HEADER --> 
		</header>
		<!-- /HEADER -->
	
            

		<!-- NAVIGATION -->
		
		<div class="modal fade" id="Modal_login" role="dialog">
                        <div class="modal-dialog">
													
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              
                            </div>
                            <div class="modal-body">
                            <?php
                                include "login_form.php";
    
                            ?>
          
                            </div>
                            
                          </div>
													
                        </div>
                      </div>
                <div class="modal fade" id="Modal_register" role="dialog">
                        <div class="modal-dialog" >

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              
                            </div>
                            <div class="modal-body">
                            <?php
                                include "register_form.php";
    
                            ?>
          
                            </div>
                            
                          </div>

                        </div>
                      </div>
		
<link href="css/myorders.css" rel="stylesheet"/>
<section class="section main main-raised">
    <div class="container-fluid">
        <div class="wrap cf">
            <h1 class="projTitle">All Your Orders</h1>
            <div class="heading cf">
                <h1>My Orders</h1>
                <h1 style="margin-left:55%">qty</h1>
                <a href="store.php" class="continue">Continue Shopping</a>
            </div>
            <div class="cart">
                <ul class="cartWrap">
                <?php
                if (isset($_SESSION["uid"])) {
                    $sql = "SELECT c.order_id, a.product_id, a.product_title, a.product_price, a.product_image, b.qty, b.amt, c.total_amt 
                            FROM products a, order_products b, orders_info c 
                            WHERE a.product_id = b.product_id AND c.user_id = '$_SESSION[uid]' AND b.order_id = c.order_id 
                            ORDER BY c.order_id DESC";
                    $query = mysqli_query($con, $sql);

                    if (mysqli_num_rows($query) > 0) {
                        $prev_old = 0;
                        $prev_total = 0;
                        $i = 1;
                        $numRows = mysqli_num_rows($query);
                        while ($row = mysqli_fetch_array($query)) {
                            $product_id = $row["product_id"];
                            $product_title = $row["product_title"];
                            $product_price = $row["product_price"];
                            $product_image = $row["product_image"];
                            $qty = $row["qty"];
                            $amt = $row["amt"];
                            $total_amt = $row["total_amt"];
                            $order_id = $row["order_id"];

                            if ($prev_old == 0 || $prev_old == $order_id) {
                                $prev_old = $order_id;
                                $prev_total = $total_amt;
                                $i++;
                                echo '<li class="items even">
                                    <div class="infoWrap"> 
                                        <div class="cartSection">
                                            <img src="product_images/'.$product_image.'" alt="'.$product_title.'" class="itemImg" />
                                            <p class="itemNumber">#'.$product_id.'</p>
                                            <h3>'.$product_title.'</h3>
                                            <p>'.$qty.' x &#8360; '.$product_price.'</p>
                                            <p class="stockStatus">Delivered</p>
                                        </div>  
                                        <div class="prodTotal cartSection"><p>'.$qty.'</p></div>
                                        <div class="prodTotal cartSection"><p>&#8360; '.$product_price.'</p></div>
                                        <div class="cartSection removeWrap">
                                            <a href="#" class="remove">x</a>
                                        </div>
                                        <div class="cartSection invoiceWrap">
                                            <button class="invoiceButton" onclick="showInvoice('.$order_id.')">Invoice</button>
                                        </div>
                                    </div>
                                </li>';
                            } else {
                                $prev_old = $order_id;
                                $i++;
                                echo '</ul></div><div class="special"><div class="specialContent">Thanks for Using our Platform</div></div><div class="subtotal cf"><ul>
                                        <li class="totalRow"><span class="label">Subtotal</span><span class="value">&#8360; '.$prev_total.'</span></li>
                                        <li class="totalRow"><span class="label">Shipping</span><span class="value">&#8360; 0.00</span></li>
                                        <li class="totalRow"><span class="label">Tax</span><span class="value">&#8360; 0.00</span></li>
                                        <li class="totalRow final"><span class="label">Total</span><span class="value">&#8360;'.$prev_total.'</span></li>
                                    </ul></div><div class="cart"><ul class="cartWrap"><li class="items even"><div class="infoWrap">
                                        <div class="cartSection">
                                            <img src="product_images/'.$product_image.'" alt="'.$product_title.'" class="itemImg" />
                                            <p class="itemNumber">#'.$product_id.'</p>
                                            <h3>'.$product_title.'</h3>
                                            <p>'.$qty.' x &#8360; '.$product_price.'</p>
                                            <p class="stockStatus out">Shipping</p>
                                        </div>  
                                        <div class="prodTotal cartSection"><p>'.$qty.'</p></div>
                                        <div class="prodTotal cartSection"><p>&#8360; '.$product_price.'</p></div>
                                        <div class="cartSection removeWrap">
                                            <a href="#" class="remove">x</a>
                                        </div>
                                        <div class="cartSection invoiceWrap">
                                            <button class="invoiceButton" onclick="showInvoice('.$order_id.')">Invoice</button>
                                        </div>
                                    </div>
                                </li>';
                                $prev_total = $total_amt;
                            }
                            if ($i == $numRows + 1) {
                                echo '<div class="special"><div class="specialContent">Thanks for Using our Platform</div></div><div class="subtotal cf"><ul>
                                        <li class="totalRow"><span class="label">Subtotal</span><span class="value">&#8360; '.$prev_total.'</span></li>
                                        <li class="totalRow"><span class="label">Shipping</span><span class="value">&#8360; 0.00</span></li>
                                        <li class="totalRow"><span class="label">Tax</span><span class="value">&#8360; 0.00</span></li>
                                        <li class="totalRow final"><span class="label">Total</span><span class="value">&#8360;'.$prev_total.'</span></li>
                                    </ul></div>';
                            }
                        }
                    } else {
                        echo '<p>No orders found.</p>';
                    }
                }
                ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Invoice Popup -->

<?php
include "db.php";

if (isset($_GET['order_id'])) 
{
    $order_id = $_GET['order_id'];

    $sql = "SELECT a.product_title, a.product_price, b.qty, c.total_amt 
            FROM products a, order_products b, orders_info c 
            WHERE a.product_id = b.product_id AND b";
           } 
?>