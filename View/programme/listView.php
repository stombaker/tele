<?php /** @var \Model\Dto\ProgrammeDTO[] $programmes */ ?>

<div class="columns small-12">
    <h1>Liste des programmes</h1>

    <p>
        <a href="/programme/create" class="button small">Créer</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Durée (minutes)</th>
                <th>Réalisateur</th>
                <th>Type de diffusion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($programmes as $programme): ?>
                <tr>
                    <td>
                        <a href="/programme/<?= $programme->getProgrammeId() ?>">
                            <?= $programme->getNomProgramme() ?>
                        </a>
                    </td>
                    <td><?= $programme->getDuree() ?></td>
                    <td><?= $programme->getRealisateurDTO()->getNomRealisateur() ?></td>
                    <td><?= $programme->getTypeDiffusionDTO() != null ? $programme->getTypeDiffusionDTO()->getLibelle() : '<em>aucun</em>' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p>
        <a href="/programme/create" class="button small">Créer</a>
    </p>
</div>