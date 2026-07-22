# Magma WordPress plugin — Installation & configuration

- [Français](#français)
- [English](#english)

---

## Français

### Prérequis

- Un site WordPress (4.3+ recommandé, testé jusqu’à 6.6)
- Un compte [Magma](https://magma.app) avec une campagne active
- Votre **Campaign ID** (UUID de campagne), disponible dans l’admin Magma
- Au moins une intégration configurée côté Magma (widget, bannière, block, gallery, etc.)

### 1. Installer le plugin

**Option A — via ZIP**

1. Téléchargez le plugin (dossier `magma-wp-main` ou archive ZIP du dépôt).
2. Dans WordPress : **Extensions → Ajouter → Téléverser une extension**.
3. Choisissez le fichier ZIP, puis cliquez sur **Installer maintenant**.
4. Cliquez sur **Activer**.

**Option B — via FTP / SFTP**

1. Dézippez l’archive.
2. Envoyez le dossier du plugin dans `/wp-content/plugins/`.
3. Dans WordPress : **Extensions**, trouvez **Magma Ambassador**, puis **Activer**.

Après activation, un lien **Settings** apparaît sous le nom du plugin dans la liste des extensions.

### 2. Connecter votre campagne Magma

1. Allez dans **Réglages → Magma** (ou cliquez sur **Settings** depuis Extensions).
2. Collez votre **Campaign ID**.
3. Cliquez sur **Connect**.

Le plugin appelle l’API Magma et récupère les intégrations disponibles (widgets coin, bannières, block, gallery).

Si l’ID est invalide, un message d’erreur s’affiche sous le formulaire.

### 3. Choisir l’intégration site-wide (widget / bannière)

Une fois connecté, utilisez le menu **Which integration do you want?** :

| Option | Effet |
|--------|--------|
| **Do not show integration on the whole website** | Aucun widget coin ni bannière sur le site |
| **Widget - Top / Bottom Left / Right** | Bouton flottant dans le coin choisi |
| **Banner Top / Bottom** | Bannière en haut ou en bas de page |

Cliquez sur **Save**.

> Une seule intégration coin/bannière peut être active à la fois. Les embeds, profile blocks et galleries se placent à part (voir ci-dessous).

### 4. Afficher un contenu Magma sur une page

#### Shortcodes

Dans une page, un article ou un widget shortcode :

```text
[magma type="profile-block"]
[magma type="embed"]
[magma type="gallery"]
```

- **profile-block** : cartes profils ambassadeurs  
- **embed** : formulaire Magma en iframe  
- **gallery** : galerie Magma  

#### Gutenberg

1. Éditez une page avec l’éditeur de blocs.
2. Ajoutez le bloc **Magma**.
3. Dans la barre latérale, choisissez le type (Profile Block / Embed / Gallery).
4. Publiez. Le rendu Magma apparaît sur le front.

#### Elementor

1. Éditez une page avec Elementor.
2. Ajoutez l’un des widgets : **Magma Profile Block**, **Magma Embed**, **Magma Gallery**.
3. Publiez.

#### ACF (si Advanced Custom Fields est installé)

- Un champ **Magma Embed** (`magma_embed_type`) est disponible sur les articles et pages.
- Dans un template de thème :

```php
echo magma_render_integration( get_field( 'magma_embed_type' ) ?: 'profile-block' );
```

- Avec **ACF PRO**, vous pouvez aussi utiliser le bloc **Magma (ACF)** dans l’éditeur.

### 5. Vérifier que tout fonctionne

1. Ouvrez une page du site en navigation privée (front).
2. Si vous avez choisi un widget/bannière : il doit apparaître sur toutes les pages.
3. Si vous avez placé un shortcode / bloc / gallery : le contenu Magma doit s’afficher à cet endroit.
4. En cas de doute, inspectez le HTML : présence de `window.magma_app` et du script `initializer.js`.

### Dépannage rapide

| Problème | Piste |
|----------|--------|
| Rien ne s’affiche | Vérifiez que la campagne est bien **Connect**ée et que le Campaign ID est correct |
| Pas de widget coin | Vérifiez qu’une intégration widget/banner existe dans l’admin Magma, puis re-Connect |
| Widget partout alors que vous ne le voulez pas | Choisissez **Do not show integration on the whole website** puis **Save** |
| Gallery / block vide | Re-Connect pour synchroniser les UUID, puis placez le shortcode ou le bloc sur la page |

---

## English

### Prerequisites

- A WordPress site (4.3+, tested up to 6.6)
- A [Magma](https://magma.app) account with an active campaign
- Your **Campaign ID** (campaign UUID) from the Magma admin
- At least one integration set up in Magma (widget, banner, block, gallery, etc.)

### 1. Install the plugin

**Option A — ZIP upload**

1. Download the plugin (`magma-wp-main` folder or ZIP from the repository).
2. In WordPress go to **Plugins → Add New → Upload Plugin**.
3. Select the ZIP file and click **Install Now**.
4. Click **Activate**.

**Option B — FTP / SFTP**

1. Unzip the archive.
2. Upload the plugin folder to `/wp-content/plugins/`.
3. In WordPress go to **Plugins**, find **Magma Ambassador**, then **Activate**.

After activation, a **Settings** link appears under the plugin name on the Plugins screen.

### 2. Connect your Magma campaign

1. Go to **Settings → Magma** (or click **Settings** from the Plugins list).
2. Paste your **Campaign ID**.
3. Click **Connect**.

The plugin calls the Magma API and loads available integrations (corner widgets, banners, block, gallery).

If the ID is invalid, an error message appears below the form.

### 3. Choose the site-wide integration (widget / banner)

Once connected, use **Which integration do you want?** :

| Option | Effect |
|--------|--------|
| **Do not show integration on the whole website** | No corner widget or banner site-wide |
| **Widget - Top / Bottom Left / Right** | Floating button in the chosen corner |
| **Banner Top / Bottom** | Banner at the top or bottom of the page |

Click **Save**.

> Only one corner/banner integration can be active at a time. Embeds, profile blocks, and galleries are placed separately (see below).

### 4. Display Magma content on a page

#### Shortcodes

In a page, post, or shortcode widget:

```text
[magma type="profile-block"]
[magma type="embed"]
[magma type="gallery"]
```

- **profile-block** — ambassador profile cards  
- **embed** — Magma form in an iframe  
- **gallery** — Magma gallery  

#### Gutenberg

1. Edit a page in the block editor.
2. Add the **Magma** block.
3. In the sidebar, choose the type (Profile Block / Embed / Gallery).
4. Publish. Magma renders on the front end.

#### Elementor

1. Edit a page with Elementor.
2. Add one of: **Magma Profile Block**, **Magma Embed**, **Magma Gallery**.
3. Publish.

#### ACF (if Advanced Custom Fields is installed)

- A **Magma Embed** field (`magma_embed_type`) is available on posts and pages.
- In a theme template:

```php
echo magma_render_integration( get_field( 'magma_embed_type' ) ?: 'profile-block' );
```

- With **ACF PRO**, you can also use the **Magma (ACF)** block in the editor.

### 5. Verify everything works

1. Open a front-end page in a private/incognito window.
2. If you selected a widget/banner, it should appear site-wide.
3. If you placed a shortcode / block / gallery, Magma content should show in that spot.
4. If needed, inspect the HTML for `window.magma_app` and the `initializer.js` script.

### Quick troubleshooting

| Issue | What to try |
|-------|-------------|
| Nothing shows | Confirm the campaign is **Connect**ed and the Campaign ID is correct |
| No corner widget | Ensure a widget/banner exists in Magma admin, then Connect again |
| Widget everywhere but you don’t want it | Choose **Do not show integration on the whole website**, then **Save** |
| Empty gallery / block | Connect again to sync UUIDs, then place the shortcode or block on the page |
