# Grille de cotation — Examen Module Candidatures

L'examen est noté sur **50 points**. La grille est organisée par **étape de développement** : pour chaque étape, les critères listent ce qui doit être effectivement présent et fonctionnel pour obtenir les points.

Chaque critère peut être attribué intégralement, partiellement, ou à zéro selon le niveau d'atteinte effectivement constaté à la lecture du code et à l'exécution de l'application.

---

## 1. Base de données et modèles — 8 pts

| Critère | Pts |
|---------|----:|
| **Migration `applications`** — table créée avec les 4 colonnes attendues (entreprise, poste, statut, date de candidature), types appropriés (string, date, enum ou string contraint), timestamps | **2** |
| **Migration `notes`** — table créée avec colonne `content` (text), clé étrangère `application_id` configurée avec **suppression en cascade**, timestamps | **2** |
| **Modèle `Application`** — `$fillable` correctement renseigné, casts pour la date si nécessaire, relation **`hasMany(Note)`** définie | **2** |
| **Modèle `Note`** — `$fillable` correctement renseigné, relation **`belongsTo(Application)`** définie | **2** |

---

## 2. Routes et navigation — 4 pts

| Critère | Pts |
|---------|----:|
| **Routes du CRUD candidatures** — 7 routes définies et **nommées** (`applications.index`, `applications.create`, `applications.store`, `applications.show`, `applications.edit`, `applications.update`, `applications.destroy`) avec les bons verbes HTTP | **2** |
| **Routes imbriquées notes** — `applications.notes.store` (POST) et `applications.notes.destroy` (DELETE), correctement préfixées par `{application}` | **1** |
| **Lien "Candidatures" dans la barre de navigation partagée** (`layouts/app.blade.php`), pointant vers la route nommée — pas d'URL en dur | **1** |

---

## 3. CRUD candidatures (logique applicative) — 10 pts

| Critère | Pts |
|---------|----:|
| **`index`** — récupère et liste toutes les candidatures depuis la base, passe les données à la vue | **2** |
| **`create`** — affiche le formulaire de création | **1** |
| **`store`** — crée l'enregistrement à partir des données du formulaire, redirige vers l'index | **1,5** |
| **`show`** — récupère la candidature et ses notes, les passe à la vue | **2** |
| **`edit`** — affiche le formulaire pré-rempli avec les valeurs actuelles | **1** |
| **`update`** — met à jour l'enregistrement, redirige vers l'index | **1,5** |
| **`destroy`** — supprime la candidature, redirige vers l'index | **1** |

---

## 4. Notes (logique applicative) — 3 pts

| Critère | Pts |
|---------|----:|
| **`store`** note — crée la note liée à la bonne candidature, redirige vers le détail | **2** |
| **`destroy`** note — supprime la note, redirige vers le détail de la candidature parente | **1** |

---

## 5. Vues Blade — 6 pts

| Critère | Pts |
|---------|----:|
| Les 4 vues (`index`, `create`, `show`, `edit`) sont créées dans `resources/views/applications/` | **1,5** |
| Toutes les vues **étendent `layouts.app`** (réutilisation du layout commun, pas de duplication du `<head>` ou du `<body>`) | **1** |
| Vue `show` intègre la **section Notes** complète : liste des notes existantes + formulaire d'ajout en bas + bouton de suppression sur chaque note | **2** |
| Affichage cohérent des données depuis la base : badges colorés selon le statut, dates formatées proprement (pas un timestamp brut), compteur de notes à jour | **1,5** |

---

## 6. Design — fidélité visuelle — 4 pts

| Critère | Pts |
|---------|----:|
| **Fidélité aux maquettes** — espacements (marges, padding, gap), typographie (tailles, graisses, hiérarchie), couleurs (textes, fonds, bordures), rayons d'arrondis ; maquette et rendu côte à côte ne révèlent pas de différence notable | **2** |
| **Badges de statut** — 4 couleurs correctes (bleu / ambre / rouge / vert), forme pastille arrondie compacte, fond pastel + texte foncé de la même teinte, visibles dans la liste ET dans le détail | **1** |
| **Cohérence avec le module Todos** — même barre de navigation, même fond de page, même langage visuel pour les cartes et les boutons | **0,5** |
| **États interactifs** — hover sur les liens et boutons, focus sur les inputs, transitions douces | **0,5** |

