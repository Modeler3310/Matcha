<div class="container theme-showcase mask rgba-gradient align-items-center rounded pb-4" role="main">

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="container">
<div class="mx-auto col-md-4 col-md-offset-4 text-center">

<div class="row mt-15 pt-3 pb-4">
</div>
    <p class="bg-primary"><em id='errors'></em></p>
    <form data-token="<?= $token ?>" id='confirm' method="post" action="#">
        <div class="form-group">
            <label class="h5" for="email">Nouveau mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
        </div>
        <div class="form-group">
            <label class="h5" for="username">Repetez le mot de passe</label>
            <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Repetez">
        </div>
        <button type="submit" class=" btn btn-outline-success" name="submit">Submit</button>
    </form>
</div>
</div>
</div>