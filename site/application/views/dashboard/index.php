<style>
    td, th{
        text-align: center;
    }

</style>
<script>
    function deleteBook(id, title){
        const confirmation = window.confirm(`Sei sicuro di voler eliminare il libro '${title}'?`);
        if(!confirmation){
            return;
        }
        $.ajax({
            url: `<?php echo URL ?>bookinfo/delete/${id}`,
            type: 'POST',
            processData: false,
            contentType: false
        });
        window.location.reload();
    }
</script>
<div class="container mt-5">
    <?php if($_SESSION['is_admin']) : ?>
        <div>
            <input id="search-input" type="text" class="form-control my-2" placeholder="Ricerca:" style="width: 50%">
        </div>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table" id="book-table">
            <thead>
            <tr>
                <?php if(!$_SESSION['is_admin']):?>
                <th scope="col"></th>
                <?php endif;?>
                <th scope="col">Titolo</th>
                <th scope="col">Autore</th>
                <th scope="col" class="d-none d-md-table-cell">Prezzo</th>
                <th scope="col" class="d-none d-md-table-cell">Numero Copie</th>
                <th scope="col" class="d-none d-md-table-cell">Stato</th>
                <th scope="col" class="d-none d-md-table-cell"></th>
                <?php if($_SESSION['is_admin']):?>
                    <th scope="col">Modifica</th>
                    <th scope="col">Rimuovi</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $book) : ?>
            <tr>
                <form class="update-copies-form" method="post" action="<?php echo URL ?>bookinfo/update/<?php echo $book->getId() ?>">
                    <?php if(!$_SESSION['is_admin']):?>
                    <td class="align-middle" onclick="location.href = '/bookinfo/book/<?php echo $book->getId() ?>'"><i class="fa-solid fa-circle-info fs-2" style="color: var(--bs-blue);"></i></td>
                    <?php endif;?>
                    <td class="align-middle"><?php echo $book->getTitle() ?></td>
                    <td class="align-middle"><?php echo $book->getAuthor()->getName() . " " . $book->getAuthor()->getSurname() ?></td>
                    <td class="d-none d-md-table-cell align-middle">CHF <?php echo $book->getPrice() ?></td>
                    <td class="d-none d-md-table-cell align-middle">
                        <div class="input-group align-items-center">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-danger btn-number btn-decrement">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </span>
                            <input type="number" name="copies" class="form-control input-number mx-1" style="max-width: 100px;" value="<?php echo $book->getCopies() ?>" min="0">
                             <span class="input-group-btn">
                                <button type="button" class="btn btn-success btn-number btn-increment">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </span>
                        </div>
                    </td>
                    <td class="d-none d-md-table-cell">
                        <div class="d-flex align-items-center justify-content-between" style="gap: 5px">
                            <?php
                            $status = $book->getStatus();
                            $icon = "";
                            switch ($status){
                                case "Disponibile":
                                    $icon = '<i class="fa-solid fa-check"></i>';
                                    break;
                                case "In ordinazione":
                                    $icon = '<i class="fa-solid fa-truck"></i>';
                                    break;
                                case "Non disponibile":
                                    $icon = '<i class="fa-solid fa-x"></i>';
                                    break;
                                case "Da ordinare":
                                    $icon = '<i class="fa-solid fa-cart-shopping"></i>';
                                    break;
                            }
                            echo $icon;
                            echo "<span>$status</span>";
                            ?>
                        </div>
                    </td>
                    <td class="d-none d-md-table-cell align-middle">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i></button>
                    </td>
                </form>
                <?php if($_SESSION['is_admin']):?>
                    <form method="post" action="<?php echo URL ?>bookinfo/edit/<?php echo $book->getId() ?>">
                        <td class="align-middle">
                            <button type="submit" class="btn btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </td>
                    </form>
                    <td class="align-middle">
                        <button type="button" onclick="deleteBook(<?php echo $book->getId() ?>, '<?php echo $book->getTitle() ?>')" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
               <?php endif;?>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div id="no-matching" class="d-flex justify-content-center d-none">
            <span class="text-center">Nessun libro trovato.</span>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.btn-decrement').on('click', function () {
            const inputElement = $(this).closest('.input-group').find('.input-number');
            let currentValue = parseInt(inputElement.val(), 10);
            if(isNaN(currentValue)){
                currentValue = 0;
            }

            if (currentValue > 0) {
                inputElement.val(currentValue - 1);
            }
        });

        $('.btn-increment').on('click', function () {
            const inputElement = $(this).closest('.input-group').find('.input-number');
            let currentValue = parseInt(inputElement.val(), 10);
            if(isNaN(currentValue)){
                currentValue = 0;
            }

            inputElement.val(currentValue + 1);
        });
        function filterTable() {
            if(!<?php echo $_SESSION['is_admin'] ?>){
                return;
            }
            let searchText = $('#search-input').val().toLowerCase();
            let matchingCount = 0;
            $('#book-table tbody tr').each(function () {
                let rowText = $(this).text().toLowerCase();
                if (rowText.includes(searchText)) {
                    $(this).show();
                    matchingCount++;
                } else {
                    $(this).hide();
                }
            });
            $('#no-matching').toggleClass('d-none', matchingCount !== 0);
            $('#book-table thead').toggleClass('d-none', matchingCount === 0);
        }
        filterTable();
        $('#search-input').on('input', function () {
            filterTable();
        });

    });
</script>