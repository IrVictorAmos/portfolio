# Portfolio Personnel - Victor Amos

Un site vitrine professionnel moderne, fluide et élégant pour présenter vos compétences d'ingénieur informatique.

## 🎨 Caractéristiques

### Design & Animations
- ✅ **Loader hyper moderne** avec animations fluides et transition douce
- ✅ **Fond personnalisé animé** avec dégradés dynamiques et filigrane "VA"
- ✅ **Thème Dark/Light** avec transition fluide
- ✅ **Animations au défilement** avec GSAP et ScrollTrigger
- ✅ **Design responsive** (Mobile, Tablet, Desktop)
- ✅ **Parallax effect** sur les orbes du hero

### Sections
- 🏠 **Accueil (Hero)** - Présentation avec CTA
- 👤 **À propos** - Bio et statistiques animées
- 💼 **Compétences** - 6 catégories avec icônes
- 🚀 **Projets** - 6 projets avec cartes interactives
- 📧 **Contact** - Formulaire et informations
- 🔗 **Footer** - Navigation et liens sociaux

### SEO & AEO
- ✅ **Meta tags complets** (description, keywords, OG, Twitter)
- ✅ **JSON-LD Structured Data** pour les moteurs de recherche
- ✅ **Sitemap.xml** pour l'indexation
- ✅ **Robots.txt** pour le crawling
- ✅ **Favicon personnalisé** avec logo VA
- ✅ **Preconnect & DNS-prefetch** pour les performances

### Fonctionnalités
- 🌙 Changement de thème (Dark/Light) avec sauvegarde locale
- 🌍 Changement de langue (Français/Anglais) avec sauvegarde locale
- ⌨️ Raccourcis clavier (Alt+T pour thème, Alt+L pour langue)
- 📱 Menu hamburger responsive
- 🎯 Navigation active au défilement
- 💬 Formulaire de contact fonctionnel

## 📁 Structure des fichiers

```
portfolio/
├── index.html          # Page principale avec structure HTML
├── styles.css          # Styles CSS avec variables et animations
├── script.js           # JavaScript pour interactivité
├── robots.txt          # Configuration pour les moteurs de recherche
├── sitemap.xml         # Plan du site pour SEO
├── schema.json         # Données structurées JSON-LD
└── README.md           # Ce fichier
```

## 🖼️ Ajouter votre photo de profil

### Localisation de la photo
La photo de profil se trouve dans la **section "À propos"** (ligne ~180 du HTML) :

```html
<img src="https://via.placeholder.com/300x300?text=Victor+Amos" alt="Victor Amos" class="profile-image">
```

### Comment remplacer la photo

#### Option 1 : Utiliser une URL externe
1. Téléchargez votre photo sur un service d'hébergement d'images (Imgur, Cloudinary, etc.)
2. Remplacez l'URL dans le HTML :
```html
<img src="https://votre-url-image.com/photo.jpg" alt="Victor Amos" class="profile-image">
```

#### Option 2 : Utiliser une image locale
1. Créez un dossier `images` dans le répertoire du portfolio
2. Placez votre photo dans ce dossier (ex: `images/profile.jpg`)
3. Remplacez l'URL :
```html
<img src="images/profile.jpg" alt="Victor Amos" class="profile-image">
```

#### Option 3 : Utiliser un service en ligne
- **Gravatar** : Utilisez votre email Gravatar
- **GitHub** : Utilisez votre avatar GitHub
- **LinkedIn** : Téléchargez votre photo LinkedIn

### Recommandations pour la photo
- **Format** : JPG ou PNG
- **Dimensions** : 300x300px (carré)
- **Taille** : < 200KB pour les performances
- **Style** : Photo professionnelle, bien éclairée, fond neutre

## 🎨 Personnalisation

### Modifier les couleurs
Les couleurs sont définies dans `styles.css` aux lignes 8-30 :

**Mode Dark** :
- Fond principal : `#0D1117`
- Accent cyan : `#00B4D8`
- Accent violet : `#7B2CBF`

**Mode Light** :
- Fond principal : `#F8F9FA`
- Accent bleu : `#007BFF`
- Accent orange : `#FF8C00`

### Modifier le contenu
Tous les textes sont dans `index.html` avec des attributs `data-en` et `data-fr` pour la traduction.

### Modifier les projets
Les projets se trouvent dans la section "Projets" (ligne ~350). Dupliquez une carte et modifiez :
- Image
- Titre
- Description
- Tags technologiques

## 🚀 Déploiement

### Sur un serveur web
1. Téléchargez tous les fichiers
2. Uploadez-les sur votre serveur FTP
3. Accédez à votre domaine

### Sur GitHub Pages
1. Créez un repository `username.github.io`
2. Poussez les fichiers
3. Votre site sera accessible à `https://username.github.io`

### Sur Netlify
1. Connectez votre repository GitHub
2. Configurez le build (pas nécessaire pour ce projet)
3. Déployez automatiquement

## 📊 Performance

- ⚡ **Loader optimisé** : Disparaît après 2.5s ou à l'interaction utilisateur
- 🎯 **Lazy loading** : Images chargées à la demande
- 📦 **Minification** : CSS et JS optimisés
- 🔄 **Caching** : Utilisation du localStorage pour les préférences

## 🔍 SEO

### Optimisations incluses
- Meta tags complets
- JSON-LD structured data
- Sitemap.xml
- Robots.txt
- Favicon
- Open Graph tags
- Twitter Card tags

### À faire
1. Remplacer `https://victoramos.dev` par votre domaine réel
2. Ajouter votre vrai email et téléphone
3. Mettre à jour les liens sociaux (LinkedIn, GitHub, etc.)
4. Ajouter votre vraie photo de profil
5. Mettre à jour les descriptions des projets

## 🌐 Langues supportées

- 🇫🇷 Français (par défaut)
- 🇬🇧 Anglais

Cliquez sur le bouton "FR/EN" pour changer la langue.

## 🎯 Raccourcis clavier

- `Alt + T` : Basculer le thème (Dark/Light)
- `Alt + L` : Basculer la langue (FR/EN)

## 📱 Responsive

Le site s'adapte automatiquement à :
- 📱 Téléphones (< 480px)
- 📱 Tablettes (480px - 768px)
- 💻 Ordinateurs (> 768px)

## 🛠️ Technologies utilisées

- **HTML5** - Structure sémantique
- **CSS3** - Animations et variables
- **JavaScript ES6+** - Interactivité
- **GSAP** - Animations avancées
- **Font Awesome** - Icônes
- **Google Fonts** - Typographie

## 📝 Licence

Ce projet est libre d'utilisation. Modifiez-le selon vos besoins.

## 💡 Conseils

1. **Mettez à jour régulièrement** vos projets et compétences
2. **Testez sur mobile** avant de déployer
3. **Vérifiez les liens** (email, téléphone, réseaux sociaux)
4. **Optimisez les images** pour les performances
5. **Utilisez Google Search Console** pour le SEO

## 📞 Support

Pour toute question ou amélioration, consultez la documentation des technologies utilisées :
- [GSAP Documentation](https://greensock.com/gsap/)
- [MDN Web Docs](https://developer.mozilla.org/)
- [Schema.org](https://schema.org/)

---

**Créé avec ❤️ pour Victor Amos**
