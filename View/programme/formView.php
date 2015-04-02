<?php
/** @var \Model\Dto\ProgrammeDTO $programmeDTO */
/** @var string $action */
/** @var \Model\Dto\TypeDiffusionDTO[] $availableTypes */
/** @var \Model\Dto\RealisateurDTO[] $availableRealisateurs */
?>

<div class="columns small-12">
    <h1><?= $action == 'post' ? 'Créer un programme' : 'Modifier le programme ' . $programmeDTO->getNomProgramme() ?></h1>

    <form method="post"
          action="<?= $action == 'post' ? '/programme/create' : '/programme/update/' . $programmeDTO->getProgrammeId() ?>">
        <div class="row">
            <div class="small-12 columns">
                <div class="row">
                    <div class="small-3 columns">
                        <label for="form-nomProgramme" class="right inline">Nom</label>
                    </div>
                    <div class="small-9 columns">
                        <input type="text" id="form-nomProgramme" name="nomProgramme" placeholder="Nom du programme"
                               required
                            <?= !empty($programmeDTO->getNomProgramme()) ? 'value="' . $programmeDTO->getNomProgramme() . '"' : '' ?> />
                    </div>
                </div>
                <div class="row">
                    <div class="small-3 columns">
                        <label for="form-duree" class="right inline">Durée</label>
                    </div>
                    <div class="small-9 columns">
                        <input type="number" id="form-duree" name="duree" placeholder="Durée du programme (en minutes)"
                            <?= !empty($programmeDTO->getDuree()) ? 'value="' . $programmeDTO->getDuree() . '"' : '' ?> />
                    </div>
                </div>
                <div class="row">
                    <div class="small-3 columns">
                        <label for="form-typeId" class="right inline">Type</label>
                    </div>
                    <div class="small-9 columns">
                        <select name="typeId" id="form-typeId">
                            <?php foreach ($availableTypes as $realisateur): ?>
                                <?php
                                $realisateurId = $realisateur->getTypeId();
                                $progRealisateurId = $programmeDTO->getTypeId();
                                $realisateurIdDTO = $programmeDTO->getTypeDiffusionDTO() != null ? $programmeDTO->getTypeDiffusionDTO()
                                                                                                                ->getTypeId() : null;
                                if ($progRealisateurId !== null && $realisateurId == $progRealisateurId ||
                                    $realisateurIdDTO !== null && $realisateurId == $realisateurIdDTO
                                ) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }
                                ?>
                                <option
                                    value="<?= $realisateurId ?>" <?= $selected ?>><?= $realisateur->getLibelle() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="small-4 columns">
                        <div class="row">
                            <div class="small-9 columns">
                                <label for="form-realisateurChoiceOld" class="right inline">Réalisateur existant</label>
                            </div>
                            <div class="small-3 columns">
                                <input type="radio" id="form-realisateurChoiceOld" name="realisateurChoice" value="old"
                                       checked/>
                            </div>
                        </div>
                    </div>
                    <div class="small-8 columns">
                        <div class="row">
                            <div class="small-3 columns">
                                <label for="form-oldRealisateur" class="right inline">Sélectionner</label>
                            </div>
                            <div class="small-9 columns">
                                <select name="oldRealisateur" id="form-oldRealisateur">
                                    <?php foreach ($availableRealisateurs as $realisateur): ?>
                                        <?php
                                        $realisateurId = $realisateur->getRealisateurId();
                                        $progRealisateurId = $programmeDTO->getRealisateurId();
                                        $realisateurIdDTO = $programmeDTO->getRealisateurDTO() != null ? $programmeDTO->getRealisateurDTO()
                                                                                                                      ->getRealisateurId() : null;
                                        if ($progRealisateurId !== null && $realisateurId == $progRealisateurId ||
                                            $realisateurIdDTO !== null && $realisateurId == $realisateurIdDTO
                                        ) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        ?>
                                        <option
                                            value="<?= $realisateurId ?>" <?= $selected ?>><?= $realisateur->getNomRealisateur() ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="small-4 columns">
                        <div class="row">
                            <div class="small-9 columns">
                                <label for="form-realisateurChoiceNew" class="right inline">Nouveau réalisateur</label>
                            </div>
                            <div class="small-3 columns">
                                <input type="radio" id="form-realisateurChoiceNew" name="realisateurChoice"
                                       value="new"/>
                            </div>
                        </div>
                    </div>
                    <div class="small-8 columns">
                        <div class="row">
                            <div class="small-3 columns">
                                <label for="form-newRealisateur" class="right inline">Nom</label>
                            </div>
                            <div class="small-9 columns">
                                <input type="text" id="form-newRealisateur" name="newRealisateur"
                                       placeholder="Nom du nouveau réalisateur"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="small-12">
                <input type="submit" class="button"/>
                <a href="/" class="button secondary">Retourner à l'accueil</a>
            </div>
        </div>
    </form>
</div>