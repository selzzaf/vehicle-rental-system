@echo off
echo 🔒 Vérification de sécurité du projet Vehicle Rental System
echo ========================================================
echo.

REM Vérifier si Git est initialisé
if not exist ".git" (
    echo ❌ Git n'est pas initialisé dans ce projet
    echo    Exécutez: git init
    pause
    exit /b 1
)

echo ✅ Git est initialisé

REM Vérifier les fichiers sensibles
echo.
echo 📁 Vérification des fichiers sensibles...
if exist ".env" (
    echo ❌ ATTENTION: Fichier .env détecté!
    echo    Ce fichier contient des informations sensibles
    echo    Assurez-vous qu'il est dans .gitignore
) else (
    echo ✅ Aucun fichier .env détecté
)

if exist "*.pem" (
    echo ❌ ATTENTION: Fichiers .pem détectés!
    echo    Ces fichiers contiennent des certificats privés
) else (
    echo ✅ Aucun fichier .pem détecté
)

if exist "*.key" (
    echo ❌ ATTENTION: Fichiers .key détectés!
    echo    Ces fichiers contiennent des clés privées
) else (
    echo ✅ Aucun fichier .key détecté
)

if exist "*.sql" (
    echo ❌ ATTENTION: Fichiers .sql détectés!
    echo    Ces fichiers peuvent contenir des données sensibles
) else (
    echo ✅ Aucun fichier .sql détecté
)

REM Vérifier le .gitignore
echo.
echo 📋 Vérification du .gitignore...
findstr /C:".env" .gitignore >nul
if %errorlevel% equ 0 (
    echo ✅ .env est dans .gitignore
) else (
    echo ❌ .env n'est PAS dans .gitignore
)

findstr /C:"*.pem" .gitignore >nul
if %errorlevel% equ 0 (
    echo ✅ *.pem est dans .gitignore
) else (
    echo ❌ *.pem n'est PAS dans .gitignore
)

findstr /C:"*.key" .gitignore >nul
if %errorlevel% equ 0 (
    echo ✅ *.key est dans .gitignore
) else (
    echo ❌ *.key n'est PAS dans .gitignore
)

findstr /C:"*.sql" .gitignore >nul
if %errorlevel% equ 0 (
    echo ✅ *.sql est dans .gitignore
) else (
    echo ❌ *.sql n'est PAS dans .gitignore
)

REM Vérifier les fichiers trackés par Git
echo.
echo 🔍 Vérification des fichiers trackés par Git...
git ls-files | findstr /I "\.env" >nul
if %errorlevel% equ 0 (
    echo ❌ ATTENTION: Fichiers .env sont trackés par Git!
    echo    Exécutez: git rm --cached .env
) else (
    echo ✅ Aucun fichier .env tracké par Git
)

git ls-files | findstr /I "\.pem" >nul
if %errorlevel% equ 0 (
    echo ❌ ATTENTION: Fichiers .pem sont trackés par Git!
) else (
    echo ✅ Aucun fichier .pem tracké par Git
)

git ls-files | findstr /I "\.key" >nul
if %errorlevel% equ 0 (
    echo ❌ ATTENTION: Fichiers .key sont trackés par Git!
) else (
    echo ✅ Aucun fichier .key tracké par Git
)

git ls-files | findstr /I "\.sql" >nul
if %errorlevel% equ 0 (
    echo ❌ ATTENTION: Fichiers .sql sont trackés par Git!
) else (
    echo ✅ Aucun fichier .sql tracké par Git
)

REM Vérifier les dépendances
echo.
echo 📦 Vérification des dépendances...
if exist "vendor\" (
    echo ⚠️  Dossier vendor/ détecté
    echo    Considérez l'ajouter à .gitignore
) else (
    echo ✅ Dossier vendor/ non présent
)

if exist "node_modules\" (
    echo ⚠️  Dossier node_modules/ détecté
    echo    Considérez l'ajouter à .gitignore
) else (
    echo ✅ Dossier node_modules/ non présent
)

REM Recommandations
echo.
echo 📋 Recommandations de sécurité:
echo.
echo 1. 🔐 Activez la 2FA sur GitHub:
echo    - Allez sur GitHub.com → Settings → Security
echo    - Cliquez sur "Enable two-factor authentication"
echo.
echo 2. 🔑 Configurez les clés SSH:
echo    - Générez une clé SSH: ssh-keygen -t ed25519
echo    - Ajoutez-la dans GitHub → Settings → SSH keys
echo.
echo 3. 🏷️  Choisissez le type de dépôt:
echo    - Privé: Pour le développement personnel
echo    - Public: Pour partager votre code
echo.
echo 4. 📝 Créez un fichier .env.example:
echo    - Copiez .env en .env.example
echo    - Remplacez les valeurs sensibles par des exemples
echo.
echo 5. 🔍 Vérifiez régulièrement:
echo    - Exécutez ce script avant chaque commit
echo    - Surveillez les logs d'accès GitHub
echo.

echo ✅ Vérification terminée
echo.
echo 💡 Prochaines étapes:
echo    1. Créez un fichier .env.example
echo    2. Activez la 2FA sur GitHub
echo    3. Configurez les clés SSH
echo    4. Choisissez le type de dépôt (public/privé)
echo    5. Initialisez Git et faites votre premier commit
echo.

pause 