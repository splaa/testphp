<?php

include 'db.php';
?>

<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PhpTest</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          crossorigin="anonymous">
    <!-- Custom style -->
    <style>
        main > .container {
            padding: 80px 15px 0;
        }

        .footer {
            background-color: #f5f5f5;
        }

        .footer > .container {
            padding-right: 15px;
            padding-left: 15px;
        }
    </style>
    <link rel="stylesheet" href="lib/chosen_v1.8.7/chosen.min.css"/>
</head>
<body class="d-flex flex-column h-100">
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container">

            <a href="" class="navbar-brand">App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a href="#" class="nav-link">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main class="flex-shrink-0">
    <div class="container">
        <h1>Регистрация пользователя.</h1>
        <form>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="ФИО">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="EMAIL">
                </div>
            </div>
            <h2>Список областей</h2>
            <div class="side-by-side clearfix">
                <div>
                    <em>Список областей:</em>
                    <select name="region_id" data-placeholder="Выберите область..." class="chosen-select" tabindex="1">
                        <option value=""></option>

                            <option value="<?php echo $region['ter_name'] ?> "><?php echo $region['ter_name'] ?></option>

                    </select>
                    <br>
<!--                    <em>Список городов:</em>-->
<!--                    <select data-placeholder="Выберите город..." class="chosen-select" tabindex="1">-->
<!--                        <option value=""></option>-->
<!--                        --><?php //foreach ($data as $region): ?>
<!--                            <option value="--><?php //echo $region['ter_name'] ?><!-- ">--><?php //echo $region['ter_name'] ?><!--</option>-->
<!--                        --><?php //endforeach; ?>
<!--                    </select>-->
<!--                    <br>-->
<!--                    <em>Список районов:</em>-->
<!--                    <select data-placeholder="Выберите город..." class="chosen-select" tabindex="1">-->
<!--                        <option value=""></option>-->
<!--                        --><?php //foreach ($data as $region): ?>
<!--                            <option value="--><?php //echo $region['ter_name'] ?><!-- ">--><?php //echo $region['ter_name'] ?><!--</option>-->
<!--                        --><?php //endforeach; ?>
<!--                    </select>-->

                </div>


        </form>
    </div>
</main>

<footer class="footer mt-auto py-3">
    <div class="container">
        <span class="text-muted">App</span>
    </div>

</footer>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="lib/chosen_v1.8.7/docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="lib/chosen_v1.8.7/chosen.jquery.js" type="text/javascript"></script>
<script src="lib/chosen_v1.8.7/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
<script src="lib/chosen_v1.8.7/docsupport/init.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(".chosen-select").chosen();
    $('select[name=\'region_id\']').on('change', function() {
        $.ajax({
            url: 'function.php?action=getCity&ter_pid=' + this.value,
            dataType: 'json',
            success: function(json) {
                // let html = '<option value=""></option>';
                //
                // if (json) {
                //     for (i = 0; i < json.length; i++) {
                //         html += '<option value="' + json[i]['region_type'] + '">' + json[i]['name'] + '</option>';
                //     }
                // } else {
                //     html += '<option value="0" selected="selected">Ничего не найденно</option>';
                // }
                //
                // $('select[name=\'region_id\']').html(html);
                console.log(json);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                 alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    $('select[name=\'region_id\']').trigger('change');


   </script>
</body>
</html>
