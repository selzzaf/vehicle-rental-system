# 🔒 Guide de Sécurité - Vehicle Rental System

Ce document détaille les mesures de sécurité à respecter pour protéger votre projet et vos données sensibles.

## 🚨 Vérifications Critiques Avant Publication

### 1. Fichiers Sensibles à Vérifier

**AVANT de publier sur GitHub, vérifiez que ces fichiers NE SONT PAS dans votre dépôt :**

```bash
# Vérifiez qu'aucun de ces fichiers n'est tracké par Git
git ls-files | grep -E "\.(env|key|pem|crt|sql)$"
```

**Fichiers à ABSOLUMENT exclure :**
- `.env` (configuration avec mots de passe)
- `.env.backup`
- `.env.production`
- `*.pem` (certificats privés)
- `*.key` (clés privées)
- `*.crt` (certificats)
- `*.sql` (dumps de base de données)
- `composer.lock` (peut contenir des URLs sensibles)
- `package-lock.json` (peut contenir des URLs sensibles)

### 2. Vérification du .gitignore

Votre `.gitignore` est bien configuré, mais vérifiez qu'il contient :

```gitignore
# Fichiers sensibles
.env
.env.backup
.env.production
*.pem
*.key
*.crt
*.csr
*.sql
*.sqlite

# Dépendances (optionnel mais recommandé)
/vendor/
/node_modules/
composer.lock
package-lock.json

# Logs et cache
/storage/logs/
/bootstrap/cache/
*.log
```

### 3. Nettoyage du Dépôt

Si vous avez déjà commité des fichiers sensibles :

```bash
# Supprimer un fichier du tracking Git (mais le garder localement)
git rm --cached .env
git rm --cached *.sql
git rm --cached *.pem

# Commit des changements
git commit -m "Remove sensitive files from tracking"
```

## 🔐 Configuration Sécurisée

### 1. Fichier .env.example

Créez un fichier `.env.example` avec des valeurs d'exemple :

```env
APP_NAME="Vehicle Rental System"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Générer une nouvelle clé : php artisan key:generate
APP_KEY=base64:YOUR_GENERATED_KEY_HERE

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vehicle_rental
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 2. Configuration de Production

Pour la production, utilisez des variables d'environnement sécurisées :

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Utilisez des mots de passe forts
DB_PASSWORD=StrongPassword123!@#
MAIL_PASSWORD=AnotherStrongPassword456!@#
```

## 🛡️ Bonnes Pratiques de Sécurité

### 1. Authentification GitHub

**Activez la 2FA (Authentification à 2 Facteurs) :**

1. Allez sur GitHub.com → Settings → Security
2. Cliquez sur "Enable two-factor authentication"
3. Choisissez "Authentication app" (recommandé)
4. Scannez le QR code avec Google Authenticator ou Authy
5. Entrez le code de vérification

### 2. Gestion des Dépôts

**Dépôt Public vs Privé :**

- **Public** : Code open source, visible par tous
- **Privé** : Code privé, visible uniquement par vous et vos collaborateurs

**Recommandation :** Commencez en privé pour tester, puis passez en public si vous voulez partager.

### 3. Clés SSH pour GitHub

```bash
# Générer une clé SSH
ssh-keygen -t ed25519 -C "your_email@example.com"

# Ajouter la clé à l'agent SSH
ssh-add ~/.ssh/id_ed25519

# Copier la clé publique
cat ~/.ssh/id_ed25519.pub
```

Puis ajoutez cette clé dans GitHub → Settings → SSH and GPG keys.

### 4. Tokens d'Accès Personnel

Si vous utilisez HTTPS, créez un token d'accès personnel :

1. GitHub → Settings → Developer settings → Personal access tokens
2. Generate new token (classic)
3. Sélectionnez les permissions nécessaires (repo, workflow)
4. Copiez et sauvegardez le token

## 🔍 Vérification Automatique

### Script de Vérification

Créez un script `check-security.sh` :

```bash
#!/bin/bash

echo "🔒 Vérification de sécurité du projet..."

# Vérifier les fichiers sensibles
echo "📁 Vérification des fichiers sensibles..."
if git ls-files | grep -E "\.(env|key|pem|crt|sql)$"; then
    echo "❌ ATTENTION: Fichiers sensibles détectés dans le dépôt!"
    exit 1
else
    echo "✅ Aucun fichier sensible détecté"
fi

# Vérifier le .gitignore
echo "📋 Vérification du .gitignore..."
if grep -q "\.env" .gitignore; then
    echo "✅ .env est dans .gitignore"
else
    echo "❌ .env n'est pas dans .gitignore"
fi

# Vérifier les permissions
echo "🔐 Vérification des permissions..."
if [ -f ".env" ]; then
    if [ "$(stat -c %a .env)" = "600" ]; then
        echo "✅ Permissions .env correctes (600)"
    else
        echo "⚠️  Permissions .env à vérifier"
    fi
fi

echo "✅ Vérification terminée"
```

## 🚨 En Cas de Fuite de Secrets

Si vous avez accidentellement publié des secrets :

### 1. Actions Immédiates

1. **Changez immédiatement** tous les mots de passe exposés
2. **Révoquez** tous les tokens d'accès
3. **Générez** de nouvelles clés d'application
4. **Supprimez** le commit contenant les secrets

### 2. Nettoyage de l'Historique Git

```bash
# Supprimer un fichier de l'historique Git
git filter-branch --force --index-filter \
  "git rm --cached --ignore-unmatch .env" \
  --prune-empty --tag-name-filter cat -- --all

# Force push pour nettoyer l'historique
git push origin --force --all
```

### 3. Notification

- Informez GitHub si des secrets ont été exposés
- Surveillez les logs d'accès suspects
- Changez les credentials de tous les services affectés

## 📋 Checklist de Publication

Avant de publier sur GitHub :

- [ ] Aucun fichier `.env` dans le dépôt
- [ ] Aucun certificat SSL dans le dépôt
- [ ] Aucun dump de base de données dans le dépôt
- [ ] `.env.example` créé avec des valeurs d'exemple
- [ ] 2FA activée sur GitHub
- [ ] Clés SSH configurées
- [ ] Dépôt configuré en privé (si nécessaire)
- [ ] Script de vérification exécuté
- [ ] Documentation mise à jour

## 🔗 Ressources Utiles

- [GitHub Security Best Practices](https://docs.github.com/en/github/authenticating-to-github/keeping-your-account-and-data-secure)
- [Laravel Security Documentation](https://laravel.com/docs/security)
- [OWASP Security Guidelines](https://owasp.org/www-project-top-ten/)

---

**⚠️ Rappel Important :** La sécurité est une responsabilité continue. Vérifiez régulièrement votre configuration et mettez à jour vos dépendances. 