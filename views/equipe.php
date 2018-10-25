<?php include_once 'header.phtml'; ?>
<section id="equipes" class="single-page">

    <ul class="cb-slideshow">
        <li><span></span></li>
        <li><span></span></li>
        <li><span></span></li>
        <li><span></span></li>
        <li><span></span></li>
        <li><span></span></li>
    </ul>

    <div class="shadow-overlay"></div>

    <div class="equipe">
        <?php if (isset($data['equipe'])) : ?>
            <a class="equipe-calendar" href="<?= BASE_URL ?>equipe/<?= $data['equipe']->getId() ?>/calendrier"><span class="icon-calendar"></span></a>
        <?php endif; ?>
        <?php if (isset($data['error'])) : ?>
            <h1><?= $data['error'] ?></h1>
        <?php else : ?>
            <h1><?= $data['equipe']->getNom()." - ".$data['equipe']->getNiveau()->getNom() ?></h1>
            <table>
                <tr>
                    <th class="opab">Photo</th>
                    <th>Joueur</th>
                    <th>Classement</th>
                    <th class="center">Dernier match</th>
                    <th class="center">Prochain match</th>
                </tr>
            <?php $firstLine = true; ?>
            <?php foreach ($data['equipe']->getAdherents() as $adherent) : ?>
                <tr>
                    <td width="70px" class="center">
                    <?php if (empty($adherent->getProfil())) : ?>
                        <img class="img-equipe" src="<?= IMG_PATH ?>user.jpg" alt="Author image">
                    <?php else : ?>
                        <img class="img-equipe" src="<?= IMG_PATH.$adherent->getProfil() ?>" alt="Author image">
                    <?php endif; ?>
                    </td>
                    <td width="200px">
                    <?= $adherent->getPrenom()." ".$adherent->getNom() ?>
                    </td>
                    <td width="120px">
                    <?= empty($adherent->getClassement()->getRang()) ? $adherent->getClassement()->getPoints() : "n°".$adherent->getClassement()->getRang() ?>
                    </td>
                    <?php if ($firstLine) : ?>
                        <?php if (empty($data['equipe']->getPreviousRencontre())) : ?>
                            <td class="center" rowspan="<?= count($data['equipe']->getAdherents()) ?>" valign="top">Aucune rencontre jouée</td>
                        <?php else : ?>
                            <td class="center" rowspan="<?= count($data['equipe']->getAdherents()) ?>" valign="top"><?= $data['equipe']->getPreviousRencontre()->getDate(true)."<br><br>".$data['equipe']->getPreviousRencontre()->getAdversaire() ?>
                                <br>
                                <?= $data['equipe']->getPreviousRencontre()->getLibelleDomicile() ?>
                            <?php if (!empty($data['equipe']->getPreviousRencontre()->getResultat())) : ?>
                                <br>
                                <br>
                                <?=  $data['equipe']->getPreviousRencontre()->getResultat()->getLibelleResultat()?>
                                <br>
                                <?=  $data['equipe']->getPreviousRencontre()->isDomicile() ? $data['equipe']->getPreviousRencontre()->getResultat()->getGagnes()." - ".$data['equipe']->getPreviousRencontre()->getResultat()->getPerdus() : $data['equipe']->getPreviousRencontre()->getResultat()->getPerdus()." - ".$data['equipe']->getPreviousRencontre()->getResultat()->getGagnes() ?>
                            <?php endif; ?>
                            </td>    
                        <?php endif; ?>
                        <?php if (empty($data['equipe']->getNextRencontre())) : ?>
                            <td class="center" rowspan="<?= count($data['equipe']->getAdherents()) ?>" valign="top">Aucune rencontre jouée</td>
                        <?php else : ?>
                            <td class="center" rowspan="<?= count($data['equipe']->getAdherents()) ?>" valign="top"><?= $data['equipe']->getNextRencontre()->getDate(true)."<br><br>".$data['equipe']->getNextRencontre()->getAdversaire() ?>
                                <br>
                                <?= $data['equipe']->getNextRencontre()->getLibelleDomicile() ?>
                                <br>
                                <br>
                                <?php if (!empty($data['equipe']->getNextRencontre()->getAdversaires())) : ?>
                                Equipe probable
                                <table width="320px">
                                    <?php foreach ($data['equipe']->getNextRencontre()->getAdversaires() as $adversaire) : ?>
                                    <tr>
                                        <td width="200px"><?= $adversaire->getNom() ." ". $adversaire->getPrenom() ?></td>
                                        <td width="120px"><?= $adversaire->getClassement() ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </table>
                                <?php endif; ?>
                            </td>    
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php $firstLine = false; ?>
                </tr>
            <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>

</section>
<?php include_once 'footer.phtml'; ?>



