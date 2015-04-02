<?php /** @var \Model\Dto\ChaineDTO $chaineDTO */ ?>
<?php /** @var string $action */ ?>

<div class="columns small-12">
    <h1><?= $action == 'post' ? 'Créer une chaîne' : 'Modifier la chaîne ' . $chaineDTO->getNomChaine() ?></h1>

    <form method="post"
          action="<?= $action == 'post' ? '/chaine/create' : '/chaine/update/' . $chaineDTO->getChaineId() ?>">
        <div class="row">
            <div class="small-6 columns">
                <div class="row">
                    <div class="small-3 columns">
                        <label for="form-nomChaine" class="right inline">Nom</label>
                    </div>
                    <div class="small-9 columns">
                        <input type="text" id="form-nomChaine" name="nomChaine" placeholder="Nom de la chaine" required
                            <?= !empty($chaineDTO->getNomChaine()) ? 'value="' . $chaineDTO->getNomChaine() . '"' : '' ?> />
                    </div>
                </div>
                <div class="row">
                    <div class="small-3 columns">
                        <label for="form-adresse" class="right inline">Adresse</label>
                    </div>
                    <div class="small-9 columns">
                        <input type="text" id="form-adresse" name="adresse" placeholder="Adresse de la chaine"
                            <?= !empty($chaineDTO->getAdresse()) ? 'value="' . $chaineDTO->getAdresse() . '"' : '' ?> />
                    </div>
                </div>
                <div class="row">
                    <div class="small-3 columns">
                        <label for="form-codePostal" class="right inline">Code postal</label>
                    </div>
                    <div class="small-9 columns">
                        <input type="text" id="form-codePostal" name="codePostal" placeholder="Code postal de la chaine"
                            <?= !empty($chaineDTO->getCodePostal()) ? 'value="' . $chaineDTO->getCodePostal() . '"' : '' ?> />
                    </div>
                </div>
                <div class="row">
                    <div class="small-3 columns">
                        <label for="form-ville" class="right inline">Ville</label>
                    </div>
                    <div class="small-9 columns">
                        <input type="text" id="form-ville" name="ville" placeholder="Ville de la chaine"
                            <?= !empty($chaineDTO->getVille()) ? 'value="' . $chaineDTO->getVille() . '"' : '' ?> />
                    </div>
                </div>
            </div>
            <div class="small-6 columns">
                <div class="row">
                    <div class="small-3 columns">
                        <label for="form-telephone" class="right inline">Téléphone</label>
                    </div>
                    <div class="small-9 columns">
                        <input type="tel" id="form-telephone" name="telephone" placeholder="Téléphone de la chaine"
                            <?= !empty($chaineDTO->getTelephone()) ? 'value="' . $chaineDTO->getTelephone() . '"' : '' ?> />
                    </div>
                </div>
                <div class="row">
                    <div class="small-3 columns">
                        <label for="form-fax" class="right inline">Fax</label>
                    </div>
                    <div class="small-9 columns">
                        <input type="tel" id="form-fax" name="fax" placeholder="Fax de la chaine"
                            <?= !empty($chaineDTO->getFax()) ? 'value="' . $chaineDTO->getFax() . '"' : '' ?> />
                    </div>
                </div>
                <div class="row">
                    <div class="small-3 columns">
                        <label for="form-chaineCablee" class="right inline">Chaîne câblée ?</label>
                    </div>
                    <div class="small-9 columns">
                        <input type="checkbox" id="form-chaineCablee" name="chaineCablee" value="1"
                            <?= !empty($chaineDTO->isChaineCablee()) ? 'checked' : '' ?> />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="small-12">
                <input type="submit" class="button"/>
                <a href="/" class="button secondary">Retourner à la liste</a>
            </div>
        </div>
    </form>
</div>