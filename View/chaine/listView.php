<?php /** @var \Model\Dto\ChaineDTO[] $chaines */ ?>

<div class="columns small-12">
    <h1>Liste des chaines</h1>

    <p>
        <a href="/chaine/create" class="button small">
            Créer
        </a>
    </p>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Code postal</th>
                <th>Ville</th>
                <th>Téléphone</th>
                <th>Est Câblée</th>
                <th>Fax</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($chaines as $chaine): /** @var \Model\Dto\ChaineDTO $chaine */ ?>
                <tr>
                    <td>
                        <a href="/chaine/<?= $chaine->getChaineId() ?>">
                            <?= $chaine->getNomChaine() ?>
                        </a>
                    </td>
                    <td><?= $chaine->getAdresse() ?></td>
                    <td><?= $chaine->getCodePostal() ?></td>
                    <td><?= $chaine->getVille() ?></td>
                    <td><?= $chaine->getTelephone() ?></td>
                    <td><?= $chaine->isChaineCablee() ? 'oui' : 'non' ?></td>
                    <td><?= $chaine->getFax() ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p>
        <a href="/chaine/create" class="button small">
            Créer
        </a>
    </p>
</div>