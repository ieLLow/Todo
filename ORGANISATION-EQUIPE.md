# Organisation du travail en équipe — Examen Module Candidatures

Ce document décrit la découpe recommandée pour la réalisation de l'examen lorsque celui-ci est traité collectivement, par une équipe de deux ou trois personnes. L'objectif est de permettre un travail réellement parallèle sur l'ensemble du module Candidatures, tout en limitant les conflits sur les fichiers partagés et en garantissant la cohérence du livrable final.

---

## Principes directeurs

Trois principes structurent l'ensemble de l'organisation :

1. **Un fichier sensible est édité par une seule personne à la fois.** Les fichiers partagés (routes, modèles, contrôleurs) doivent être affectés à une personne et une seule pendant la phase de développement parallèle. Toute édition simultanée d'un même fichier génère mécaniquement des conflits de fusion.

2. **Les fondations techniques précèdent le travail spécifique.** Les migrations, les modèles, les routes nommées et les squelettes des contrôleurs doivent exister avant que la production des vues ou de la logique applicative ne commence. Sans cette étape préalable, chaque membre invente des conventions incompatibles que la phase d'intégration peinera à réconcilier.

3. **Les conventions sont arrêtées explicitement avant la phase parallèle.** Noms des tables et colonnes, noms des routes, noms des classes CSS partagées : tous ces choix sont arrêtés collectivement à l'oral, en début de session, puis consignés dans le code. Aucune convention ne se devine en cours de route.

---

## Phase 1 — Fondations partagées

**Mode de travail :** ensemble, en pair- ou mob-programming, avec une seule personne au clavier.
**Durée indicative :** 20 à 30 minutes.
**Livrable :** un commit unique poussé sur la branche commune.

### Périmètre

| Livrable | Description |
|----------|-------------|
| **Migrations** | Création des tables `applications` et `notes`, avec les colonnes, les types, la clé étrangère et la suppression en cascade. |
| **Modèles Eloquent** | Création de `App\Models\Application` et `App\Models\Note`, propriétés `$fillable` renseignées et relations `hasMany` / `belongsTo` définies. |
| **Routes** | Définition complète des routes du module (CRUD candidatures et notes imbriquées), nommées, dans `routes/web.php`. |
| **Contrôleurs squelettes** | Création de `ApplicationController` et `ApplicationNoteController`, contenant toutes les méthodes attendues. À ce stade, chaque méthode est vide ou se contente de retourner la vue correspondante, sans logique métier. |
| **Lien de navigation** | Ajout du lien "Candidatures" dans `resources/views/layouts/app.blade.php`. |
| **Migrations exécutées** | Exécution réussie de `php artisan migrate`. |

### Justification

À l'issue de cette phase, chaque membre peut lancer l'application et atteindre les pages du module Candidatures, même vides. Cela constitue le socle stable sur lequel la phase suivante viendra ajouter le code propre à chaque périmètre.

À partir de ce moment, **les fichiers `routes/web.php`, les migrations et les modèles ne sont plus modifiés** par les membres de l'équipe, sauf cas exceptionnel discuté collectivement.

---

## Phase 2 — Production parallèle

**Mode de travail :** chacun sur son périmètre, sur sa propre machine.
**Durée indicative :** la majorité du temps disponible.

Deux découpes sont proposées selon la taille de l'équipe.

### Équipe de deux personnes — découpe par pages

| Membre | Périmètre fonctionnel | Fichiers principaux |
|--------|----------------------|---------------------|
| **A** | Liste et création | Méthodes `index` et `store` du contrôleur ; vues `index.blade.php` et `create.blade.php` ; gestion de l'état vide de la liste. |
| **B** | Détail, édition et notes | Méthodes `show`, `edit`, `update`, `destroy` du contrôleur des candidatures ; intégralité du `ApplicationNoteController` (`store`, `destroy`) ; vues `show.blade.php` (avec la section Notes) et `edit.blade.php`. |

