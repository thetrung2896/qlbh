<?php
$product_ids = array();
//session_destroy();

//Kiểm tra xem nút add_to_cart đã được gửi chưa
if(filter_input(INPUT_POST, 'add_to_cart')){
    if(isset($_SESSION['shopping_cart'])){
        
        //theo dõi số lượng sản phẩm trong giỏ hàng
        $count = count($_SESSION['shopping_cart']);
        
        //tạo mảng tuần tự cho các khóa mảng phù hợp với các sản phẩm của id
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');
        
        if (!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
        $_SESSION['shopping_cart'][$count] = array
            (
                'id' => filter_input(INPUT_GET, 'id'),
                'name' => filter_input(INPUT_POST, 'name'),
                'price' => filter_input(INPUT_POST, 'price'),
                'quantity' => filter_input(INPUT_POST, 'quantity')
            );   
        }
        else { //sản phẩm đã tồn tại, tăng số lượng
            //kết hợp khóa mảng với id của sản phẩm đang được thêm vào hóa đơn
            for ($i = 0; $i < count($product_ids); $i++){
                if ($product_ids[$i] == filter_input(INPUT_GET, 'id')){
                    //thêm số lượng sản phẩm vào sản phẩm hiện có trong mảng
                    $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
            }
        }
        
    }
    else { //nếu giỏ hàng không tồn tại, hãy tạo sản phẩm đầu tiên có khóa mảng 0
        //tạo mảng bằng cách sử dụng dữ liệu biểu mẫu đã gửi, bắt đầu từ khóa 0 và điền nó với các giá trị
        $_SESSION['shopping_cart'][0] = array
        (
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
        );
    }
}

if(filter_input(INPUT_GET, 'action') == 'delete'){
    //lặp tất cả các sản phẩm trong hóa đơn cho đến khi nó khớp với biến GET id
    foreach($_SESSION['shopping_cart'] as $key => $product){
        if ($product['id'] == filter_input(INPUT_GET, 'id')){
            //xóa sản phẩm khỏi giỏ hàng khi nó khớp với GET id
            unset($_SESSION['shopping_cart'][$key]);
        }
    }
    //reset session array keys so they match with $product_ids numeric array
    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}

//pre_r($_SESSION);

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}