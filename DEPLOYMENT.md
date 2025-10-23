# Guide de Déploiement - Portfolio Victor Amos

## 📋 Avant le déploiement

### Checklist de préparation

- [ ] Remplacer la photo de profil (voir README.md)
- [ ] Mettre à jour l'email de contact
- [ ] Mettre à jour le numéro de téléphone
- [ ] Ajouter les vrais liens sociaux (LinkedIn, GitHub, etc.)
- [ ] Remplacer `https://victoramos.dev` par votre domaine réel
- [ ] Mettre à jour les descriptions des projets
- [ ] Tester sur mobile et desktop
- [ ] Vérifier tous les liens
- [ ] Tester le formulaire de contact

## 🚀 Options de déploiement

### Option 1 : Hébergement Web Traditionnel (Recommandé)

#### Avec cPanel/Plesk

1. **Accédez à votre panneau de contrôle**
   - Connectez-vous à cPanel ou Plesk
   - Allez à "File Manager" ou "Gestionnaire de fichiers"

2. **Uploadez les fichiers**
   - Créez un dossier `portfolio` (ou utilisez `public_html`)
   - Uploadez tous les fichiers :
     - index.html
     - styles.css
     - script.js
     - robots.txt
     - sitemap.xml
     - manifest.json
     - .htaccess

3. **Configurez le domaine**
   - Pointez votre domaine vers le dossier
   - Attendez la propagation DNS (24-48h)

4. **Activez HTTPS**
   - Utilisez Let's Encrypt (gratuit)
   - Forcez HTTPS dans .htaccess

#### Avec FTP

```bash
# Utilisez un client FTP (FileZilla, WinSCP, etc.)
1. Connectez-vous avec vos identifiants FTP
2. Naviguez vers le dossier public_html
3. Uploadez tous les fichiers
4. Vérifiez les permissions (644 pour les fichiers, 755 pour les dossiers)
```

### Option 2 : GitHub Pages (Gratuit)

1. **Créez un repository**
   ```bash
   # Créez un repo nommé : username.github.io
   # Remplacez "username" par votre nom d'utilisateur GitHub
   ```

2. **Poussez vos fichiers**
   ```bash
   git init
   git add .
   git commit -m "Initial commit: Portfolio"
   git branch -M main
   git remote add origin https://github.com/username/username.github.io.git
   git push -u origin main
   ```

3. **Accédez à votre site**
   - URL : `https://username.github.io`
   - Attendez quelques minutes pour la publication

4. **Domaine personnalisé (optionnel)**
   - Allez à Settings > Pages
   - Ajoutez votre domaine personnalisé
   - Mettez à jour les DNS chez votre registraire

### Option 3 : Netlify (Recommandé pour les débutants)

1. **Connectez-vous à Netlify**
   - Allez sur https://netlify.com
   - Cliquez sur "Sign up"

2. **Déployez votre site**
   - Glissez-déposez votre dossier portfolio
   - Ou connectez votre repository GitHub

3. **Configurez votre domaine**
   - Allez à Site settings > Domain management
   - Ajoutez votre domaine personnalisé
   - Mettez à jour les DNS

4. **Activez HTTPS**
   - Netlify active HTTPS automatiquement

### Option 4 : Vercel

1. **Connectez-vous à Vercel**
   - Allez sur https://vercel.com
   - Cliquez sur "Sign up"

2. **Importez votre projet**
   - Connectez votre repository GitHub
   - Ou uploadez les fichiers

3. **Déployez**
   - Vercel déploie automatiquement
   - Vous recevez une URL temporaire

4. **Domaine personnalisé**
   - Allez à Settings > Domains
   - Ajoutez votre domaine
   - Mettez à jour les DNS

## 🔧 Configuration après déploiement

### 1. Mettre à jour les URLs

Dans `index.html`, remplacez :
```html
<!-- Avant -->
<meta property="og:url" content="https://victoramos.dev">
<link rel="canonical" href="https://victoramos.dev">

<!-- Après -->
<meta property="og:url" content="https://votre-domaine.com">
<link rel="canonical" href="https://votre-domaine.com">
```

### 2. Mettre à jour sitemap.xml

Remplacez toutes les occurrences de `https://victoramos.dev` par votre domaine.

### 3. Configurer les emails

Pour que le formulaire de contact fonctionne, vous devez :

