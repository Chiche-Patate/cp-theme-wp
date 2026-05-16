# CP Theme — Template WordPress by Chiche Patate !
> Modifier le screenshot quand logo reçu par Laura

Base de thème WordPress développée et maintenue par [Chiche Patate !](https://chichepatate.be).  
Construite avec **Vite**, **SCSS** et une architecture atomique maison.

## Stack

- WordPress 6.0+
- PHP 8.2+
- Vite 7+
- SCSS (Dart Sass)
- Yarn 4 (PnP)
- GSAP + Splide (disponibles, à importer selon projet)

## Installation
```bash
yarn install
```

## Développement
```bash
yarn start   # watch + build
yarn dev     # serveur Vite
yarn build   # build production
```

## Structure
```
  /src
    /scripts
      main.js               # Point d'entrée JS
    /functions              # Fonctions utilitaires
    /style
      /00_mixins            # Breakpoints, mixins
      /00_variables         # Tokens, fonctions, couleurs, typo
      /01_atoms             # Reset, base, layout, texte
      /utilities            # Classes utilitaires (spacing, gap, grid, typo)
      main.scss             # Point d'entrée SCSS
  /templates                # Template parts WordPress
  /dist                     # Build (généré, ne pas committer)
```

## Démarrer un nouveau projet

1. Cloner le template
2. Renommer le thème dans `style.css`
3. Mettre à jour `package.json` (name)
4. Créer `src/style/00_variables/_config.scss` (voir section Configuration)
5. `yarn install && yarn build`

## Configuration

> Copier `_config.example.scss` en `_config.scss` et remplir les valeurs obligatoires.

Le fichier `_config.scss` **ne doit pas être versionné dans le repo du boilerplate** — il est propre à chaque projet et doit être créé manuellement.  
Il doit être importé **avant** `_tokens.scss` dans ton point d'entrée SCSS.

Créer `src/style/00_variables/_config.scss` :

> Les polices Google Fonts ou custom doivent être importées séparément dans `main.scss` ou via `<link>` dans le `<head>`.

## Conventions

- Classes utilitaires à la Tailwind : `.flex`, `.grid-cols-3`, `.px-24`, `.fs-xl`
- Breakpoints mobile-first via le mixin `breakpoint()`
- Toute valeur de spacing ou font-size passe par `fluid()` / `fs()` / `spacing()`

## Auteur

**Chiche Patate !** — [chichepatate.be](https://chichepatate.be)