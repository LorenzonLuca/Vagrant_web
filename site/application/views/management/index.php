<div class="container mt-5">
    <h2 class="text-center mb-4">Crea libro</h2>
    <form method="post" action="<?php echo URL ?>management/createbook" enctype="multipart/form-data">
        <div class="form-group mb-4">
            <label for="title">Titolo:</label>
            <input type="text" class="form-control" id="title" placeholder="Inserire titolo" name="title">
        </div>
        <div class="form-group mb-4">
            <label for="summary">Sommario:</label>
            <input type="text" class="form-control" id="summary" placeholder="Inserire Sommario" name="summary">
        </div>
        <div class="form-group mb-4">
            <label for="release-year">Anno d'uscita:</label>
            <input type="number" class="form-control" id="release-year" placeholder="Inserire l'anno d'uscita" name="release-year">
        </div>
        <div class="form-group mb-4">
            <label for="isbn">ISBN:</label>
            <input type="text" class="form-control" id="isbn" placeholder="Inserire l'ISBN" name="isbn">
        </div>
        <div class="form-group mb-4">
            <label for="price">Prezzo:</label>
            <input type="number" class="form-control" id="price" placeholder="Inserire il prezzo" name="price">
        </div>
        <div class="form-group mb-4">
            <label for="copies">Copie:</label>
            <input type="number" class="form-control" id="copies" placeholder="Inserire il numero di copie" name="copies">
        </div>
        <div class="form-group mb-4">
            <div class="input-group">
                <div class="custom-file">
                    <label for="cover-image">Immagine libro:</label>
                    <input type="file" class="custom-file-input" id="cover-image" accept=".png, .jpg, .jpeg" name="cover-image" onchange="loadFile(event)">
                    <img id="cover-image-out" width="200" />
                </div>
            </div>
        </div>
        <div class="form-group mb-4">
            <label for="authors">Seleziona un autore:</label>
            <select class="form-control" id="authors" name="authors" onchange="checkItemSelectedAuthors()">
                <option value="-1">Crea nuovo...</option>
                <?php foreach ($authors as $a):?>
                    <option value="<?php echo $a->getId()?>"><?php echo $a->getFullName()?></option>
                <?php endforeach;?>
            </select>
            <div class="container" id="create-authors-form">
                <div class="row">
                    <div class="col">
                        <label for="author-name">Nome:</label>
                        <input type="text" class="form-control" id="author-name" placeholder="Inserire il nome dell'autore" name="author-name">
                    </div>
                    <div class="col">
                        <label for="author-surname">Cognome:</label>
                        <input type="text" class="form-control" id="author-surname" placeholder="Inserire il cognome dell'autore" name="author-surname">
                    </div>
                    <div class="col">
                        <label for="author-year">Anno di nascita:</label>
                        <input type="number" class="form-control" id="author-year" placeholder="Inserire l'anno di nascita dell'autore" name="author-year">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group mb-4">
            <label for="publishers">Seleziona la casa editrice:</label>
            <select class="form-control" id="publishers" name="publishers" onchange="checkItemSelectedPublishers()">
                <option value="-1">Crea nuova...</option>
                <?php foreach ($publishers as $p):?>
                    <option value="<?php echo $p->getId()?>"><?php echo $p->getName()?></option>
                <?php endforeach;?>
            </select>
            <div class="container" id="create-publisher-form">
                <div class="row">
                    <div class="col">
                        <label for="publisher-name">Nome:</label>
                        <input type="text" class="form-control" id="publisher-name" placeholder="Inserire nome della casa editrice" name="publisher-name">
                    </div>
                    <div class="col">
                        <label for="publisher-country">Nazione:</label>
                        <input type="text" class="form-control" id="publisher-country" placeholder="Inserire la nazione della casa editrice" name="publisher-country">
                    </div>
                    <div class="col">
                        <label for="publisher-year">Anno di fondazione:</label>
                        <input type="number" class="form-control" id="publisher-year" placeholder="Inserire anno di fondazione della casa editrice" name="publisher-year">

                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <?php if(isset($error)): ?>
                <p class="text-danger"><?php echo $error?></p>
            <?php endif; ?>
            <?php if(isset($created)): ?>
                <p class="text-success"><?php echo $created?></p>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Crea libro</button>
        </div>
    </form>
</div>
<script>
    checkItemSelectedAuthors();
    checkItemSelectedPublishers()

    function checkItemSelectedAuthors(){
        var selectAuthors = document.getElementById("authors");
        var createAuthorsForm = document.getElementById("create-authors-form");
        var authorNameInput = document.getElementById("author-name");
        var authorSurnameInput = document.getElementById("author-surname");
        var authorYearInput = document.getElementById("author-year");

        if(selectAuthors.value == -1){
            createAuthorsForm.style.display = "block";
        }else{
            createAuthorsForm.style.display = "none";
            authorNameInput.value = null;
            authorSurnameInput.value = null;
            authorYearInput.value = null;
        }
    }

    function checkItemSelectedPublishers(){
        var selectPublishers = document.getElementById("publishers");
        var createPublishersForm = document.getElementById("create-publisher-form");
        var publisherNameInput = document.getElementById("publisher-name");
        var publisherCountryInput = document.getElementById("publisher-country");
        var publisherYearInput = document.getElementById("publisher-year");

        if(selectPublishers.value == -1){
            createPublishersForm.style.display = "block";
        }else{
            createPublishersForm.style.display = "none";
            publisherNameInput.value = null;
            publisherCountryInput.value = null;
            publisherYearInput.value = null;
        }
    }

    const loadFile = function(event){
        var img = document.getElementById("cover-image-out");
        img.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
<?php
