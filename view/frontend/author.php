<?php
/**
 * Created by PhpStorm.
 * User: Liliaze
 * Date: 06/11/2018
 * Time: 21:01
 */
ob_start();
?>
    <div id="authorDiv">
        <h1>JEAN FORTEROCHE</h1>
        <h2>Romancier</h2>
        <figure>
            <img id="authorImg" src="public/image/Jean_Rochefort.jpg" alt="Jean Forteroche portrait" />
            <figcaption>Portait de Jean Forteroche ayant de forte ressemblance avec Jean Rochefort</figcaption>
        </figure>

        <h3>Un enfant de la campagne</h3>
        <p>
            "Jean Forteroche est né en 1968, dans le canton verdoyant des Grisons en Suisse, où fût tourner les épisodes de Heïdi 'la petite fille de nos montagnes'.
            Pour autant éloigné du tumulte littéraire qui secoue la capitale parisienne à cette époque, Jean en découvre les oeuvres alors qu'il se réfugie
            dans la grange de son grand-père pour échapper au travail des champs et lire les romans que sa tante Hilda lui envois régulièrement.
        </p>
        <h3>Premiers écrits théâtrales</h3>
        <p>
            "Alors que Jean n'a que 16ans et l'âge de reprendre la ferme familiale, il émet le souhait de poursuivre des études littéraires, ses parents encore jeunes et vigoureux acceptent à contre-coeur. Ainsi, après 3 essaie raté, Jean intègre  l'école des lettres suisses où il intégrera la compagnie théâtrale des élèves de l'école des lettres. C'est dans ce groupe qu'il rédigera ses premiers écrits, des ébauches de scènes de théâtre humoristiques comme le célèbre 'vient-en montagne' repris par l'émission les 'mini-keums'."
        </p>
        <h3>"Alors que le vent tourne" (2012)</h3>
        <p>
            "En 2010, ses parents meurent subitement lors de la tempête du siècle dernier. Jean se voit contraint de reprendre le flambeau familial pour subvenir aux besoins de ses 3 jeunes frères et soeurs. Les nuits dans la montagne sont longues, petit à petit une idée née en lui et paraîtra en 2012 dans son premier roman 'quand le vent tourne' où il raconte les pérégrinations d'un fermier en montagne."
        </p>
        <h3>"Un jour sans nom" (2016)</h3>
        <p>
            "Fort de son précédent succès ayant conquis le coeur de nos jeunes fermiers, Jean laisse alors la ferme familiale et poursuit sur sa lancée et s'adresse cette fois-ci aux jeunes cadres dynamiques en leur proposant une évasion au coeur de ses chères montagnes, ainsi sort en 2016 son roman fantatisque : 'Un jour  sans nom' vendu à 3.5 millions d'exemplaire."
        </p>
        <h3>De "l'ambivalence" à "Billet simple pour l'Alaska" (novembre 2018)</h3>
        <p>
            "Face à l'ambivalence qu'à suscité auprès des jeunes cadres parisiens son roman fantastique, Jean Forteroche vous propose une toute nouvelle expérience publié épisode par épisode à travers son roman 'Billet simple pour l'Alaska', où un jeune cadre quitte tout pour se retrouver seul et survivre au milieu des étendues neigeuses de l'Alaska."
            "Nous tenons à préciser que ce livre s'inspire du roman 'un hiver à Majorque' de George Sand et porte sa date dans une lettre dédicacé à son ami François Rollinat, et sa raison d'être dans les réflexions qui ouvrent le chapitre IV"
            </p>
        <h3>Citation de George Sand :</h3>
        <p>
            «Pourquoi voyager quand on n'y est pas forcé?» Aujourd'hui, revenant des mêmes latitudes traversées sur un autre point de l'Europe méridionale, je m'adresse la même réponse qu'autrefois à mon retour de Majorque: «C'est qu'il ne s'agit pas tant de voyager que de partir: quel est celui de nous qui n'a pas quelque douleur à distraire ou quelque joug à secouer?».</p>
        </p>
    </div>
<?php
$content = ob_get_clean();
require('template.php'); ?>