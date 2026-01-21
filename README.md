# Archivium

Archivium è una piattaforma cloud per la gestione di archivi documentali e fascicoli digitali,
pensata per enti pubblici e grandi archivi strutturati.

Stack principale:
- Laravel
- Filament (admin panel)
- MySQL
- Queue database-based
- Multi-tenancy DB-per-tenant (stancl/tenancy)

---

## Requisiti

- PHP >= 8.2
- Composer
- MySQL / MariaDB
- Node.js (per asset, se necessario)
- Ambiente *nix o Docker consigliato

---

## Installazione

### 1. Clona il repository
```bash
git clone <repo-url> archivium
cd archivium
