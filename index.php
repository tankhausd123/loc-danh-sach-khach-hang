<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
    table{
        border-collapse: collapse;
        width: 100%;
    }
    th, td{
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #a00d0e;
    }
</style>
<body>
<form method="post">
    Từ: <input id = "from" type="text" name="from" placeholder="yyyyy/mm/dd" />
    Đến: <input id = "to" type="text" name="to" placeholder="yyyy/mm/dd" />
    <input type = "submit" id = "submit" value = "Lọc"/>
</form>
<?php
$customer_list = [
    1=>['name' => 'Vương Trung Kiên',
        'birthday' => '13/06/1994',
        'address' => 'số 16- hồ Thiên Nga',
        'photo' => 'kien.jpeg'],
    2=>['name' => 'Dương Tuấn Anh',
        'birthday' => '20/03/2001',
        'address' => 'Hồ hoàn Kiếm- Hà Nội',
        'photo' => 'tuananh.jpg'],
    3=>['name' => 'Ngọc Vinh',
        'birthday' => '30/09/1998',
        'address' => 'Thanh Hóa',
        'photo' => 'vinh.jpg'],
    4=>['name' => 'Nguyễn Thị Ngân',
        'birthday' => '20/08/1995',
        'address' => 'Sóc Sơn- Hà Nội',
        'photo' => 'ngan.jpg'],
    5=>['name' => 'Ngô Thành Tân',
        'birthday' => '16/05/1997',
        'address' => 'Bắc Ninh',
        'photo' => 'tan.jpg']
];
function searchByDate($customers, $from_date, $to_date) {
    if(empty($from_date) && empty($to_date)){
        return $customers;
    }
    $filtered_customers = [];
    foreach($customers as $customer){
        if(!empty($from_date) && (strtotime($customer['birthday']) < strtotime($from_date)))
            continue;
        if(!empty($to_date) && (strtotime($customer['birthday']) > strtotime($to_date)))
            continue;
        $filtered_customers[] = $customer;
    }
    return $filtered_customers;
}
$from_date = NULL;
$to_date = NULL;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_date = $_POST["from"];
    $to_date = $_POST["to"];
}
$filtered_customers = searchByDate($customer_list, $from_date, $to_date);
?>
<table border="0">
    <caption><h2>Danh sách khách hàng</h2></caption>
    <tr>
        <th>Serial</th>
        <th>Name</th>
        <th>Birthday</th>
        <th>Address</th>
        <th>Photo</th>
    </tr>
    <?php if(count($filtered_customers) === 0):?>
        <tr>
            <td colspan="5" class="message">Không tìm thấy khách hàng nào</td>
        </tr>
    <?php endif; ?>

    <?php foreach($filtered_customers as $index => $customer): ?>
        <tr>
            <td><?php echo $index ;?></td>
            <td><?php echo $customer['name'];?></td>
            <td><?php echo $customer['birthday'];?></td>
            <td><?php echo $customer['address'];?></td>
            <td><div class="profile"><img src="<?php echo $customer['photo'];?>"/></div> </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
