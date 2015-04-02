<?php /** @var \Model\Dto\ChaineDTO $chaine */ ?>
<?php /** @var \Model\Dto\ProgrammationDTO[] $programmations */ ?>

<div class="columns small-12">
    <h1><?= $chaine->getNomChaine() ?></h1>

    <?php if (!empty($_SESSION['error'])): ?>
        <p class="alert-box alert"><?= $_SESSION['error'] ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="row">
        <div class="columns small-6">
            <p>
                <?= $chaine->getAdresse() ?>
                <br/>
                <?= $chaine->getCodePostal() ?>
                <?= $chaine->getVille() ?>
            </p>
        </div>
        <div class="columns small-6">
            <ul>
                <?php if ($chaine->getTelephone() != null): ?>
                    <li>Téléphone: <?= $chaine->getTelephone() ?></li>
                <?php endif; ?>
                <?php if ($chaine->getFax() != null): ?>
                    <li>Fax: <?= $chaine->getFax() ?></li>
                <?php endif; ?>
                <li><?= $chaine->isChaineCablee() ? 'Chaine câblée' : 'Chaine non câblée' ?></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="columns small-12">
            <h2>Programmation</h2>
            <ul>
                <?php foreach ($programmations as $programmation): ?>
                    <li>
                        <?= $programmation->getDateDiffusion()->format('d/m/Y H:i') ?> :
                        <a href="/programme/<?= $programmation->getProgrammeDTO()->getProgrammeId() ?>">
                            <?= $programmation->getProgrammeDTO()->getNomProgramme() ?>
                        </a>
                        <?php $deleteHref = $programmation->getChaineId() . '/' . $programmation->getProgrammeId() . '/' . $programmation->getDateDiffusion()
                                                                                                                                         ->format('Y-m-d\TH:i:s') ?>
                        <a href="/programmation/delete/<?= $deleteHref ?>/chaine"
                           class="tiny alert button">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <p>
                <a href="/programmation/create/chaine/<?= $chaine->getChaineId() ?>" class="button small">
                    Ajouter une programmation
                </a>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="small-12 columns">
            <a href="/chaine/update/<?= $chaine->getChaineId() ?>" class="button">Modifier</a>
            <a href="/" class="button secondary">Retourner à l'accueil</a>
            <a href="/chaine/delete/<?= $chaine->getChaineId() ?>" class="button alert">Supprimer (irréversible)</a>
        </div>
    </div>
</div>