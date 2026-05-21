# Examen — Module Candidatures

## Contexte

Tu pars du projet "Mon app" qui contient déjà un module **Todos** entièrement fonctionnel : liste, création, détail, édition, suppression, ainsi qu'une fonctionnalité de commentaires sur chaque todo.

Ta mission est d'ajouter à ce projet un second module — **Candidatures** — accessible depuis la même barre de navigation et construit sur les mêmes principes. À la fin de l'examen, l'application doit proposer les deux modules côte à côte, chacun pleinement opérationnel.

---

## Objectif

Réaliser **intégralement** le module Candidatures : la base de données, le code applicatif, et les vues (HTML + CSS).

L'évaluation porte sur :
- le bon fonctionnement de toutes les actions attendues,
- la persistance des données entre les chargements de page,
- la fidélité au design fourni,
- la cohérence de l'intégration avec le reste de l'application.

---

## Données à manipuler

### Une candidature

Représente une démarche en cours pour décrocher un poste. Chaque candidature possède :

- **Entreprise** : le nom de l'entreprise visée (ex. *Acme Corp*)
- **Poste** : l'intitulé du poste (ex. *Développeur full-stack*)
- **Statut** : l'avancement de la candidature, parmi exactement ces 4 valeurs :
    - Postulée
    - Entretien
    - Refusée
    - Acceptée
- **Postulée le** : la date à laquelle la candidature a été envoyée

Tous les champs sont obligatoires.

### Une note

Permet à l'utilisateur d'ajouter du contexte, un rappel ou un suivi sur une candidature donnée. Chaque note possède :

- **Contenu** : un texte libre, potentiellement sur plusieurs lignes
- **Date de création** : renseignée automatiquement au moment de l'ajout

Une candidature peut avoir **zéro, une ou plusieurs notes**. Une note appartient toujours à **une seule** candidature — elle n'existe pas en dehors d'elle.

---

## Pages à réaliser

### 1. Liste des candidatures

C'est la page d'accueil du module, atteignable depuis le lien "Candidatures" dans la navigation.

Elle doit afficher **toutes les candidatures enregistrées**, chacune sur une ligne, avec :

- le nom de l'entreprise,
- le poste,
- le statut sous forme de **badge coloré** (cf. plus bas),
- la date à laquelle la candidature a été envoyée,
- un lien *Modifier*,
- un bouton *Supprimer*.

Un clic sur le nom de l'entreprise mène vers la page de détail de la candidature.

Un bouton **"+ Nouvelle candidature"** en haut à droite mène vers la page de création.

**Cas limite** : si aucune candidature n'existe encore, la page doit communiquer clairement cet état (zone vide avec un message ou une invitation à en créer une — pas une liste vide sans contexte).

---

### 2. Création d'une candidature

Page accessible depuis le bouton "Nouvelle candidature" de la liste.

Elle propose un formulaire avec les 4 champs : entreprise, poste, statut, date. Le statut se choisit dans une liste déroulante limitée aux 4 valeurs autorisées.

Deux actions sont possibles :
- **Enregistrer** : la candidature est créée puis l'utilisateur est redirigé vers la liste, où la nouvelle candidature apparaît.
- **Annuler** : l'utilisateur revient à la liste sans rien créer.

Une mention "← Retour à la liste" en haut de page permet aussi de revenir en arrière.

---

### 3. Détail d'une candidature

Page atteinte en cliquant sur le nom d'une entreprise depuis la liste.

Elle présente toutes les informations de la candidature (entreprise, poste, statut, date). Le statut s'affiche avec son **badge coloré**.

Deux actions sur la candidature elle-même :
- **Modifier** : mène vers la page d'édition.
- **Supprimer** : supprime la candidature et renvoie vers la liste, où elle n'apparaît plus.

Sous les informations, une **section "Notes"** affiche :

- le nombre total de notes,
- la liste des notes existantes (contenu + indication temporelle, par exemple "il y a 2 heures"),
- un bouton *Supprimer* à côté de chaque note,
- en bas, un formulaire avec un champ de texte multi-ligne et un bouton **"Publier"** pour ajouter une nouvelle note.

L'ajout d'une note la fait apparaître immédiatement dans la liste sans quitter la page de détail. La suppression d'une note la retire immédiatement de la liste.

---

### 4. Édition d'une candidature

Page atteinte via le bouton "Modifier" depuis la liste ou depuis le détail.

Le formulaire est **identique à celui de la création**, mais pré-rempli avec les valeurs actuelles de la candidature.

À la soumission, les modifications sont persistées et l'utilisateur est redirigé vers la liste.

Un bouton "Annuler" et une mention "← Retour à la liste" permettent de revenir en arrière sans modifier.

---

