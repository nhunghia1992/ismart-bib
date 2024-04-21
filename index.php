<!DOCTYPE html>
<html lang="vi-VN">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="http://gmpg.org/xfn/11" rel="profile" />
    <title>
        Tra cứu thông tin - iSMART Online Global Marathon
    </title>
    <meta content="vi_VN" property="og:locale" />
    <meta content="article" property="og:type" />
    <meta content="Tra cứu thông tin - iSMART Online Global Marathon" property="og:title" />
    <meta content="Tra cứu thông tin - iSMART Online Global Marathon" property="og:description" />
    <meta content="iSMART Education" property="og:site_name" />
    <meta content="<?php echo strtok((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", '?'); ?>og.jpg" property="og:image" />
    <meta content="summary" name="twitter:card" />
    <meta content="Tra cứu thông tin - iSMART Online Global Marathon" name="twitter:description" />
    <meta content="Tra cứu thông tin - iSMART Online Global Marathon" name="twitter:title" />
    <meta content="<?php echo strtok((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", '?'); ?>og.jpg" name="twitter:image" />
    <meta property="og:url" content="<?php echo strtok((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", '?'); ?>" />
    <link rel="icon" href="https://test.ismartonline.edu.vn/wp-content/uploads/2024/02/cropped-logo-iSGA-1x1-2-32x32.png" sizes="32x32" />
    <link rel="icon" href="https://test.ismartonline.edu.vn/wp-content/uploads/2024/02/cropped-logo-iSGA-1x1-2-192x192.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="https://test.ismartonline.edu.vn/wp-content/uploads/2024/02/cropped-logo-iSGA-1x1-2-180x180.png" />
    <meta name="msapplication-TileImage" content="https://test.ismartonline.edu.vn/wp-content/uploads/2024/02/cropped-logo-iSGA-1x1-2-270x270.png" />

    <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">

    <style type="text/css">
        body {
            background-image: url(bg.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            min-height: 100vh;
        }

        .main-img {
            width: 100%;
            max-width: 1000px;
            display: block;
            margin: auto;
            margin-top: 3rem;
        }

        .form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 80px;
        }

        .inputWrapper {
            height: 150px;
            aspect-ratio: 16/7;
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
            position: relative;
        }

        .inputName {
            background-image: url(name.svg);
        }

        .inputPhone {
            background-image: url(phone.svg);
        }

        .formInput {
            position: absolute;
            width: 70%;
            top: 58%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            background: none;
            border: none;
            outline: none;
            border-bottom: 1px solid #fff;
            font-size: 1.2rem;
            color: #fff;
        }

        .search {
            margin-top: 50px;
        }

        @media (max-width: 767px) {
            .search {
                margin-top: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="logos d-flex align-items-start justify-content-between">
        <div class="logo-left">
            <img class="img-fluid" src="logo-left.png" />
        </div>
        <div class="logo-right">
            <img class="img-fluid" src="logo-right.png" />
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img class="main-img" src="main.svg" />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3">
                <div class="search">
                    <form action="search.php" method="POST" id="search_form">
                        <?php
                        $curentConfig = json_decode(file_get_contents('config/config.json'), true);
                        $sheetNames = preg_split("/\r\n|\n|\r/", $curentConfig['sheetName']);
                        ?>
                        <div class="inputWrapper inputName">
                            <input type="text" class="formInput" aria-label="Họ và tên học sinh" name="name" required="">
                        </div>
                        <div class="inputWrapper inputPhone">
                            <input type="text" class="formInput" aria-label="Số điện thoại phụ huynh" name="phone" required="">
                        </div>
                        <select name="school" class="d-none" required="">
                            <?php
                            if (count($sheetNames) > 1) {
                                echo '<option value="">Trường</option>';
                            }
                            foreach ($sheetNames as $sheetName) {
                                $sheetName_arr = explode(":", $sheetName);
                                $sheetName_value = $sheetName_arr[0];
                                if (isset($sheetName_arr[1])) {
                                    $sheetName_display = $sheetName_arr[1];
                                } else {
                                    $sheetName_display = $sheetName_arr[0];
                                }
                                echo '<option value="' . $sheetName_value . '">' . $sheetName_display . '</option>';
                            }
                            ?>
                        </select>
                        <button class="btn btn-success w-100 mt-3" type="submit">
                            <span class="icon spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            <span class="text">Tra cứu</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <div class="d-flex justify-content-center mt-3">
                        <div class="spinner-grow text-light d-none" id="table_loading" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <table class="table table-light table-hover table-striped text-center mt-5 d-none" id="search_result">
                        <thead>
                            <tr>
                                <th scope="col" class="<?php if (!array_key_exists('show_index', $curentConfig)) {
                                                            echo 'd-none';
                                                        } ?>">#</th>
                                <th scope="col" class="<?php if ($curentConfig['studentname_col'] == '') {
                                                            echo 'd-none';
                                                        } ?>">Họ tên HS</th>
                                <th scope="col" class="<?php if ($curentConfig['grade_col'] == '') {
                                                            echo 'd-none';
                                                        } ?>">Lớp</th>
                                <th scope="col" class="<?php if ($curentConfig['parentname_col'] == '') {
                                                            echo 'd-none';
                                                        } ?>">Họ tên PH</th>
                                <th scope="col" class="<?php if ($curentConfig['parentphone_col'] == '') {
                                                            echo 'd-none';
                                                        } ?>">SĐT</th>
                                <th scope="col" class="<?php if ($curentConfig['parentemail_col'] == '') {
                                                            echo 'd-none';
                                                        } ?>">Email</th>
                                <th scope="col" class="<?php if (count($sheetNames) <= 1) {
                                                            echo 'd-none';
                                                        } ?>">Trường</th>
                                <th scope="col" class="<?php if ($curentConfig['bib_col'] == '') {
                                                            echo 'd-none';
                                                        } ?>">Số Báo Danh (Mã BIB)</th>
                                <?php if (array_key_exists('guide_file', $curentConfig)) { ?>
                                    <th scope="col">Hướng dẫn đổi tên và background Zoom</th>
                                    <th scope="col">Link background Zoom</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('#search_form').on('submit', function(e) {
            e.preventDefault();
            $('button[type="submit"]').prop('disabled', true);
            $('button[type="submit"] .text').addClass('d-none');
            $('button[type="submit"] .icon').removeClass('d-none');
            $('#search_result').addClass('d-none');
            $('#table_loading').removeClass('d-none');
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(result) {
                    var jsonResult = JSON.parse(result);
                    if (jsonResult.length > 0) {
                        var resultHtml = '<tr>';
                        for (i = 0; i < jsonResult[0].length; i++) {
                            if (jsonResult[0][i] == null) {
                                resultHtml += '<td class="d-none">';
                            } else {
                                resultHtml += '<td>';
                            }
                            resultHtml += jsonResult[0][i];
                            resultHtml += '</td>';
                        }
                        <?php if (array_key_exists('guide_file', $curentConfig)) { ?>
                            resultHtml += '<td class="text-center">';
                            resultHtml += '<a target="_blank" href="' + location.protocol + '//' + location.host + location.pathname + 'Huong_dan_doi_ten_-_Background_Zoom_Math_Science_Online_Marathon.pdf"><i class="bi bi-download"></i></a>';
                            resultHtml += '</td>';

                            resultHtml += '<td class="text-center">';
                            resultHtml += '<a download target="_blank" href="' + location.protocol + '//' + location.host + location.pathname + 'zoom-bg.jpg"><i class="bi bi-download"></i></a>';
                            resultHtml += '</td>';

                            resultHtml += '</tr>';
                        <?php } ?>
                    } else {
                        var resultHtml = '<tr>';
                        resultHtml += '<td class="text-center" colspan="' + $('#search_result thead th').length + '">';
                        resultHtml += 'Không tìm thấy thông tin';
                        resultHtml += '</td>';
                        resultHtml += '</tr>';
                    }
                    $('#search_result tbody').html(resultHtml);
                    $('button[type="submit"]').prop('disabled', false);
                    $('button[type="submit"] .text').removeClass('d-none');
                    $('button[type="submit"] .icon').addClass('d-none');
                    $('#search_result').removeClass('d-none');
                    $('#table_loading').addClass('d-none');
                }
            });
        });
    </script>
</body>

</html>