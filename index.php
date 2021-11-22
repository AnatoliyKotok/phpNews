<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Новини</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">

</head>
<body>
<?php
$contact="Contacts";
$b = 23;
?>
<?php include "navbar.php"; ?>

    <div class="container">
        <h1>Новини</h1>

        <a href="/create.php" class="btn btn-success">Додоати новину</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Назва</th>
                <th scope="col">Опис</th>
                <th scope="col">Фото</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include "conection_database.php";
            $reader = $conn->query("SELECT * FROM news");
            foreach ($reader as $row) {
                echo "
                <tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['description']}</td>
                    <td>
                        <img src='/images/{$row['image']}' alt='манул' width='100' />
                    </td>
                    <td>
                    <a id='Delete'  class='btn btn-danger btnDelete' data-id='{$row['id']}'>Delete</a>
                    </td>
                </tr>
                ";
            }
            ?>

            </tbody>
        </table>


        <?php include "model_delete.php"; ?>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/axios.min.js"></script>
        <script>
            var myModal = new bootstrap.Modal(document.getElementById("myModal"), {});
            window.addEventListener('load', function () {
                const list = document.querySelectorAll(".btnDelete");
                let removeId=0; //id element delete
                for (let i = 0; i < list.length; i++) {
                    list[i].addEventListener("click", function (e) {
                        e.preventDefault();
                        removeId = e.currentTarget.dataset.id;
                        myModal.show();
                    });
                }
                //Нажали кнопку видалити
                document.querySelector("#btnDeleteNews").addEventListener("click", function() {
                    const formData = new FormData();
                    formData.append("id", removeId);
                    axios.post("/delete.php", formData)
                        .then(resp => {
                            location.reload();
                        });
                });
            });
        </script>
</body>
</html>