# Archivium

Archivium è una piattaforma web per la gestione e la digitalizzazione degli archivi comunali
(pratiche edilizie, documenti amministrativi, fascicoli storici),
pensata per installazioni **dedicate per singolo Ente**.

## Modello di distribuzione

Archivium utilizza un modello **1 Comune = 1 istanza applicativa**:

- una VPS o server dedicato per ogni Comune
- un database dedicato
- un dominio dedicato (es. `comune-londa.archivium.cloud`)
- nessuna multi-tenancy applicativa

Questa scelta garantisce:
- isolamento completo dei dati (GDPR / PA-friendly)
- semplicità operativa
- facilità di backup e disaster recovery
- possibilità di installazione on-premise

---

## Requisiti

- PHP >= 8.2
- MySQL / MariaDB
- Composer
- Node.js (per build frontend, opzionale)
- Web server (Nginx o Apache)

---

## Installazione (sviluppo / produzione)

```bash
git clone https://github.com/<org>/archivium.git
cd archivium

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
