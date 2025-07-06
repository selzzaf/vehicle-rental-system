# 🚀 Guide de Démarrage Rapide - Sécurité

## ⚡ Actions Immédiates (5 minutes)

### 1. Vérifiez votre projet
```bash
# Exécutez le script de vérification
check-security.bat
```

### 2. Créez un fichier .env.example
```bash
# Copiez votre .env (s'il existe) en .env.example
copy .env .env.example

# Puis éditez .env.example et remplacez les valeurs sensibles :
# - DB_PASSWORD=your_password → DB_PASSWORD=example_password
# - APP_KEY=base64:... → APP_KEY=base64:YOUR_GENERATED_KEY_HERE
# - MAIL_PASSWORD=... → MAIL_PASSWORD=example_mail_password
```

### 3. Initialisez Git (si pas déjà fait)
```bash
git init
git add .
git commit -m "Initial commit: Vehicle Rental System"
```

## 🔐 Sécurité GitHub (10 minutes)

### 1. Activez la 2FA
1. Allez sur [GitHub.com](https://github.com)
2. Settings → Security → Two-factor authentication
3. Enable two-factor authentication
4. Choisissez "Authentication app" (recommandé)
5. Scannez le QR code avec Google Authenticator

### 2. Générez une clé SSH
```bash
# Windows (PowerShell)
ssh-keygen -t ed25519 -C "votre_email@example.com"

# Ajoutez la clé à l'agent SSH
ssh-add ~/.ssh/id_ed25519

# Affichez la clé publique
cat ~/.ssh/id_ed25519.pub
```

3. Ajoutez la clé dans GitHub :
   - Settings → SSH and GPG keys → New SSH key
   - Collez le contenu de la clé publique

## 📁 Création du Dépôt GitHub

### Option 1: Dépôt Privé (Recommandé pour commencer)
1. GitHub.com → New repository
2. Nom : `vehicle-rental-system`
3. **Cochez "Private"**
4. Ne cochez PAS "Add a README file"
5. Create repository

### Option 2: Dépôt Public
1. Même procédure mais **décochez "Private"**
2. Vérifiez que tous les secrets sont bien exclus

## 🔄 Première Publication

```bash
# Ajoutez le remote
git remote add origin https://github.com/votre_username/vehicle-rental-system.git

# Ou avec SSH (recommandé)
git remote add origin git@github.com:votre_username/vehicle-rental-system.git

# Push
git branch -M main
git push -u origin main
```

## ✅ Checklist Finale

- [ ] Script `check-security.bat` exécuté sans erreurs
- [ ] Fichier `.env.example` créé
- [ ] 2FA activée sur GitHub
- [ ] Clé SSH configurée
- [ ] Dépôt créé (privé ou public)
- [ ] Code poussé sur GitHub
- [ ] Aucun fichier sensible dans le dépôt

## 🚨 En Cas de Problème

### Si vous avez accidentellement commité des secrets :
```bash
# Supprimez le fichier du tracking
git rm --cached .env

# Commit la suppression
git commit -m "Remove sensitive files"

# Force push (attention!)
git push --force
```

### Si vous ne pouvez pas push :
1. Vérifiez que vous avez les bonnes permissions
2. Utilisez un token d'accès personnel si nécessaire
3. Vérifiez votre clé SSH

## 📞 Support

- **Documentation complète** : `SECURITY.md`
- **Script de vérification** : `check-security.bat`
- **GitHub Help** : [help.github.com](https://help.github.com)

---

**💡 Conseil** : Exécutez `check-security.bat` avant chaque commit important pour vous assurer que vous n'exposez pas de secrets. 