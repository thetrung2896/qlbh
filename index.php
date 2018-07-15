<?php 
    session_start();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    include 'includes/function.php';
    include 'includes/access-function.php';
    include ("includes/access_stt.php");
 ?>

 <?php
        if (!isset ($_SESSION['admin'])){
            echo '<script type="text/javascript">
                window.location.href="login.php";
            </script>';
        }
    ?>
<?php  
        if (isset ($_GET['tab'])){
            $tab = $_GET['tab'];
        }else{
            $tab = '';
        }
        
        if ($tab == 'register') {
            include ("modules/register.php");
        }elseif ($tab == 'logout') {
            include ("includes/access-logout.php");
        }
    
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="NTT">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Hóa Đơn Hàng</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <?php 
                        // HEADER MOBILE
                        include 'controller/mobile.php';
                        //END HEADER MOBILE
                        // MENU SIDEBAR
                        include 'controller/menu.php';
                        // END MENU SIDEBAR
                        // HEADER DESKTOP
                        include 'controller/header.php';
                        // END HEADER DESKTOP
         ?>
        <!-- PAGE CONTAINER-->
        <div class="page-container">

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                 <h2>Products</h2>
                                <br>
                                <div class="table-responsive table--no-card m-b-30">
                                    
                                        <table class="table table-borderless table-data3">
                                            <thead>
                                                <tr>
                                                    <th style="vertical-align: middle; width: 10%">Images</th>
                                                    <th style="vertical-align: middle; width: 40%">Product name</th>
                                                    <th style="vertical-align: middle; width: 10%" class="text-left">price</th>
                                                    <th style="vertical-align: middle; width: 10%"class="text-left">quantity</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                          
                                                    
                                            <tbody>
                                                 <?php
                                                include 'includes/function.php';
                                                 $query = 'SELECT * FROM products ORDER BY id ASC';
                                                 $result = mysqli_query($connect, $query);
                                                 if ($result):
                                                     if(mysqli_num_rows($result)>0):
                                                         while($product = mysqli_fetch_assoc($result)): 
                                                 ?>
                                                 
                                                <tr>
                                                    <form type="hidden" method="post" action="index.php?action=add&id=<?php echo $product['id']; ?>">
                                                    <td style="width: 50px"><img src="images/<?php echo $product['image'] ?>" alt="" width="50"></td>
                                                    <td><?php echo $product['name'] ?></td>
                                                    <td class="text-left">$<?php echo $product['price'] ?></td>
                                                    <td class="text-right"><input type="text" name="quantity" class="form-control" value="1" /></td>
                                                    <input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
                                                    <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
                                                    <td class="text-right"><input type="submit" name="add_to_cart" style="margin-top:5px;" class="au-btn au-btn-icon au-btn--blue au-btn--small " value="+ Order" /></td>
                                                    </form>
                                                </tr>
                                            <?php 
                                                        endwhile;
                                                    endif;
                                                endif;
                                             ?>
                                         </tbody>
                                            
                                        </table>
                                    
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h2>Order Details</h2>
                                <br>
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-data3">
                                            <thead>    
                                                <tr>  
                                                     <th style="vertical-align: middle; width: 50%">Product Name</th>  
                                                     <th class="text-left" style="vertical-align: middle; width: 10%">Quantity</th>  
                                                     <th class="text-left"style="vertical-align: middle; width: 10%">Price</th>  
                                                     <th class="text-left"style="vertical-align: middle; width: 15%">Total</th>  
                                                     <th class="text-left" style="vertical-align: middle; width: 10%">Action</th>  
                                                </tr>
                                            </thead>  
                                                <?php   
                                                if(!empty($_SESSION['shopping_cart'])):  
                                                    
                                                     $total = 0;  
                                                
                                                     foreach($_SESSION['shopping_cart'] as $key => $product): 
                                                ?>

                                                <tr>  
                                                   <td><?php echo $product['name']; ?></td>  
                                                   <td><?php echo $product['quantity']; ?></td>  
                                                   <td>$<?php echo $product['price']; ?></td>  
                                                   <td>$<?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>  
                                                   <td class="text-right">
                                                       <a href="index.php?action=delete&id=<?php echo $product['id']; ?>">
                                                            <div class="btn btn-danger">Remove</i></div>
                                                       </a>
                                                   </td>  
                                                </tr>  
                                                    <?php  
                                                              $total = $total + ($product['quantity'] * $product['price']);  
                                                         endforeach;  
                                                    ?>  
                                                <tr>  
                                                     <td colspan="3" align="right" style="font-weight: bold;">Total</td>  
                                                     <td align="left" style="font-weight: bold;">$ <?php echo number_format($total, 2); ?></td>  
                                                     <td></td>  
                                                </tr>
                                              
                                                <tr>
                                                    <!-- có sản phẩm mới hiện nút xác nhận -->
                                                    <td colspan="5">
                                                        <?php 
                                                            if (isset($_SESSION['shopping_cart'])):
                                                            if (count($_SESSION['shopping_cart']) > 0):
                                                        ?>
                                                        <?php  
                                                                include ("includes/controller.php");
                                                            if (isset ($_SESSION['id'])) {
                                                                $id = $_SESSION['id'];
                                                            }else{
                                                                $id = '';
                                                            }
                                                            ?>
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="orderstotal" value="<?php echo $total ?>" />
                                                            <div class="">
                                                                <button class="au-btn au-btn-icon au-btn--green au-btn--small " name="confirm" style="margin-right: 45%">
                                                                    <i class="zmdi zmdi-plus"></i>Confirm
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </td>   
                                                        <?php 
                                                            endif;
                                                          endif; 
                                                        ?>
                                                    
                                                </tr>

                                                <?php  
                                                endif;
                                                ?>
                                        
                                    </table>
                                </div>
                           
                                    
                                    
                            </div>
                        </div>


                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                 <h2>List Order</h2>
                                <br>
                                <form class="form-header">
                                    <input type="text" name="search_text" id="search_text" placeholder="Search employee, invoice code, date, money..." class="form-control" />
                                    <span class="au-btn--submit" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </span>
                                </form>
                            
                                
                                <div id="result"></div>
                               
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

    <script>
    $(document).ready(function(){
        load_data();
        function load_data(query)
        {
            $.ajax({
                url:"fetch.php",
                method:"post",
                data:{query:query},
                success:function(data)
                {
                    $('#result').html(data);
                }
            });
        }
        
        $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != '')
            {
                load_data(search);
            }
            else
            {
                load_data();            
            }
        });
    });
    </script>

</body>

</html>
<!-- end document-->