Le CSS est produit conjointement, chacun ajoutant les styles requis par sa partie. Pour éviter une duplication des choix de design, l'équipe convient à l'avance des **noms et de la sémantique des classes utilitaires partagées** : cartes, boutons primaires et secondaires, badges, inputs, mise en page générale.

### Équipe de trois personnes — découpe par couche

| Membre | Périmètre | Fichiers principaux |
|--------|-----------|---------------------|
| **A** | Logique applicative (backend) | Implémentation complète des méthodes des deux contrôleurs : récupération des données, persistance, redirections. |
| **B** | Structure des vues (HTML) | Production des quatre vues Blade, affichage des données dynamiques, section Notes dans le détail, gestion de l'état vide dans la liste. La priorité est portée sur la structure HTML et le contenu ; la mise en forme visuelle reste à la charge du membre C. |
| **C** | Design et CSS | Production de l'ensemble du CSS du module : badges, cartes, formulaires, états interactifs, cohérence avec le module Todos. |

**Dépendance entre B et C** : le membre C ne peut styliser que ce qui a une structure HTML existante. Il est recommandé que le membre B livre en premier la vue `index`, afin que C puisse commencer à styliser pendant que B avance sur les autres vues. Les autres vues s'enchaînent ensuite : `create`, puis `show`, puis `edit`.

---

## Phase 3 — Intégration et validation

**Mode de travail :** ensemble.
**Durée indicative :** 20 à 30 minutes.

Cette phase a pour objectif de transformer l'agrégation des contributions individuelles en un livrable cohérent et fonctionnel.

### Checklist

| Vérification | Description |
|--------------|-------------|
| **Parcours utilisateur complet** | Exécuter de bout en bout le scénario : création d'une candidature, affichage dans la liste, accès au détail, ajout d'une note, suppression d'une note, modification de la candidature, suppression de la candidature. Aucune étape ne doit échouer. |
| **Cohérence visuelle interne** | Les quatre pages du module partagent le même langage visuel : cartes, boutons, badges, espacements, typographie. Les écarts mineurs sont corrigés. |
| **Cohérence avec le module Todos** | Le module Candidatures s'inscrit dans la continuité visuelle du module Todos existant : barre de navigation, fond de page, traitement des cartes et boutons. |
| **État vide** | Vérifier qu'une base sans aucune candidature affiche un message d'invitation et non une liste vide silencieuse. |
| **Suppression en cascade** | Créer une candidature avec plusieurs notes, supprimer la candidature, vérifier en base que les notes associées ont également été supprimées. |
| **Lancement reproductible** | Reproduire le lancement de l'application depuis une copie propre (`php artisan migrate:fresh && sail npm run dev`) et vérifier que tout fonctionne sans étape manuelle non documentée. |

---

## Coordination en cours de session

### Versionnement

L'équipe adopte un flux Git fondé sur une **branche commune intégratrice** et des **branches de fonctionnalité individuelles**, avec passage obligatoire par une *pull request* validée par un autre membre avant intégration.

**Branche commune.** Une branche dédiée à l'examen (par exemple `examen` ou `main`) constitue la référence partagée. Elle ne reçoit jamais de commits directs en phase 2 ; seules des fusions de *pull requests* l'alimentent.

**Phase 1 — fondations.** Le travail se fait en pair- ou mob-programming sur la branche commune. Le commit initial peut être poussé directement sans *pull request*, l'équipe étant intégralement présente lors de sa rédaction. À la fin de la phase, chaque membre s'assure d'être à jour (`git pull`) avant de basculer en phase 2.

**Phase 2 — branches de fonctionnalité.** Chaque membre crée sa propre branche à partir de la branche commune, nommée explicitement selon son périmètre (par exemple `feature/index-create`, `feature/show-edit-notes`, `feature/css-design`). Tous les commits relatifs à son périmètre sont effectués sur cette branche, qui est poussée régulièrement sur le dépôt distant.

