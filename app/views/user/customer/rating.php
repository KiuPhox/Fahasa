<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa địa chỉ</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../vendor/components/font-awesome/css/all.css">
    <style>
        .account-container {
            background: none;
            display: flex;
            width: 83%;
            margin: 12px auto;
        }

        .block-account {
            background: white;
            border: 1px solid #e6e6e6;
            border-radius: 8px;
            padding: 1rem;
            padding-bottom: 0;
        }

        .block-title {
            padding: 18px 20px;
            font-size: 20px;
            font-weight: 600;
            border-bottom: 2px solid #f6f6f6;
            color: #C92127;
            font-size: 20px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .block-account .block-content li {
            border-bottom: 1px solid #f2f2f2;
            color: #ea7696;
        }

        .block-account .block-content .current a {
            color: #bf9a61;
        }

        .block-account .block-content li a {
            display: block;
            padding: 10px 0px;
            transition: all 300ms ease-in 0s;
        }

        .my-account {
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        .page-title h1 {
            font-size: 20px;
            text-transform: uppercase;
            font-weight: 400;
            line-height: 36px;
            color: #565555;
        }

        .box-account {
            padding: 15px;
            margin: 0 0 20px;
        }

        .box-account .box-head {
            border-bottom: 1px solid #f2f2f2;
            margin: 0 0 10px;
            text-align: right;
        }

        .box-account .box-head h2 {
            float: left;
            margin: 0;
            font-size: 17px;
            font-weight: normal;
            background-position: 0 0;
            background-repeat: no-repeat;
            color: #333;
            text-transform: uppercase;
        }

        .box-recent .box-head a {
            padding-top: 10px;
            display: block;
            color: #C92127;
        }

        .data-table {
            width: 100%;
            background: transparent;
        }

        .data-table thead th {
            font-family: Arial, Helvetica, sans-serif !important;
            font-weight: 600;
            vertical-align: bottom;
            padding: 10px;
            white-space: nowrap;
            text-align: left;
            text-transform: capitalize;
            font-size: 14px;
        }

        .data-table tr td {
            padding: 10px;
            font-size: 14px;
        }
    </style>

</head>

<body>
    <?php include(dirname(__FILE__) . '/' . '../../layouts/header.php'); ?>
    <div class="account-container row">
        <div class="col-left col-lg-3 col-md-3 col-sm-12 col-xs-12" style="padding: 0;">
            <div class="block-account">
                <div class="block-title">
                    Tài khoản
                </div>
                <div class="block-content">
                    <ul>
                        <li><a href="<?php echo $_ENV['DOMAIN']; ?>/customer/account">Bảng điều khiển tài khoản</a></li>
                        <li><a href="<?php echo $_ENV['DOMAIN']; ?>/customer/account/edit">Thông tin tài khoản</a></li>
                        <li><a href="<?php echo $_ENV['DOMAIN']; ?>/customer/address">Sổ địa chỉ</a></li>
                        <li><a href="<?php echo $_ENV['DOMAIN']; ?>/customer/order">Đơn hàng của tôi</a></li>
                        <li class="current"><a href="<?php echo $_ENV['DOMAIN']; ?>/customer/rating">Nhận xét của tôi</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-main col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="my-account mb-4">
                <div class="page-title">
                    <h1>Nhận xét của tôi</h1>
                    <div style="overflow-x:scroll;" class="box-account box-recent">
                        <table class="data-table table-striped account-order-history" id="my-orders-table">
                            <colgroup>
                                <col width="1">
                                <col width="">
                                <col width="1">
                                <col width="">
                                <col width="">
                            </colgroup>
                            <thead>
                                <tr class="first last">
                                    <th>Ngày</th>
                                    <th>Sách</th>
                                    <th>Đánh giá</th>
                                    <th>Bình luận</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ratings as $rating) {
                                    if ($rating['is_approved'] == 1) { ?>
                                        <tr class="">
                                            <td><span class="nobr"><?php echo date_format(date_create($rating['created_at']), "d/m/Y")  ?></span></td>
                                            <td><?php echo Book::getByID($rating['book_id'])['title'] ?></td>
                                            <td>
                                                <span class="price"><?php echo $rating['rating'] ?></span>
                                            </td>
                                            <td><?php echo mb_substr($rating['comment'], 0, 100) ?>...</td>
                                            <td class="a-center last">
                                                <span class="nobr">
                                                    <a href="<?php echo $_ENV['DOMAIN']; ?>/product/<?php echo $rating['book_id'] ?>">Xem</a>
                                                </span>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include(dirname(__FILE__) . '/' . '../../layouts/footer.php'); ?>
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    </script>
</body>

</html>