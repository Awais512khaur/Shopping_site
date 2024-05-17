<?php
include "db.php";
include "header.php";
?>

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
                                echo '<li class="items even" id="order-item-'.$order_id.'">
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
                                            <button class="remove" onclick="removeOrderItem('.$order_id.')">x</button>
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
                                    </ul></div><div class="cart"><ul class="cartWrap"><li class="items even" id="order-item-'.$order_id.'"><div class="infoWrap">
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
                                            <button class="remove" onclick="removeOrderItem('.$order_id.','.$prev_total.')">x</button>
                                        </div>
                                        <div class="cartSection invoiceWrap">
                                            <button class="invoiceButton" onclick="showInvoice('.$order_id.',)">Invoice</button>
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
<div id="invoicePopup" class="invoicePopup">
    <div class="invoiceContent">
        <span class="close" onclick="closeInvoice()">&times;</span>
        <div id="invoiceDetails"></div>
        <button onclick="printInvoice()">Print</button>
    </div>
</div>

<?php
include "footer.php";
?>

<script>
function showInvoice(orderId) {
    // Use AJAX to fetch the invoice details from the server
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("invoiceDetails").innerHTML = this.responseText;
            document.getElementById("invoicePopup").style.display = "block";
        }
    };
    xhttp.open("GET", "get_invoice.php?order_id=" + orderId, true);
    xhttp.send();
}

function closeInvoice() {
    document.getElementById("invoicePopup").style.display = "none";
}

function printInvoice() {
    var printContents = document.getElementById("invoiceDetails").innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
    window.location.reload(); // Reload to restore the original content
}

function removeOrderItem(orderId) {
    // Remove the order item from the DOM
    var orderItem = document.getElementById('order-item-' + orderId);
    if (orderItem) {
        orderItem.style.display = 'none';
    }
}
</script>

<style>
.invoicePopup {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
}

.invoiceContent {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>