**Pull request et validation croisée.** Lorsqu'un membre estime son périmètre terminé, il ouvre une *pull request* de sa branche vers la branche commune. Un autre membre de l'équipe relit le code, vérifie son bon fonctionnement, formule éventuellement des remarques, puis valide et fusionne la *pull request*. **L'auteur d'une branche ne fusionne jamais sa propre *pull request*.**

**Mise à jour des branches en cours.** Lorsque la branche commune reçoit une fusion, les membres dont le travail est encore en cours rapatrient les modifications sur leur propre branche (`git pull --rebase origin <branche-commune>` ou `git merge origin/<branche-commune>` selon la convention de l'équipe) afin de limiter l'ampleur du conflit final.

**Cadence recommandée.** Chaque membre pousse sa branche au moins toutes les 30 minutes. Les *pull requests* sont ouvertes dès qu'un sous-ensemble cohérent est terminé, sans attendre l'achèvement intégral du périmètre — cela permet à la relecture de se dérouler en parallèle plutôt qu'en bloc à la fin.

### Points de synchronisation

- **Début de phase 2** : revue rapide (deux à trois minutes) des périmètres respectifs et des conventions partagées (classes CSS, structures HTML attendues).
- **Toutes les 30 minutes environ** : point d'avancement court permettant de signaler les blocages, les modifications transverses, et l'état d'avancement de chacun.

### Membre achevant sa partie avant les autres

Trois options sont recommandées, par ordre de préférence :

1. Apporter une assistance ciblée au membre qui rencontre des difficultés (relecture de code, pair-programming).
2. Anticiper la phase 3 sur le périmètre déjà livré (tests de bout en bout, vérification de la cohérence visuelle).
3. Procéder à un travail d'amélioration sur sa propre contribution (organisation du CSS, refactorisation mineure, finition d'éléments d'interface).

---

## Pièges à éviter

- **Démarrer la phase 2 sans avoir achevé la phase 1.** Les conventions de routes, de noms de colonnes et de méthodes seront inventées en parallèle et incompatibles, ce qui rendra l'intégration finale particulièrement coûteuse.
- **Édition concurrente du même fichier de contrôleur.** Même si les méthodes diffèrent, deux personnes éditant `ApplicationController.php` simultanément génèrent des conflits à chaque opération de fusion. Pour une équipe de trois, la responsabilité des contrôleurs est attribuée à un seul membre.
- **Modification de `routes/web.php` après la phase 1.** Les autres membres ont déjà branché leur code sur les noms de routes définis. Toute modification ultérieure non communiquée casse leur travail.
- **Absence de pousser sa branche pendant plusieurs heures.** Sur un projet court à plusieurs intervenants, la synchronisation Git doit être au minimum toutes les trente minutes.
- **Fusion par l'auteur de sa propre *pull request*.** La validation croisée est une garantie de qualité ; elle ne peut être contournée par l'auteur lui-même.
- **Commit direct sur la branche commune en phase 2.** Une fois la phase 1 close, la branche commune n'est plus alimentée que par des fusions de *pull requests*. Tout commit direct met en péril la traçabilité et la cohérence des contributions.
- **Réécriture du code d'un autre membre sans concertation.** La phase d'intégration est l'occasion de discuter et d'harmoniser les choix, non de réécrire unilatéralement les contributions des autres. Toute remarque substantielle passe par la *pull request*.

---

## Résumé

```
PHASE 1 — Fondations (ensemble, 20-30 min)
   Migrations · Modèles · Routes · Squelettes contrôleurs · Nav
   → commit initial poussé sur la branche commune

PHASE 2 — Production (en parallèle, le reste du temps)
   À deux : A = index + create     | B = show + edit + notes
   À trois : A = backend           | B = vues HTML        | C = design / CSS

PHASE 3 — Intégration (ensemble, 20-30 min)
   Parcours bout en bout · Cohérence visuelle · État vide · Cascade · Lancement
```
