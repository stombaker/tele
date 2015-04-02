<?php /** @var \Model\Dto\ProgrammationDTO $programmationDTO */ ?>
<?php /** @var \Model\Dto\ChaineDTO[] $availableChaines */ ?>
<?php /** @var \Model\Dto\ProgrammeDTO[] $availableProgrammes */ ?>

<div class="columns small-12">
    <h1>Ajouter une programmation</h1>

    <form method="post" action="<?= $_SERVER['PATH_INFO'] ?>">
        <div class="row">
            <div class="small-12 columns">
                <div class="row">
                    <div class="small-3 columns">
                        <label for="form-chaineId" class="right inline">Chaine</label>
                    </div>
                    <div class="small-9 columns">
                        <select name="chaineId" id="form-chaineId">
                            <?php foreach ($availableChaines as $programme): ?>
                                <?php
                                $programmeId = $programme->getChaineId();
                                $progProgrammeId = $programmationDTO->getChaineId();
                                $programmeIdDTO = $programmationDTO->getChaineDTO() != null ? $programmationDTO->getChaineDTO()->getChaineId() : null;
                                if ($progProgrammeId !== null && $programmeId == $progProgrammeId ||
                                    $programmeIdDTO !== null && $programmeId == $programmeIdDTO) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }
                                ?>
                                <option value="<?= $programmeId ?>" <?= $selected ?>><?= $programme->getNomChaine() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="small-3 columns">
                        <label for="form-programmeId" class="right inline">Programme</label>
                    </div>
                    <div class="small-9 columns">
                        <select name="programmeId" id="form-programmeId">
                            <?php foreach ($availableProgrammes as $programme): ?>
                                <?php
                                $programmeId = $programme->getProgrammeId();
                                $progProgrammeId = $programmationDTO->getProgrammeId();
                                $programmeIdDTO = $programmationDTO->getProgrammeDTO() != null ? $programmationDTO->getProgrammeDTO()->getProgrammeId() : null;
                                if ($progProgrammeId !== null && $programmeId == $progProgrammeId ||
                                    $programmeIdDTO !== null && $programmeId == $programmeIdDTO) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }
                                ?>
                                <option value="<?= $programmeId ?>" <?= $selected ?>><?= $programme->getNomProgramme() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="small-3 columns">
                        <label for="form-dateDiffusion" class="right inline">Date de diffusion</label>
                    </div>
                    <div class="small-9 columns">
                        <input type="datetime-local" id="form-dateDiffusion" name="dateDiffusion" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="small-12">
                <input type="submit" class="button"/>
                <?php if ($programmationDTO->getChaineDTO() !== null) { ?>
                    <a href="/chaine/<?= $programmationDTO->getChaineDTO()->getChaineId() ?>" class="button secondary">Retourner à la chaîne</a>
                <?php } elseif ($programmationDTO->getProgrammeDTO() !== null) { ?>
                    <a href="/programme/<?= $programmationDTO->getProgrammeDTO()->getProgrammeId() ?>" class="button secondary">Retourner au programme</a>
                <?php } else { ?>
                    <a href="/" class="button secondary">Retourner à l'accueil</a>
                <?php } ?>
            </div>
        </div>
    </form>
</div>