## Statuts et couleurs des badges

Chaque statut est représenté par un badge coloré, visible **dans la liste et dans le détail** :

| Statut    | Couleur du badge |
|-----------|------------------|
| Postulée  | Bleu             |
| Entretien | Ambre / orangé   |
| Refusée   | Rouge            |
| Acceptée  | Vert             |

Les badges utilisent un fond pastel clair et un texte plus foncé de la même teinte, sous forme de pastille arrondie compacte. Ils ne sont pas cliquables — pour changer le statut d'une candidature, il faut passer par la page d'édition.

---

## Comportements transverses attendus

### Persistance

Toutes les données saisies (candidatures, notes, modifications) doivent **survivre à un rafraîchissement de page** et à un redémarrage de l'application.

### Suppression en cascade

Quand une candidature est supprimée, **ses notes le sont aussi**. Aucune note "orpheline" ne doit subsister.

### Navigation

L'utilisateur doit pouvoir atteindre n'importe quelle page du module **uniquement via les liens et boutons de l'interface**. À aucun moment il ne doit avoir besoin de taper une URL à la main.

La barre de navigation existante doit permettre de basculer entre Todos et Candidatures sans heurts.

---

## Design

### Fidélité visuelle

Le rendu visuel des 4 pages (liste, création, détail, édition) doit reproduire **fidèlement** les maquettes fournies en annexe. Cela concerne :

- les espacements (marges, padding, distances entre les éléments),
- la typographie (tailles, graisses, hiérarchie),
- les couleurs (textes, fonds, bordures, badges),
- la forme des éléments (rayons d'arrondi des cartes, des boutons, des inputs),
- les états interactifs (hover sur les liens, focus sur les inputs, états des boutons),
- la structure des composants (carte blanche pour les sections, liste pour les énumérations, etc.).

L'utilisateur doit pouvoir poser une maquette à côté de ton rendu et **ne voir aucune différence notable**.

### Cohérence avec le module Todos

Le module Candidatures s'intègre dans une application qui contient déjà le module Todos. Ton rendu doit donc être **visuellement cohérent** avec ce qui existe déjà : même barre de navigation, même fond de page, même langage visuel pour les cartes et les boutons.

### CSS

Tu as **deux options possibles** pour styliser la partie Candidatures :

- **Tailwind** — le framework déjà en place dans le projet (utilisé par le module Todos). Tu peux le réutiliser tel quel.
- **CSS pur écrit à la main**, sans aucun framework — l'occasion de démontrer ta maîtrise des règles de mise en page et de stylisme.

**Aucun autre framework CSS n'est autorisé** (pas de Bootstrap, Bulma, Foundation, etc.). Choisis l'approche qui te met le plus en confiance — les deux sont valorisées de la même façon dans la grille de cotation.

Tu peux organiser ton CSS comme tu le souhaites (un fichier global, plusieurs fichiers par page, etc.) tant que le résultat est propre et maintenable.

---

## Livrables

À la fin de l'examen, on doit pouvoir :

1. Cloner ou récupérer ton projet et le lancer sans procédure exotique.
2. Voir la barre de navigation avec les deux modules.
3. Naviguer vers le module Candidatures et y trouver une page accueillante (même vide).
4. Créer une candidature complète et la retrouver dans la liste après refresh.
5. Cliquer sur une candidature et voir sa page de détail.
6. Ajouter plusieurs notes, les voir apparaître dans l'ordre, en supprimer une.
7. Modifier une candidature, voir le changement reflété partout (liste, détail).
8. Supprimer une candidature et constater qu'elle disparaît bien — ses notes aussi.
9. Avoir une expérience cohérente, sans bug visible et sans page d'erreur brute.

---

## Critères d'évaluation

| Critère                                    | Poids indicatif |
|--------------------------------------------|-----------------|
| Fonctionnalité CRUD candidatures           | important       |
| Fonctionnalité notes (ajout, suppression)  | important       |
| Persistance et suppression en cascade      | important       |
| Fidélité du design aux maquettes           | important       |
| CSS propre, organisé, sans framework       | important       |
| Navigation fluide et intégration           | moyen           |
| Gestion des cas d'erreur basiques          | moyen           |
| Qualité globale du rendu                   | moyen           |

---

## Hors-scope (à ne pas faire)

Pour rester dans le périmètre attendu, **tu n'as pas besoin d'implémenter** :

- filtrage, tri, recherche sur la liste,
- pagination,
- notifications visuelles (toasts, modales de confirmation),
- export, statistiques, dashboards,
- internationalisation (l'application reste en français),
- envoi d'emails ou notifications.

Si tu termines tôt et veux pousser plus loin, parles-en avant — ces points peuvent être valorisés mais ne sont pas attendus.