---

## 7. CSS — qualité du code — 4 pts

Deux approches sont autorisées : **Tailwind** (déjà en place dans le projet) ou **CSS pur** écrit à la main. Tout autre framework (Bootstrap, Bulma, etc.) est interdit. Les deux approches sont notées sur les mêmes critères, adaptés à chacune.

| Critère | Pts |
|---------|----:|
| **Approche valide** — soit Tailwind, soit CSS pur écrit à la main. Aucun autre framework CSS n'est utilisé sur la partie Candidatures | **1,5** |
| **Organisation** — si CSS pur : fichiers structurés logiquement (global ou découpé par page/composant). Si Tailwind : ordre des classes cohérent, extraction via `@apply` ou composants Blade quand un pattern se répète beaucoup | **1** |
| **Qualité du code** — sélecteurs / classes lisibles, pas de duplication excessive, factorisation raisonnable (variables CSS pour les couleurs, ou classes utilitaires bien réutilisées) | **1** |
| **Le CSS est bien chargé via Vite** ou via une autre méthode propre — pas de balises `<style>` inline dispersées dans les vues | **0,5** |

---

## 8. Persistance et expérience utilisateur — 11 pts

| Critère | Pts |
|---------|----:|
| **Persistance refresh** — les données saisies survivent à un rafraîchissement de page | **2** |
| **Persistance restart** — les données survivent à un redémarrage de l'application | **2** |
| **Suppression en cascade fonctionnelle** — supprimer une candidature supprime aussi ses notes (aucune note orpheline en base) | **2** |
| **Navigation 100% par UI** — toutes les pages du module sont atteignables via liens/boutons, aucune URL à taper à la main | **1,5** |
| **État vide géré** — si aucune candidature n'existe, un message ou une invitation à en créer une s'affiche (pas une liste vide muette) | **1,5** |
| **L'application se lance sans procédure exotique** — commandes standard, migrations exécutées sans souci, pas d'étape manuelle bricolée | **1** |
| **Parcours utilisateur fluide** — un utilisateur peut parcourir l'intégralité des fonctionnalités sans rencontrer de bug visible ni de page d'erreur brute | **1** |

---

## Récapitulatif

| Section                                    | Points |
|--------------------------------------------|-------:|
| 1. Base de données et modèles              | 8      |
| 2. Routes et navigation                    | 4      |
| 3. CRUD candidatures (logique applicative) | 10     |
| 4. Notes (logique applicative)             | 3      |
| 5. Vues Blade                              | 6      |
| 6. Design — fidélité visuelle              | 4      |
| 7. CSS — qualité du code                   | 4      |
| 8. Persistance et expérience utilisateur   | 11     |
| **Total**                                  | **50** |

**Répartition macro** :
- **Code applicatif** (sections 1 à 5) = 31 pts (62 %)
- **Design + CSS** (sections 6 et 7) = 8 pts (16 %)
- **Persistance et UX transverses** (section 8) = 11 pts (22 %)

---

## Règles d'attribution

- **Intégral** : le critère est rempli sans réserve, observable à l'écran ET dans le code.
- **Partiel** : le critère est partiellement rempli (par ex. la migration existe mais oublie le cascade, 3 statuts colorés sur 4, le `store` crée bien la candidature mais ne redirige pas) — ajuster le score proportionnellement.
- **Zéro** : le critère est absent ou non fonctionnel.

**Pénalités transverses** :

- En cas de fonctionnalité totalement manquante, les points liés à son **design** sont également perdus (on n'évalue pas le visuel d'une page qui n'existe pas).
- Utilisation d'un framework CSS **autre que Tailwind** (Bootstrap, Bulma, etc.) sur la partie Candidatures : les **4 pts** de la section 7 sont perdus, indépendamment du reste.
