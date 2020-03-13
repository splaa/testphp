<?php

include __DIR__ . '/function.php';
$post = isset($_POST['submit']) ? $_POST : null;

if ($post) {
	insertDbUser($post);
}
?>

<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PhpTest</title>


    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <!-- Custom style -->
    <style>
        main > .container {
            padding: 80px 15px 0;
        }

        body {
            margin: 70px;
        }

        .footer {
            background-color: #f5f5f5;
        }

        .footer > .container {
            padding-right: 15px;
            padding-left: 15px;
        }

        input.error {
            border: 1px solid #ff0000;
        }
        label.error {
            color: #ff0000;
            font-weight: normal;
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
                        <a href="/" class="nav-link">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main class="flex-shrink-0">
    <div class="container">
        <h1>Регистрация пользователя.</h1>
        <form id="form" action="index.php" method="post">
            <div class="row">
                <div class="col">
                    <input name="fio" id="name" type="text" class="form-control" placeholder="ФИО">
                </div>
                <div class="col">
                    <input name="email" id="email" type="email" class="form-control" placeholder="EMAIL">
                </div>
            </div>
            <h2>Список областей</h2>
            <div class="side-by-side clearfix">
                <div>
                    <em>Список областей:</em>
                    <select name="region_id" autocomplete="off" data-placeholder="Выберите область..." class="chosen-select" tabindex="1">
                        <option value=""></option>
                        <?php foreach (getRegion() as $region): ?>
                            <option value="<?php echo $region['ter_pid'] ?>"><?php echo $region['ter_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br>
                    <em>Список городов:</em>
                    <select name="city"  autocomplete="off"
                            style="min-width: 200px"
                            data-placeholder="Выберите город..."
                            class="chosen-select" tabindex="1">
                        <option value=""></option>
                    </select>
                    <br>
                    <em>Список районов:</em>
                    <select name="area" autocomplete="off"
                            data-placeholder="Выберите район..."
                            class="chosen-select" tabindex="1"
                            style="min-width: 200px">
                        <option value=""></option>
                    </select>

                </div>
                <button name="submit" type="submit" class="btn btn-success">Submit</button>

        </form>
    </div>
</main>

<footer class="footer mt-auto py-3">
    <div class="container">
        <span class="text-muted">App</span>
    </div>

</footer>

<script src="jquery-2.1.1.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script src="lib/chosen_v1.8.7/chosen.jquery.js" type="text/javascript"></script>
<script src="lib/chosen_v1.8.7/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
<script src="lib/chosen_v1.8.7/docsupport/init.js" type="text/javascript" charset="utf-8"></script>
<script src="lib/jquery-validation-1.15.1/dist/jquery.validate.js"></script>
<script type="text/javascript">
    $(".chosen-select").chosen();

    $('select[name=\'region_id\']').on('change', function () {
        $.ajax({
            url: 'function.php?action=getCity&ter_id=' + this.value,
            dataType: 'json',
            success: function (json) {
                let html = '<option value=""></option>';

                if (json) {
                    for (i = 0; i < json.length; i++) {
                        html += '<option value="' + json[i]['ter_pid'] + '">' + json[i]['ter_name'] + '</option>';
                    }
                } else {
                    html += '<option value="0" selected="selected">Ничего не найденно</option>';
                }

                $('select[name=\'city\']').html(html);
                $('select[name=\'city\']').trigger('chosen:updated');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                // alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
    $('select[name=\'city\']').on('change', function () {
        console.log(this.value);
        $.ajax({
            url: 'function.php?action=getArea&ter_id=' + this.value,
            dataType: 'json',
            success: function (json) {
                let html = '<option value=""></option>';

                if (json) {
                    for (i = 0; i < json.length; i++) {
                        html += '<option value="' + json[i]['ter_pid'] + '">' + json[i]['ter_name'] + '</option>';
                    }
                } else {
                    html += '<option value="0" selected="selected">Ничего не найденно</option>';
                }

                $('select[name=\'area\']').html(html);
                $('select[name=\'area\']').trigger('chosen:updated');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                // alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    $('select[name=\'region_id\']').trigger('change');

    // валидация полей формы
    $(function () {
        $('#form').validate({
            rules: {
                fio: {
                    required: true,
                    minlength: 3

                },
                email:{
                    required: true

                }


            },
            messages: {
                fio: {
                    required: "Поле 'Имя' обязательно к заполнению",
                    minlength: "Введите не менее 3-х символов в поле 'Имя'"
                },
                email: {
                    required: "Поле 'Email' обязательно к заполнению",
                    email: "Необходим формат адреса email"
                }
            }
        });
    });
</script>
<?php if (!empty($user)):?>
	<!-- Modal -->
	<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="userModalLabel">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table">
						<thead class="thead-light">
						<tr>
							<th scope="col">#</th>
							<th scope="col">ФИО</th>
							<th scope="col">Email</th>
							<th scope="col">Область</th>
							<th scope="col">Город</th>
							<th scope="col">Район</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row"><?php echo $user['id'] ?></th>
								<td><?php echo $user['name'] ?></td>
								<td><?php echo $user['email'] ?></td>
								<td><?php echo $user['region'] ?></td>
								<td><?php echo $user['city'] ?></td>
								<td><?php echo $user['area'] ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<script>
        $(document).ready(function(){
            $('#userModal').modal('show');
        });
	</script>
<?php endif; ?>
</body>
</html>
