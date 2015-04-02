<?php /** @var \Model\Dto\ProgrammeDTO $programme */ ?>
<?php /** @var \Model\Dto\ProgrammationDTO[] $programmations */ ?>

<div class="columns small-12">
    <h1><?= $programme->getNomProgramme() ?></h1>

    <?php if (!empty($_SESSION['error'])): ?>
        <p class="alert-box alert"><?= $_SESSION['error'] ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="row">
        <div class="columns small-12">
            <ul>
                <?php if ($programme->getRealisateurDTO() !== null): ?>
                    <li>Réalisateur: <?= $programme->getRealisateurDTO()->getNomRealisateur() ?></li>
                <?php endif; ?>
                <?php if ($programme->getTypeDiffusionDTO() !== null): ?>
                    <li>Type: <?= $programme->getTypeDiffusionDTO()->getLibelle() ?></li>
                <?php endif; ?>
                <li>Durée: <?= $programme->getDuree() ?> minutes</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="columns small-12">
            <h2>Programmation</h2>
            <ul>
                <?php foreach($programmations as $programmation): ?>
                    <li>
                        <?= $programmation->getDateDiffusion()->format('d/m/Y H:i') ?> :
                        <a href="/chaine/<?= $programmation->getChaineDTO()->getChaineId() ?>">
                            <?= $programmation->getChaineDTO()->getNomChaine() ?>
                        </a>
                        <?php $deleteHref = $programmation->getChaineId() . '/' . $programmation->getProgrammeId() . '/' . $programmation->getDateDiffusion()->format('Y-m-d\TH:i:s') ?>
                        <a href="/programmation/delete/<?= $deleteHref ?>/programme" class="tiny alert button">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <p>
                <a href="/programmation/create/programme/<?= $programme->getProgrammeId() ?>" class="button small">
                    Ajouter une programmation
                </a>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="small-12 columns">
            <a href="/programme/update/<?= $programme->getProgrammeId() ?>" class="button">Modifier</a>
            <a href="/programmes" class="secondary button">Retourner à la liste</a>
            <a href="/programme/delete/<?= $programme->getProgrammeId() ?>" class="button alert">Supprimer (irréversible)</a>
        </div>
    </div>
</div>