**Option A : Utiliser un service externe**
- Formspree (https://formspree.io)
- Basin (https://usebasin.com)
- Getform (https://getform.io)

**Option B : Backend PHP**
```php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    $to = 'votre-email@example.com';
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    mail($to, $subject, $message, $headers);
    
    echo json_encode(['success' => true]);
}
?>
```

### 4. Configurer Google Search Console

1. Allez sur https://search.google.com/search-console
2. Ajoutez votre propriété
3. Vérifiez la propriété
4. Soumettez votre sitemap.xml
5. Attendez l'indexation

### 5. Configurer Google Analytics

1. Créez un compte sur https://analytics.google.com
2. Ajoutez votre propriété
3. Copiez le code de suivi
4. Ajoutez-le dans `index.html` avant `</head>` :

```html
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'GA_MEASUREMENT_ID');
</script>
```

## 📊 Vérification du déploiement

### Checklist post-déploiement

- [ ] Le site s'ouvre sans erreurs
- [ ] Le loader s'affiche correctement
- [ ] Les animations fonctionnent
- [ ] Le thème Dark/Light fonctionne
- [ ] Le changement de langue fonctionne
- [ ] Les images se chargent
- [ ] Les liens fonctionnent
- [ ] Le formulaire de contact fonctionne
- [ ] Le site est responsive
- [ ] HTTPS est activé
- [ ] Les meta tags sont corrects
- [ ] Le sitemap.xml est accessible
- [ ] Le robots.txt est accessible

### Outils de vérification

1. **Google PageSpeed Insights**
   - https://pagespeed.web.dev
   - Vérifiez les performances

2. **Google Mobile-Friendly Test**
   - https://search.google.com/test/mobile-friendly
   - Vérifiez la compatibilité mobile

3. **W3C Validator**
   - https://validator.w3.org
   - Vérifiez le HTML

4. **SEO Checker**
   - https://www.seobility.net/en/seocheck/
   - Vérifiez le SEO

## 🔐 Sécurité

### Recommandations

1. **HTTPS obligatoire**
   - Utilisez Let's Encrypt (gratuit)
   - Forcez HTTPS dans .htaccess

2. **Protégez les fichiers sensibles**
   - .htaccess bloque déjà les fichiers sensibles
   - Vérifiez les permissions

3. **Mettez à jour régulièrement**
   - Vérifiez les mises à jour des dépendances
   - Gardez votre serveur à jour

4. **Sauvegardez régulièrement**
   - Faites des sauvegardes hebdomadaires
   - Stockez-les hors site

## 📈 Optimisation continue

### Après 1 mois

- [ ] Vérifiez les analytics
- [ ] Vérifiez les erreurs dans Google Search Console
- [ ] Mettez à jour le contenu
- [ ] Ajoutez de nouveaux projets

### Après 3 mois

- [ ] Analysez le trafic
- [ ] Optimisez les pages lentes
- [ ] Mettez à jour les compétences
- [ ] Améliorez le SEO

### Après 6 mois

- [ ] Refonte du design si nécessaire
- [ ] Ajout de nouvelles sections
- [ ] Amélioration des performances
- [ ] Mise à jour complète du contenu

## 🆘 Dépannage

### Le site ne s'affiche pas

1. Vérifiez que tous les fichiers sont uploadés
2. Vérifiez les permissions (644 pour fichiers, 755 pour dossiers)
3. Vérifiez les erreurs dans la console du navigateur
4. Vérifiez les logs du serveur

### Les images ne s'affichent pas

1. Vérifiez les chemins des images
2. Vérifiez les permissions des fichiers
3. Vérifiez le format des images
4. Utilisez des URLs absolues si nécessaire

### Le formulaire ne fonctionne pas

1. Vérifiez que PHP est activé
2. Vérifiez les logs d'erreur PHP
3. Utilisez un service externe (Formspree, etc.)
4. Vérifiez les paramètres CORS

### Les performances sont lentes

1. Optimisez les images
2. Activez la compression GZIP
3. Utilisez un CDN
4. Minifiez CSS et JavaScript
5. Activez le caching du navigateur

## 📞 Support

Pour toute question :
- Consultez la documentation de votre hébergeur
- Vérifiez les logs d'erreur
- Testez dans différents navigateurs
- Utilisez les outils de développement du navigateur

---

**Bon déploiement ! 🚀**
