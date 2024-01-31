<div class="container mt-5">
    <h2 class="text-center mb-4">Visualizza Libro</h2>
    <form id="update-copies-form">
        <div class="form-group mb-4">
            <label>Titolo:</label>
            <input type="text" class="form-control" disabled value="<?php echo $book->getTitle() ?>">
        </div>
        <div class="form-group mb-4">
            <label>Sommario:</label>
            <input type="text" class="form-control" disabled value="<?php echo $book->getSummary() ?>">
        </div>
        <div class="form-group mb-4">
            <label>Anno di uscita:</label>
            <input type="number" class="form-control" disabled value="<?php echo $book->getReleaseYear() ?>">
        </div>
        <div class="form-group mb-4">
            <label>ISBN:</label>
            <input type="text" class="form-control" disabled value="<?php echo $book->getIsbn() ?>">
        </div>
        <div class="form-group mb-4">
            <label>Prezzo:</label>
            <input type="number" class="form-control" disabled value="<?php echo $book->getPrice() ?>">
        </div>
        <div class="form-group mb-4">
            <label>Copie:</label>
            <div class="d-flex" style="flex: 4; gap: 5px">
                <input type="number" class="form-control" name="copies" value="<?php echo $book->getCopies() ?>" style="flex: 3;">
                <button type="submit" class="btn btn-primary"  style="flex: 1">Salva</button>
            </div>
            <label>In ordinazione:</label>
            <input type="hidden" name="ordered" value="off">
            <input type="checkbox" name="ordered" value="on" <?php echo $book->getOrdered() ? "checked" : "" ?>>
        </div>
        <div class="form-group mb-4">
            <label>Foto di copertina:</label>
            <img src="application/img/<?php echo $book->getCoverImage()?>" style="width: 200px;">
        </div>
        <div class="form-group mb-4">
            <label>Autore:</label>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <label>Nome:</label>
                        <input type="text" class="form-control" disabled value="<?php echo $book->getAuthor()->getName() ?>">
                    </div>
                    <div class="col">
                        <label>Cognome:</label>
                        <input type="text" class="form-control" disabled value="<?php echo $book->getAuthor()->getSurname() ?>">
                    </div>
                    <div class="col">
                        <label>Anno di nascita:</label>
                        <input type="number" class="form-control" disabled value="<?php echo $book->getAuthor()->getYear() ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group mb-4">
            <label>Casa editrice:</label>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <label>Nome:</label>
                        <input type="text" class="form-control" disabled value="<?php echo $book->getPublisher()->getName(); ?>">
                    </div>
                    <div class="col">
                        <label>Nazione:</label>
                        <input type="text" class="form-control" disabled value="<?php echo $book->getPublisher()->getCountry(); ?>">
                    </div>
                    <div class="col">
                        <label>Anno di fondazione:</label>
                        <input type="number" class="form-control" disabled value="<?php echo $book->getPublisher()->getYear(); ?>">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $("#update-copies-form").submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: "<?php echo URL ?>bookinfo/update/<?php echo $book->getId() ?>",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false
        });
    });
</script>
<?php
