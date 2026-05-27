# មេរៀនប្រើប្រាស់ប្រព័ន្ធ — kuongkea (ឡៅ ពួយឃាង ០៥)
# Training Manual — Money-Exchange ERP

> **ជំពូកទី ១ — ទិដ្ឋភាពទូទៅ (Overview)**

---

## ១.១ អ្វីជា Project នេះ?

**kuongkea** (ឡៅ ពួយឃាង ០៥) គឺជា Web Application សម្រាប់ដំណើរការអាជីវកម្មប្តូរប្រាក់ (money-changer)
ដែលគ្រប់គ្រងជាមួយ Laravel។ ប្រព័ន្ធនេះរួមបញ្ចូលមុខងារសំខាន់ៗដូចជា:

- **ប្តូររូបិយប័ណ្ណ (Currency Exchange)** — ទិញ-លក់រូបិយប័ណ្ណ ច្រើនប្រភេទ និងរក្សាស្តុក
- **ផ្ទេរប្រាក់ (Money Transfer)** — ផ្ទេរប្រាក់ដៃគូ ផ្ទេរតាមធនាគារ ផ្ទេរតាមវីង បើកវេរក្នុងស្រុក និងវេរលុយថៃ
- **ដើមទុនបុគ្គលិក (User Capital)** — តាមដានដើមទុនរបស់បុគ្គលិកម្នាក់ៗ និងប្រាក់ចំណេញ
- **បញ្ជីដៃគូ (Partner Ledger)** — សៀវភៅបញ្ជីដៃគូ និង"កាត់កង" (netting)
- **អចលនទ្រព្យ (Real Estate)** — ចុះឈ្មោះ-លក់-បង់រំលស់ដី និងផ្ទះ
- **ការទទួលស្គាល់មុខ (Face Recognition)** — រកអតិថិជនចាស់ដោយស្វ័យប្រវត្តិ
- **Telegram & Facebook Messenger** — ផ្ញើសារកិច្ចការ និង webhook
- **Multi-Company (រហូតដល់ ១០ ក្រុមហ៊ុន)** — អ្នកប្រើប្រាស់ម្នាក់អាចចូលប្រើបានច្រើនក្រុមហ៊ុន

## ១.២ បច្ចេកវិទ្យាដែលប្រើ (Tech Stack)

| ផ្នែក | បច្ចេកវិទ្យា |
|---|---|
| Backend Framework | **Laravel 13** (PHP **8.3**) |
| Authentication | Laravel UI (`laravel/ui`) + `CustomAuth\LoginController` |
| Realtime | **Laravel Reverb** + `laravel-echo` + `pusher-js` |
| API token | **Laravel Sanctum** |
| PDF / Print | **Spatie Browsershot** (Puppeteer headless Chrome) |
| Frontend CSS | **Bootstrap 5.2** + Sass |
| Frontend JS | jQuery, Axios, plain JS (with `face-api.js` models) |
| Build Tool | **Vite 5** + `laravel-vite-plugin` |
| Database | **MySQL** (default) — SQLite ដំណើរការបាន |
| HTTP client | **Guzzle 7.8** |
| Notifications | Telegram Bot API (3 bots) + Facebook Messenger webhook |
| CI | GitHub Actions (PHP syntax, view/route/config cache, Unit tests) |

> **ចំណាំ**: Project នេះ **មិន**ប្រើ TailwindCSS, Alpine.js, Vue, ឬ Inertia.js — UI សុទ្ធតែ Bootstrap + Blade។

## ១.៣ រចនាសម្ព័ន្ធ Project (Folder Structure)

```
kuongkea/
├── app/
│   ├── Http/
│   │   ├── Controllers/              # 28 controllers (ខាងក្រោម)
│   │   │   ├── CustomAuth/LoginController.php       # ការ Login / Permission
│   │   │   ├── Auth/                                  # Laravel UI scaffolding (មិនសូវប្រើ)
│   │   │   ├── ExchangeController.php         (~2.5k LOC)  ប្តូរប្រាក់
│   │   │   ├── MoneyTransferController.php    (~4.3k LOC)  ផ្ទេរប្រាក់
│   │   │   ├── UserCapitalController.php      (~8.6k LOC)  ដើមទុនបុគ្គលិក
│   │   │   ├── RealEstateController.php       (~3.8k LOC)  អចលនទ្រព្យ
│   │   │   ├── ThaiController.php             (~3.4k LOC)  លុយថៃ
│   │   │   ├── PartnerListController.php      (~2.1k LOC)  បញ្ជីដៃគូ
│   │   │   ├── CurrencyController.php         (~1.2k LOC)  រូបិយប័ណ្ណ និងតម្លៃ
│   │   │   ├── StockController.php            (~1.4k LOC)  ស្តុក
│   │   │   ├── CloseListController.php        (~1.4k LOC)  បិទបញ្ជី
│   │   │   ├── InvoiceController.php          (~0.6k LOC)  វិក្កយបត្រ
│   │   │   ├── CustomerController.php, ChildController.php, EmployeeController.php
│   │   │   ├── CompanyController.php, LandController.php, ExpanseController.php
│   │   │   ├── CaptureController.php          ការទទួលស្គាល់មុខ (face-api.js)
│   │   │   ├── FacebookWebhookController.php  Messenger webhook
│   │   │   ├── SMSController.php              Telegram outbound
│   │   │   ├── PaymentController.php, ReportController.php, BankTransferController.php
│   │   │   ├── ChatController.php, HomeController.php, TrackController.php
│   │   ├── Middleware/
│   │   │   ├── TrackOnlineUsers.php           # ដាក់ user-online ឲ្យ TrackController
│   │   │   ├── RedirectIfAuthenticated.php
│   │   │   └── disableBackBtn.php             # prevent-back-history
│   ├── Services/
│   │   └── TelegramService.php                # 3 bot/chat pairs ដែលដំណើរការ
│   ├── Models/                                # Eloquent models ថ្មី (28 models)
│   ├── User.php, Role.php, Permission.php,    # Models ចាស់ (legacy app/*.php)
│   ├── Company.php, Customer.php, …           # មាន ~54 models នៅទីនេះ
│   └── Mail/, Events/, Providers/
├── bootstrap/
│   └── app.php                                # Laravel 11+ slim bootstrap
├── config/
│   ├── helper.php                             # ការកំណត់អាជីវកម្ម (system_title, multi_bussiness, …)
│   ├── services.php                           # Telegram/Facebook tokens
│   └── database.php, app.php, …
├── database/
│   └── migrations/                            # 6 migration files (បច្ចុប្បន្ន)
├── resources/
│   └── views/                                 # 122+ Blade templates ចែកជា 19 folders
│       ├── master.blade.php, mainfunction.blade.php   # Layout + dashboard
│       ├── includes/                          # head, sidebar, facerecognit, …
│       ├── exchanges/, moneytransfers/, usercapitals/, partnerlists/
│       ├── realestates/, thaicashdraws/, stocks/, customers/, …
├── routes/
│   └── web.php                                # ~836 lines, 584 named routes
├── public/
│   ├── models/                                # face-api.js model weights
│   ├── logo/, qrcode/, myimages/
│   └── assets/, css/, js/
└── .env.example
```

## ១.៤ ការផ្លាស់ប្តូរសុវត្ថិភាពថ្មីៗ (Security baseline, post-PR #7)

| ត្រូវការស្គាល់ | ស្ថានភាព |
|---|---|
| Hard-coded master passwords | **លុបចេញហើយ** (PR #7) — តែ `Hash::check()` ប៉ុណ្ណោះ |
| Destructive `Route::get` (ឧ. `/customer/delete`) | **បាន convert ទៅ `Route::post`** (49 routes) — CSRF ការពារ |
| Login throttle | **`throttle:10,1`** (10 attempts / 1 minute) លើ `POST /login` |
| Trusted proxies | **`env('TRUSTED_PROXIES')`** — default ទទេ (មិន trust ឲ្យ X-Forwarded-* ទេ) |
| CSRF on AJAX | `$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': … } })` ក្នុង `master.blade.php` |

---

> **ជំពូកទី ២ — ការដំឡើង (Installation & Setup)**

---

## ២.១ តម្រូវការប្រព័ន្ធ (System Requirements)

- **PHP**: `^8.3` (CI សាកល្បងជាមួយ 8.3)
- **PHP extensions**: `mbstring`, `pdo_mysql`, `bcmath`, `gd`, `intl`, `zip`, `curl`, `xml`, `fileinfo`, `openssl`
- **Composer**: ជំនាន់ចុងក្រោយ
- **Node.js & NPM**: សម្រាប់ compile frontend assets (Vite 5)
- **Database**: MySQL 8.0+ (default), ឬ SQLite
- **Chromium / Chrome**: តម្រូវដោយ Spatie Browsershot សម្រាប់ PDF / print
- **Puppeteer**: ត្រូវការនៅពេល `npm install`

## ២.២ ជំហានដំឡើង (Step-by-Step)

### ជំហាន ១ — Clone និង Install Dependencies

```bash
# 1. Clone project
git clone https://github.com/samnangitsr/kuongkea.git
cd kuongkea

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies (រួមមាន puppeteer)
npm install
```

### ជំហាន ២ — កំណត់ Environment

```bash
# Copy file .env.example ទៅ .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

បើក `.env` ហើយកែតម្រូវជារបៀបនេះ:

```env
APP_NAME=kuongkea
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost

# Reverse-proxy IP allowlist (សុវត្ថិភាព):
# - leave EMPTY នៅពេលអ្នកដាក់ direct-internet (default secure)
# - '*' តែនៅពេលនៅខាងក្រោយ trusted reverse proxy
TRUSTED_PROXIES=

# MySQL (default)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kuongkea
DB_USERNAME=root
DB_PASSWORD=

# Telegram (សម្រាប់ Notification — 3 bots/chats):
TELEGRAM_BOT_TOKEN=
TELEGRAM_CHAT_ID=
TELEGRAM_BOT_TOKEN1=
TELEGRAM_CHAT_ID1=
TELEGRAM_BOT_TOKEN2=
TELEGRAM_CHAT_ID2=

# Kuongkea-specific bot
KUONGKEA_BOT_TOKEN=
KUONGKEA_CHAT_ID=

# Facebook Messenger webhook
FB_VERIFY_TOKEN=
FB_PAGE_ID=

# Reverb (realtime - សម្រាប់ user-online tracking)
BROADCAST_DRIVER=reverb
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=127.0.0.1
PUSHER_PORT=8080
PUSHER_SCHEME=http
PUSHER_APP_CLUSTER=mt1
```

### ជំហាន ៣ — បង្កើត Database

```bash
# MySQL: បង្កើត database ឲ្យបានមុនអ្វីៗទាំងអស់
mysql -u root -p -e "CREATE DATABASE kuongkea CHARACTER SET utf8mb4;"

# Run migrations (បច្ចុប្បន្ន migrations មាន 6 file — schema ភាគច្រើន
# ត្រូវ import ពី SQL dump ដែលផ្តល់ដោយ vendor ឬ live database)
php artisan migrate

# ប្រសិនបើអ្នកមាន .sql dump:
mysql -u root -p kuongkea < dump.sql
```

> **ការព្រមាន**: Repo នេះ **មិនមាន**ប្រវត្តិ migrations ពេញលេញទេ (តែ 6 ឯកសារ migration ប៉ុណ្ណោះ)។
> ដើម្បីដំណើរការទាំងស្រុង អ្នកត្រូវការ:
> - រត់ `php artisan migrate` លើ database ដែលមាន schema រួចជាស្រេច, **ឬ**
> - Import SQL dump ពី production / staging មុនពេលដំណើរការ។

### ជំហាន ៤ — Compile Frontend Assets

```bash
# Development (auto-reload)
npm run dev

# OR Production build
npm run build
```

### ជំហាន ៥ — Storage Link និង Permissions

```bash
# សម្រាប់ user photos, logos, captures
php artisan storage:link

# Permissions ដែលត្រូវ writable
chmod -R 775 storage bootstrap/cache
```

### ជំហាន ៦ — ចាប់ផ្តើម Server

```bash
# Web server
php artisan serve

# Reverb (សម្រាប់ user-online tracking)
php artisan reverb:start
```

បើក browser ទៅ `http://localhost:8000`។

### ជំហាន ៧ — សាកល្បង Telegram & Facebook (បើបាន config)

```bash
# Webhook URL ដែលត្រូវ register លើ Facebook Developer:
# https://YOUR_DOMAIN/facebook/webhook
# (verify token = FB_VERIFY_TOKEN ក្នុង .env)

# Telegram បាន​ test ដោយ POST ទៅ:
# /send-sms (route name សម្ងាត់ — សម្រាប់ trusted scripts ប៉ុណ្ណោះ)
```

## ២.៣ គណនី Default (Login Credentials)

ប្រព័ន្ធនេះ **គ្មាន**ការ seed default admin ទេ។ អ្នកត្រូវ:

1. Import SQL dump ដែលមាន user record រួចហើយ, **ឬ**
2. បើក DB tool (TablePlus, phpMyAdmin) ហើយ insert user តាមដៃ ដោយ:
   ```sql
   INSERT INTO users (username, password, name, role_id, active, is_activated, company_id, no)
   VALUES ('admin',
           '$2y$10$...',                      -- bcrypt('your-strong-password')
           'Administrator',
           1,                                   -- role_id សម្រាប់ Admin
           1, 1, 1, 1);
   ```
3. បន្ទាប់មក Login ដោយ select **Company** → **Username** → **Password** នៅទំព័រ `/login`។

> **ការព្រមាន (post-PR #7)**: គ្មាន master password ទៀតទេ។ User ត្រូវមាន `remote_password`
> (bcrypt) ត្រឹមត្រូវដើម្បីចូល។

---

> **ជំពូកទី ៣ — រចនាសម្ព័ន្ធទិន្នន័យ (Database Architecture)**

---

## ៣.១ Domain Models សំខាន់ៗ

Models ត្រូវបានបែងចែកក្នុង **២ កន្លែង**:

| ទីតាំង | សម័យ | ឧទាហរណ៍ |
|---|---|---|
| `app/*.php` (root) | Legacy | `User`, `Company`, `Customer`, `Currency`, `Exchange`, `Invoice`, `Payment`, `PartnerAccount`, `PartnerTransfer`, … |
| `app/Models/*.php` | ថ្មី | `CustomerExchange`, `CustomerExchangeCapture`, `UserOnline`, `Property`, `PropertyGroup`, `Contract`, `Expanse`, `AgentType`, … |

> **TODO** (សម្គាល់សម្រាប់អ្នកអភិវឌ្ឍ): legacy models ស្ទើរទាំងអស់ **គ្មាន `$fillable`/`$guarded`**, ដែលធ្វើឲ្យ mass-assignment ងាយរងគ្រោះ — សូមមើល Code Review document សម្រាប់រាយលំអិត។

## ៣.២ តារាងសំខាន់ៗ (Key Tables)

| ផ្នែក | តារាង | ការប្រើប្រាស់ |
|---|---|---|
| **Authentication / RBAC** | `users`, `roles`, `permissions`, `permission_users` | Login និងសិទ្ធិ |
| **Multi-company** | `companies` | Branch / company switch by session |
| **Customers** | `customers`, `customer_children`, `customer_lists`, `customer_temp_lists` | អតិថិជន (រួមកូនសាខា) |
| **Addresses** | `addresses` (provinces, districts, communes, villages embedded) | ភូមិសាស្ត្រ |
| **Currency / Exchange** | `currencies`, `exchanges`, `exchange_multi`, `exchange_rates`, `exchange_rate_products`, `product_rates`, `currency_buttons` | តម្លៃ និងការប្តូរ |
| **Stock** | `stocks`, `stock_reports`, `stock_prints` | ស្តុករូបិយប័ណ្ណ |
| **Invoice / Payment** | `invoices`, `invoice_details`, `invoice_payments`, `payments`, `payment_details`, `items`, `temp_invoices` | វិក្កយបត្រ |
| **Partner** | `partner_accounts`, `all_partner_lists`, `partner_total_lists`, `partner_transfers`, `partner_transfer_lists`, `partner_exchange_lists`, `partner_close_lists`, `partner_cashdraw_temps` | សៀវភៅបញ្ជីដៃគូ |
| **Money Transfer** | `bank_transactions`, `money_print_slips`, `money_transfer_updates`, `cashdraws`, `cashdraw_selects`, `cashdraw_images`, `daily_close_lists` | ផ្ទេរប្រាក់ |
| **Thai Cash-draw** | `thai_accounts`, `thai_customers`, `thai_close_lists`, `sms`, `sms_names`, `sms_processes`, `sms_refreshes`, `wing_code_infos`, `wing_transaction_names` | លុយថៃ |
| **Real Estate** | `properties`, `property_groups`, `contracts`, `sale_details`, `new_pay_romlos`, `pay_commissions`, `agent_types`, `agent_rate_sets` | អចលនទ្រព្យ |
| **User Capital** | `user_capital_*`, `close_lists`, `close_list_details` | ដើមទុនបុគ្គលិក |
| **Expense / Income** | `expanses`, `expanse_types` | ចំណូល-ចំណាយ |
| **Face Recognition** | `customer_exchanges`, `customer_exchange_captures` | រូបភាព + 128-float face embedding |
| **Online presence** | `user_onlines`, `page_times` | តាមដាន user (Reverb) |
| **Misc** | `permissions` codes, `set_over_days` | Audit / day-lock |

## ៣.៣ Relationship Highlights

```
Company (1) ─┬─ Users (N)            (company_id, role_id)
             ├─ Customers (N)
             ├─ Currencies (N)
             ├─ Exchanges (N)
             ├─ Invoices (N)
             ├─ PartnerAccounts (N)
             ├─ Properties (N)
             └─ ThaiAccounts (N)

User (1) ────┬─ Role (1)              (role_id → roles.id)
             ├─ Permissions (N)       (permission_users.pcdt = រាប់/លំនាំ)
             └─ Capital records (N)

Customer (1) ─ Children (N), Captures (N), Invoices (N), …

Exchange (1) ─ ExchangeRate(s), Stock movement(s)

Partner Transfer (1) ─ TransferLists (N), PrintSlip (1), CashDraw (N)

Real-Estate Property (1) ─ Contract (1) ─ Payments (N) ─ Commissions (N)
```

---

> **ជំពូកទី ៤ — ម៉ូឌុល និងមុខងារទាំងអស់**

---

## ៤.១ Login & Dashboard

| URL | Method | Route name | ការប្រើប្រាស់ |
|---|---|---|---|
| `/` | GET | (closure) | Landing — redirect ទៅ `/login` |
| `/login` | GET | `showlogin` | Form login (Company → User → Password) |
| `/login` | **POST** | `checklogin` | ដំណើរការ login (មាន `throttle:10,1`) |
| `/dashboard` | GET | `dashboard` | Main function board (4–8 cards) |
| `/logout` | POST | `logout` | ចេញចាក |
| `/home` | GET | `home` | (legacy — Laravel default) |
| `/login/getuserbycompany` | GET | `login.getuserbycompany` | ផ្ទុក user list នៅពេលអ្នកប្រើ select company |
| `/register` | GET | `userregister` | Form ចុះឈ្មោះ user (admin-driven) |
| `/storeuser` | POST | `storeuser` | រក្សា user ថ្មី |

**Note**: `showdashboard()` ត្រឡប់ `mainfunction.blade.php` សម្រាប់ Admin
ហើយ `master.blade.php` សម្រាប់ user ផ្សេងៗ។

## ៤.២ ដើមទុនបុគ្គលិក (User Capital) — `UserCapitalController`

Card ដំបូងនៅ Dashboard។ ប្រើដោយម្ចាស់ហាង/ម៉ាណេជ័រ ដើម្បីតាមដានដើមទុនរបស់បុគ្គលិកនិមួយៗ។

| Menu (ខ្មែរ) | URL | Route name |
|---|---|---|
| ដើមទុនបុគ្គលិក | `/usercapital` | `usercapital.index` |
| បិទបញ្ជីបុគ្គលិក | `/usercapital/closelist` | `usercapital.closelist` |
| ប្រតិបត្តិការណ៏បុគ្គលិក | `/usercapital/usertransactionreport` | `usercapital.usertransactionreport` |
| របាយការណ៏បុគ្គលិក | `/usercapital/userstatementreport` | `usercapital.userstatementreport` |
| បុគ្គលិកស្នើរប្រាក់ | `/usercapital/moneyoffer` | `usercapital.moneyoffer` |
| ប្រាក់ចំណេញ | `/usercapital/userprofit` | `usercapital.userprofit` |
| ចំណូលចំណាយ | `/expanseincome` | `expanseincome.index` |

ឧទាហរណ៍ workflow:

```
ដើមទុនបុគ្គលិក → ជ្រើសបុគ្គលិក → ឃើញ master + transaction list
                              ├─ កែ (usercapital.edit / .updateusercapital)
                              ├─ បន្ត (usercapital.capitalcontinue)
                              ├─ បិទបញ្ជី (usercapital.closelist / .store_endbalance_all)
                              └─ មើលលំអិត (.seedetail / .seedetail1by1)
```

## ៤.៣ ប្តូរប្រាក់ (Currency Exchange) — `ExchangeController`, `CurrencyController`

Card ទីពីរនៅ Dashboard។ ស្នូលនៃប្រព័ន្ធ។

| Menu | URL | Route name |
|---|---|---|
| ប្តូរប្រាក់ | `/exchange` | `exchange.index` |
| របាយការណ៏ប្តូរប្រាក់ | `/exchangelists` | `exchangelists` |
| កំណត់អត្រាប្តូរប្រាក់ថ្មី | `/currency/exchangeratenew` | `currency.exchangeratenew` |
| កំណត់រូបិយប័ណ្ណ | `/currency` | `currency.index` |
| កំណត់អត្រាផ្ទេរប្រាក់ | `/moneytransfer/settransferrate` | `moneytransfer.settransferrate` |

### Workflow ប្តូរប្រាក់ដោយដៃ (manual exchange)

```
ប្តូរប្រាក់ → ជ្រើស customer (ឬចុចមុខអតិថិជនពី face capture)
           → ជ្រើស currency ដែលផ្តល់ + currency ដែលទទួល
           → វាយចំនួន (auto convert តាមអត្រា)
           → "រក្សាប្រតិបត្តិការ" → Stock update + Profit calc + Partner-list update
```

### Face Recognition mode (បើ `config('helper.exchange_auto_capture') == 1`)

- ទំព័រ `/facerecognit` បើកដោយស្វ័យប្រវត្តិក្នុង tab ថ្មីពេលអ្នកចូល `/exchange`
- ប្រើ **face-api.js** (model weights នៅ `public/models/`)
- រូបភាព + 128-float embedding ត្រូវ POST ទៅ `/capture` (`customer.capture`)
- បើ distance ≤ **0.55** (Euclidean) → match អតិថិជនចាស់; បើមិន match → create new `CustomerExchange`
- រូបភាពរក្សាក្នុង `storage/app/public/customers/`

### TV / Sidebar Rate Display (សម្រាប់ display screen ខាងមុខហាង)

| URL | Route name | គោលដៅ |
|---|---|---|
| `/tv` | `currency.ratedisplaytv` | TV-style rate board (auto-refresh) |
| `/allrate` | `currency.ratedisplay` | រាប់រូបិយប័ណ្ណទាំងអស់ |
| `/ratedisplayforcustomer` | `currency.ratedisplayforcustomer` | សម្រាប់ផ្ញើ link អតិថិជន |
| `/ratedisplayrightsidebar` | `currency.ratedisplayrightsidebar` | sidebar embed |
| `/refreshdisplayrate*` | `currency.refreshdisplayrate(*)` | AJAX poll for rate updates |
| `/ratedisplay/sendtosocialmedia` | `ratedisplay_sendtosocial` | រក្សា snapshot ហើយផ្ញើទៅ Telegram/Messenger |

## ៤.៤ ផ្ទេរប្រាក់ (Money Transfer) — `MoneyTransferController`

Card ទីបីនៅ Dashboard។ Controller ធំជាងគេ (~4.3k LOC, 60+ routes)។

| Menu | URL | Route name |
|---|---|---|
| ផ្ទេរប្រាក់ដៃគូ | `/moneytransfer/formtransfer` | `moneytransfer.formtransfer` |
| ផ្ទេរតាមធនាគារ | `/moneytransfer/banktransfer` | `moneytransfer.banktransfer` |
| ផ្ទេរតាមវីង | `/moneytransfer/wingtransfer` | `moneytransfer.wingtransfer` |
| អតិថិជនដាក់ដក | `/moneytransfer/customertransfer` | `moneytransfer.customertransfer` |
| ដាក់ដករហ័ស | `/moneytransfer/quicktransfer` | `moneytransfer.quicktransfer` |
| បើកវេរក្នុងស្រុក | `/moneytransfer/cashdraw` | `moneytransfer.cashdraw` |

### Workflow ផ្ទេរប្រាក់ដៃគូ

```
ផ្ទេរប្រាក់ → ផ្ទេរប្រាក់ដៃគូ
           → ជ្រើស Partner (ដៃគូ) + Currency
           → វាយ amount + tel/customer
           → Save to temp list (moneytransfer.savetotemplist)
           → "បញ្ជូន" → moneytransfer.store
              ├─ បង្កើត partner_transfer + transfer_list rows
              ├─ Update partner_account balance
              ├─ បោះពុម្ព slip (moneytransfer.print)
              └─ ផ្ញើ Telegram notification (TelegramService)
```

### បើកវេរក្នុងស្រុក (Local Cash-Draw)

```
បើកវេរក្នុងស្រុក → វាយលេខទូរសព្ទ ឬ amount
                  → moneytransfer.searchcashdraw (រកការផ្ទេរដែលអ្នកនៅរង់ចាំ)
                  → ជ្រើស → moneytransfer.savecashdraw
                  → Bond លុយក្នុងស្តុក → mark cashdraw=true
```

### Sub-features ខ្លះៗ (ច្រើនជាង 60 routes)

- `moneytransfer.delete` / `moneytransfer.update` — កែ / លុបប្រតិបត្តិការ
- `moneytransfer.update_delete_report` — អ៊ូឌីត update/delete history
- `moneytransfer.sendpartnerslip` — ផ្ញើ slip TO Telegram
- `moneytransfer.settransferrate` — កំណត់ការគិតថ្លៃផ្ទេរ
- `moneytransfer.getwingrate` / `.gettranname` — Wing-specific lookups
- `moneytransfer.transactiontransfertothai` — bridge ទៅ Thai module

## ៤.៥ បញ្ជីដៃគូ (Partner Ledger) — `PartnerListController`

Card ទីបួននៅ Dashboard។ ប្រើសម្រាប់ track ត្រូវការ-ត្រូវឲ្យ (receivable/payable) ជាមួយដៃគូជំនួញ។

| Menu | URL | Route name |
|---|---|---|
| សៀវភៅបញ្ជីថ្មី | `/partnerlist/indexnew` (target=_blank) | `partnerlist.indexnew` |
| សៀវភៅបញ្ជីចាស់ | `/partnerlist` | `partnerlist.index` |
| បញ្ជីដៃគូទាំងអស់ | `/partnerlist/alllist` | `partnerlist.alllist` |
| កាត់កងបញ្ជីដៃគូ | `/partnerlist/exchangelist/0` | `partnerlist.exchangelist` |
| លុបកាត់កង | `/exchangelist/delkatkong` | `exchangelist.delkatkong` |
| របាយការណ៏កាត់កង | `/partnerlist/exchangelistreport/0` | `partnerlist.exchangelistreport` |

**"កាត់កង" (netting) workflow**:

```
បញ្ជីដៃគូ → ជ្រើស 2 partners ដែលមាន reciprocal balance
         → exchange amount at custom rate
         → Save (partnerlist.saveexchangelistleft) → both balances ល្បាន
         → វាមកត្រឹមត្រូវ (offsetting entries)
```

## ៤.៦ លុយថៃ (Thai Money / Cross-border) — `ThaiController`

Card ទីប្រាំ (~3.4k LOC, 80+ routes)។ សម្រាប់ផ្ទេរប្រាក់ទៅ-មកប្រទេសថៃ ដោយប្រើ SMS parsing។

| Menu | URL | Route name |
|---|---|---|
| សារថៃ | `/thaicashdraw/thaisms` | `thaicashdraw.thaisms` |
| បើកវេរលុយថៃ | `/thaicashdraw/cashdraw` | `thaicashdraw.cashdraw` |
| ទំនាក់ទំនងអតិថិជន | `/thaicashdraw/cashdraw1` | `thaicashdraw.cashdraw1` |
| របាយការណ៏បើកវេរថៃ | `/thaicashdraw/cashdrawreport` | `thaicashdraw.cashdrawreport` |
| របាយការណ៏ស្តុកថៃ | `/thaicashdraw/notyetcashdrawreport` | `thaicashdraw.notyetcashdrawreport` |
| ចុះលេខបញ្ជី | `/thaicashdraw/accountregister` | `thaicashdraw.accountregister` |
| បិទបញ្ជីលុយថៃ | `/thaicashdraw/closelist` | `thaicashdraw.closelist` |

### Workflow សារថៃ → បើកវេរ

```
1. SMS ពីធនាគារថៃចូលប្រព័ន្ធ (parse → sms table → sms_processes)
2. បុគ្គលិកមើលនៅ "សារថៃ" (thaicashdraw.thaisms)
   → ចុចលើ SMS → match ទៅ Thai customer (thaicustomer.read)
   → "បើកវេរលុយថៃ" (thaicashdraw.cashdraw1 / .cashdraw2)
3. បន្ទាប់ពី match: គិតប្រាក់ដែលត្រូវឲ្យអតិថិជន → savecashdraw → តម្រូវ Stock thai-money
```

ក្នុង `config/helper.php`:
- `thai_bangkut_usd=1` ប្តូរ format ការបង្ហាញ Bangkut
- `khmer_bangkut_usd=0` បិទវានៅ Khmer side

## ៤.៧ អចលនទ្រព្យ (Real Estate) — `RealEstateController`, `LandController`

Card ទីប្រាំមួយ (~3.8k LOC, 60+ routes)។ បើ `config('helper.realestate') == 1` (បច្ចុប្បន្នបើក)។

| Menu | URL | Route name |
|---|---|---|
| លក់អចលនទ្រព្យ | `/realestate` | `realestate.index` |
| តារាងលក់ | `/realestate/soldpropertylist` | `realestate.soldpropertylist` |
| តារាងឈ្មោះបង់រំលស់ | `/realestate/customerromloslist` | `realestate.customerromloslist` |
| ចុះឈ្មោះអចលនទ្រព្យ | `/land` | `land.index` |
| ធ្វើកុងត្រាលក់ | `/realestate/docontract` | `realestate.docontract` |

### Sub-workflows

```
ចុះឈ្មោះ → វាយព៌តមានដី/ផ្ទះ (Property + PropertyGroup) → ដាក់ photo
ធ្វើកុងត្រា → ជ្រើស property + customer → savedeposit + savedocontract
បង់រំលស់   → realestate.payment → savenewpayromlos (តាមកាលវិភាគ)
Commission → addcommission → updatecommissionlink → savedepositcommission
```

## ៤.៨ ការចុះឈ្មោះ (Registration) — `CustomerController`, etc.

Card ទីប្រាំពីរ។

| Menu | URL | Route name |
|---|---|---|
| ចុះឈ្មោះអតិថិជន | `/customer` | `customer.index` |
| ចុះឈ្មោះកូនសាខា | `/child` | `child.index` |
| ចុះឈ្មោះខេត្តក្រុង | `/address` | `address.index` |
| ចុះឈ្មោះអ្នកប្រើប្រាស់ | `/register` | `userregister` |
| ចុះឈ្មោះក្រុមហ៊ុន | `/company/register` | `company.register` |

### Sub-routes

- `customer.store`, `customer.print`, `customer.deleteaccount`, `customer.savepartneraccount`
- `customer.checkcloselist`, `customer.savecloselist`
- `address.saveprovince`, `address.savedistrict`, `address.savecommune`, `address.savevillage`
- `child.store`, `child.search`
- `company.store`, `company.update`, `company.destroy`

## ៤.៩ របាយការណ៏ (Reports) — `ReportController`, `CloseListController`, `StockController`

Card ទីប្រាំបី។

| Menu | URL | Route name |
|---|---|---|
| បញ្ជីលុយកាក់ | `/closelist` | `closelist.index` |
| របាយការណ៏បិទបញ្ជី | `/closelist/report` | `closelist.report` |
| របាយការណ៏សង្ខេប | `/closelist/summaryreport` | `closelist.summaryreport` |
| ប្រាក់ចំណេញផ្ទេរប្រាក់ | `/report/transferprofit` | `report.transferprofit` |
| របាយការណ៏ស្តុក | `/stock/report` | `stock.report` |
| របាយការណ៏ទិញលក់ | `/stock/reportbuysale` | `stock.reportbuysale` |
| ព៌តមានស្តុក | `/stock` | `stock.index` |

Export ភាគច្រើនបោះពុម្ពតាម browser (HTML print page)។ PDF ខ្លះៗប្រើ Spatie Browsershot (headless Chrome)។

## ៤.១០ មុខងារផ្សេងៗ (Auxiliary)

| មុខងារ | Controller | សម្គាល់ |
|---|---|---|
| Face capture | `CaptureController` | face-api.js, 128-float embedding, Match threshold 0.55 |
| Telegram outbound | `SMSController` → `TelegramService` | 3 bots (main + 2 secondary) |
| Facebook webhook | `FacebookWebhookController` | `/facebook/webhook` GET (verify) + POST (events) |
| Online tracking | `TrackController` + `TrackOnlineUsers` middleware | `user_onlines`, `page_times` |
| Chat (legacy) | `ChatController` | `/chatpage` (sandbox) |
| Email verification | `LoginController::verifyEmailFirst`, `sendEmailDone` | សម្រាប់ flow ចុះឈ្មោះ |

---

> **ជំពូកទី ៥ — ការប្រើប្រាស់ប្រចាំថ្ងៃ (Daily Workflow)**

---

## ៥.១ ចាប់ផ្តើមថ្ងៃ

```
1. បើក browser → http://YOUR_DOMAIN/login
2. ជ្រើស Company (បើមានច្រើន)
3. ជ្រើស Username + វាយ Password → Sign in
4. ច្រកចូល Dashboard → ឃើញ 8 card សំខាន់ៗ
```

## ៥.២ ប្តូរប្រាក់អតិថិជន (Walk-in Exchange)

```
[បើក auto-capture]              [បើគ្មាន auto-capture]
Camera capture face →            ប្តូរប្រាក់ → ជ្រើស customer
matchCustomer found →            → វាយ amount source + target currency
ប្តូរប្រាក់ + customer auto-fill   → Save exchange
                                  └─ Stock deduct + profit calc + slip print
```

## ៥.៣ ផ្ទេរប្រាក់ជូនដៃគូ

```
ផ្ទេរប្រាក់ → ផ្ទេរប្រាក់ដៃគូ
           → ជ្រើស partner (ឧ. ហាងផ្ទេរនៅខេត្ត) + currency
           → វាយ tel + amount
           → "បន្ថែម" → temp list
           → "បញ្ជូន" → POST /moneytransfer/store
              ├─ បង្កើត partner_transfer record
              ├─ Update partner balance
              ├─ បោះពុម្ព slip (browser print modal)
              └─ Telegram notification
```

## ៥.៤ បើកវេរ (Cash-Draw) ស្រុក/ថៃ

```
ស្រុក:  បើកវេរក្នុងស្រុក → search by tel/amount → ជ្រើស transaction → save
ថៃ:    សារថៃ → ចុច SMS → ជ្រើស customer → "បើកវេរ" → save
```

## ៥.៥ បិទបញ្ជីចុងថ្ងៃ (End-of-Day Close)

```
1. បិទបញ្ជីបុគ្គលិក (usercapital.closelist) ─ ប្រមូលប្រតិបត្តិការបុគ្គលិកនិមួយៗ
2. បិទបញ្ជីដៃគូ                              ─ partnerlist.storecloselist
3. បិទបញ្ជីលុយថៃ                              ─ thaicashdraw.closelist
4. បញ្ជីលុយកាក់ (closelist.index)             ─ កត់ត្រា cash count + difference
5. របាយការណ៏សង្ខេប (closelist.summaryreport)  ─ បោះពុម្ព / ផ្ញើ Telegram
```

---

> **ជំពូកទី ៦ — ការគ្រប់គ្រងប្រព័ន្ធ (System Administration)**

---

## ៦.១ User & Permission Management

ប្រព័ន្ធសិទ្ធិមាន **៣ កម្រិត**:

1. **Role** (`roles` table): `Admin`, `User` (រួចមាន role ផ្សេងៗដែលអ្នកបង្កើតតាមតម្រូវការ)
   - `config('helper.user_type')` បង្ហាញ `['admin', 'user']`
2. **Permission** (`permissions` table): កូដ permission ដូចជា `exchange.delete`, `usercapital.update`, etc.
   - Method: `User::checkpermission($uid, $code)` — return `1` បើមាន, `0` បើគ្មាន
   - Day-lock: `User::maxdateopenmoney($uid, $code, $date)` — ប្រើ `pcdt` ជាចំនួនថ្ងៃ
3. **Pivot data** (`permission_users.pcdt`): ប្រើ store custom value (ឧ. ចំនួនថ្ងៃ user អាច "back-date" record)

### បន្ថែម user ថ្មី

```
ការចុះឈ្មោះ → ចុះឈ្មោះអ្នកប្រើប្រាស់ (/register, name='userregister')
             → វាយ name, username, password, role, company
             → POST /storeuser
```

### Apply permission to user

```
/applyright (name='applyright') → ជ្រើស user + permissions → POST /saveapplyright
ឬ
/getuserright (name='getuser_right') → JSON list
POST /saveuserpermission, /updateuserpermission, /deleteuserpermission
```

## ៦.២ Multi-Company / Branch Switching

`config('helper.multi_bussiness') = 10` (max companies)។ ការ switch:

```
Login → ជ្រើស Company → session('log_into_company_id') ត្រូវ set
Sidebar logo + brand name ​updates ដោយផ្អែកលើ session នេះ
Sidebar / Reports / Lists ត្រងតាម company_id ដោយ scope
```

## ៦.៣ ការកំណត់សាខា / Brand

```
ការចុះឈ្មោះ → ចុះឈ្មោះក្រុមហ៊ុន (/company/register)
            → name, name1, subname, subtext
            → logo (upload to public/logo/), logobg, fontsize, textcolor
            → public_ip (CIDR list — ប្រើដោយ `LoginController::showlogin`)
            → tel, email, website, address
```

`public_ip` allowlist: បើ client IP ត្រូវនឹង regex `like %{ip}%`, login page បង្ហាញ user filtered តាម company អត្ថ​​​នោះ (ផ្តោតលើ usability ប៉ុណ្ណោះ — មិនមែនការគ្រប់គ្រងសុវត្ថិភាពទេ)។

## ៦.៤ Currency / Rate Setup

```
កំណត់រូបិយប័ណ្ណ (/currency)
  ├─ បន្ថែម currency (Code, name, exchange rate buy/sell)
  ├─ កំណត់ display order
  └─ កំណត់ "currency buttons" (សម្រាប់ quick-pick នៅ exchange page)

កំណត់អត្រាប្តូរប្រាក់ថ្មី (/currency/exchangeratenew)
  └─ Bulk-set buy/sell rate សម្រាប់ currencies ជាច្រើនក្នុងពេលតែមួយ
```

## ៦.៥ Telegram & Facebook Setup

| Service | `.env` keys | Notes |
|---|---|---|
| Telegram primary | `TELEGRAM_BOT_TOKEN`, `TELEGRAM_CHAT_ID` | Main notification bot |
| Telegram bot #2 | `TELEGRAM_BOT_TOKEN1`, `TELEGRAM_CHAT_ID1` | (ផ្ញើទៅ chat ផ្សេង) |
| Telegram bot #3 | `TELEGRAM_BOT_TOKEN2`, `TELEGRAM_CHAT_ID2` | (ផ្ញើទៅ chat ផ្សេង) |
| Kuongkea bot | `KUONGKEA_BOT_TOKEN`, `KUONGKEA_CHAT_ID` | សម្រាប់ owner only |
| Facebook | `FB_VERIFY_TOKEN`, `FB_PAGE_ID` | Webhook នៅ `/facebook/webhook` |

> **ចំណាំសុវត្ថិភាព**: `TelegramService::sendMessage()` ប្រើ `Http::withOptions(['verify' => false])` — disable SSL verification។ ត្រូវកែជា `true` លើ production ឲ្យមាន CA bundle ត្រឹមត្រូវ។

## ៦.៦ Feature Flags ក្នុង `config/helper.php`

| Key | Default | គោលដៅ |
|---|---|---|
| `system_title` | "ឡៅ ពួយឃាង ០៥" | Brand title ដែលបង្ហាញនៅ login + sidebar |
| `system_subtitle` | "ប្តូរប្រាក់" | Subtitle |
| `realestate` | 1 | បើ/បិទ module អចលនទ្រព្យ |
| `transfer_option` | "kuongkea" | Branding នៃ transfer slip |
| `show_user_capital_master` | 1 | បង្ហាញ master capital នៅ index |
| `col_vnd` | 0 | column VND (Vietnamese dong) លើ rate display |
| `autocontinueusercash` | 1 | auto carry-over capital ទៅថ្ងៃបន្ទាប់ |
| `thai_bangkut_usd` | 1 | Bangkut format ផ្នែកថៃ ជា USD |
| `khmer_bangkut_usd` | 0 | Bangkut format ផ្នែកខ្មែរ ជា USD |
| `auto_closelist_rate` | 0 | auto-pull rate នៅពេលបិទបញ្ជី |
| `multi_bussiness` | 10 | maximum companies |
| `exchange_auto_capture` | 0 | បើ=1, exchange page បើក face-recognit popup |
| `set_rate_pandp_mode` | "1" | 0=default, 1=reverse |
| `haveexchangegold` | "1" | បើក/បិទ Gold exchange feature |
| `isphnompenhrate` | "0" | សម្គាល់សាខាភ្នំពេញ (សម្រាប់ rate behavior) |

---

> **ជំពូកទី ៧ — ការថែទាំ និងការដោះស្រាយបញ្ហា (Maintenance)**

---

## ៧.១ Command សំខាន់ៗ (Artisan)

```bash
# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Optimize (production)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Database
php artisan migrate                   # រត់ migrations ដែលនៅសល់
php artisan migrate:status            # ពិនិត្យ migrations
mysql -u root -p kuongkea < dump.sql  # Restore schema/data

# Storage
php artisan storage:link              # សម្រាប់ photos, captures, logos

# Reverb (realtime)
php artisan reverb:start

# Tinker (debug)
php artisan tinker
```

## ៧.២ បញ្ហាដែលជួបប្រទះញឹកញាប់

| បញ្ហា | មូលហេតុ | ដំណោះស្រាយ |
|---|---|---|
| **រូបថត / logo មិនបង្ហាញ** | មិនបាន `storage:link` | `php artisan storage:link` |
| **Brand title ខុស** | `config/helper.php` cache-ed | `php artisan config:clear` |
| **AJAX delete/save ត្រឡប់ 419** | CSRF token អស់សុពលភាព | Refresh page ឬ login ឡើងវិញ |
| **Login throttle បាន lock** | លើស 10 attempts/minute | រង់ចាំ 60 វិនាទី ឬប្ដូរ IP |
| **Webhook មិនទទួល** | `FB_VERIFY_TOKEN` ខុស | ផ្ទៀងផ្ទាត់ `.env` និង Facebook app config |
| **Telegram មិនផ្ញើ** | SSL/firewall ទប់ស្កាត់ | Check Cert (Service ប្រើ `verify=false` ជា workaround) |
| **Database connection refused** | MySQL service stopped | `sudo service mysql start` |
| **`php artisan route:cache` បរាជ័យ** | Closure នៅ web.php | Closure ភាគច្រើនត្រូវលុបដើម្បីឲ្យ cache ដំណើរការ |
| **Realtime user-list ស្ងាត់** | Reverb មិនដំណើរការ | `php artisan reverb:start` |

## ៧.៣ Backup ទិន្នន័យ

### MySQL (Production)

```bash
# Daily dump
mysqldump -u root -p --single-transaction --quick \
  --routines --triggers kuongkea \
  | gzip > /backup/kuongkea_$(date +%F).sql.gz

# Restore
gunzip < /backup/kuongkea_2026-05-27.sql.gz | mysql -u root -p kuongkea
```

### Files (storage)

```bash
# Sync ទៅ remote storage
rsync -avz storage/app/public/ user@backup-host:/backup/kuongkea-files/
```

## ៧.៤ ការអាប់ដេតកូដ (Code Update Workflow)

```bash
git pull origin main
composer install --no-dev --optimize-autoloader
npm install && npm run build
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

> **ជំពូកទី ៨ — សង្ខេប URL Routes សំខាន់ៗ**

---

| ផ្នែក | URL | Method | Route name |
|---|---|---|---|
| Login | `/login` | GET / **POST** | `showlogin` / `checklogin` |
| Logout | `/logout` | POST | `logout` |
| Dashboard | `/dashboard` | GET | `dashboard` |
| User register | `/register` | GET | `userregister` |
| **Exchange** | | | |
| Exchange page | `/exchange` | GET | `exchange.index` |
| Save exchange | `/saveexchange` | POST | `saveexchange` |
| Exchange list | `/exchangelists` | GET | `exchangelists` |
| Rate setup | `/currency/exchangeratenew` | GET | `currency.exchangeratenew` |
| Set rate | `/currency/setrate` | POST | `currency.setrate` |
| TV rate | `/tv` | GET | `currency.ratedisplaytv` |
| **Money Transfer** | | | |
| Partner transfer | `/moneytransfer/formtransfer` | GET | `moneytransfer.formtransfer` |
| Bank transfer | `/moneytransfer/banktransfer` | GET | `moneytransfer.banktransfer` |
| Wing transfer | `/moneytransfer/wingtransfer` | GET | `moneytransfer.wingtransfer` |
| Store transfer | `/moneytransfer/store` | POST | `moneytransfer.store` |
| Cash-draw | `/moneytransfer/cashdraw` | GET | `moneytransfer.cashdraw` |
| Delete transfer | `/moneytransfer/delete` | **POST** | `moneytransfer.delete` |
| **Thai Cash-draw** | | | |
| Thai SMS | `/thaicashdraw/thaisms` | GET | `thaicashdraw.thaisms` |
| Thai cash-draw | `/thaicashdraw/cashdraw` | GET | `thaicashdraw.cashdraw` |
| Thai close-list | `/thaicashdraw/closelist` | GET | `thaicashdraw.closelist` |
| **Partner List** | | | |
| New ledger | `/partnerlist/indexnew` | GET | `partnerlist.indexnew` |
| Old ledger | `/partnerlist` | GET | `partnerlist.index` |
| All partners | `/partnerlist/alllist` | GET | `partnerlist.alllist` |
| Netting | `/partnerlist/exchangelist/0` | GET | `partnerlist.exchangelist` |
| **Real Estate** | | | |
| Sell | `/realestate` | GET | `realestate.index` |
| Sold list | `/realestate/soldpropertylist` | GET | `realestate.soldpropertylist` |
| Contract | `/realestate/docontract` | GET | `realestate.docontract` |
| Land register | `/land` | GET | `land.index` |
| **User Capital** | | | |
| Index | `/usercapital` | GET | `usercapital.index` |
| Close list | `/usercapital/closelist` | GET | `usercapital.closelist` |
| Profit | `/usercapital/userprofit` | GET | `usercapital.userprofit` |
| **Customer** | | | |
| Index | `/customer` | GET | `customer.index` |
| Store | `/customer/store` | POST | `customer.store` |
| Delete | `/customer/delete` | **POST** | `customer.delete` |
| Capture | `/capture` | POST | `customer.capture` |
| **Reports** | | | |
| Close list | `/closelist` | GET | `closelist.index` |
| Transfer profit | `/report/transferprofit` | GET | `report.transferprofit` |
| Stock | `/stock` | GET | `stock.index` |
| Stock report | `/stock/report` | GET | `stock.report` |
| Buy/Sell report | `/stock/reportbuysale` | GET | `stock.reportbuysale` |

ចំនួនសរុបនៃ named routes នៅ `routes/web.php` = **584** (ភាគច្រើនជា helper / AJAX endpoints)។

---

> **ជំពូកទី ៩ — ការអភិវឌ្ឍបន្ត (Development Guide)**

---

## ៩.១ Conventions ដែលគួរយល់

- Controllers ភាគច្រើនបង្កប់ `business logic + DB queries + view rendering` ក្នុង method តែមួយ ដែលធ្វើឲ្យ file ធំ (8.6k LOC សម្រាប់ `UserCapitalController`)។ ការ refactor ទៅ Services / Form Requests ត្រូវការមុនពេលបន្ថែម feature ធំៗ។
- Models ខ្លះៗ​ស្ថិតនៅ `app/*.php` (legacy namespace `App\`) ហើយខ្លះទៀតនៅ `app/Models/*.php` (`App\Models\`)។ ការបន្ថែម model ថ្មីគួរដាក់នៅ `app/Models/` តាមនឹង Laravel default។
- AJAX ប្រើ jQuery `$.ajax` / `$.post` / `$.get` ដែលជាប់ CSRF ដោយស្វ័យប្រវត្តិតាមរយៈ `$.ajaxSetup` ក្នុង `master.blade.php`។

## ៩.២ របៀបបន្ថែម Module ថ្មី

1. **បង្កើត Migration**: `php artisan make:migration create_new_module_table`
2. **បង្កើត Model**: `php artisan make:model NewModule` (ដាក់ក្នុង `app/Models/`)
   - សូមកំណត់ `$fillable` ដើម្បីរារាំង mass-assignment
3. **បង្កើត Controller**: `php artisan make:controller NewModuleController`
4. **បន្ថែម Routes**: ក្នុង `routes/web.php` ក្រុមដែល `middleware:auth` (ឬ `auth,prevent-back-history`)
   - **WRITE actions ត្រូវប្រើ `Route::post()`** (មិនមែន GET ទេ)
5. **បង្កើត Views**: បង្កើត folder ក្នុង `resources/views/{module-name}/`
   - extend `master.blade.php`
   - ប្រើ `@section('css')`, `@section('content')`, `@section('script')`
6. **Permissions**: បន្ថែម code(s) ក្នុង `permissions` table ហើយ assign តាម role
7. **Sidebar / Dashboard**: បន្ថែម link ក្នុង `mainfunction.blade.php` និង `includes/sidebar.blade.php`

## ៩.៣ Coding standards ដែលគួរធ្វើ (post-PR #7)

- កុំប្រើ `Route::get` សម្រាប់សកម្មភាពដែលធ្វើ DB write/delete — **ប្រើ POST + CSRF**
- កុំ hard-code password ក្នុង controllers
- ប្រើ `Hash::check()` តែប៉ុណ្ណោះសម្រាប់ password verification
- កុំ trust `HTTP_X_FORWARDED_FOR` direct ដោយគ្មាន TRUSTED_PROXIES allowlist
- ប្រើ `Validator` ឬ Form Request សម្រាប់ input validation
- ប្រើ DB transaction (`DB::transaction(fn () => …)`) សម្រាប់ money-related writes ច្រើន step

## ៩.៤ Testing

- បច្ចុប្បន្ន: GitHub Actions CI ធ្វើតែ:
  - `composer validate`
  - `php -l` លើ `app/, config/, database/, routes/, tests/`
  - `php artisan view:cache`, `route:cache`, `config:cache`
  - `php artisan test --testsuite=Unit` (មាន `ExampleTest.php` ប៉ុណ្ណោះ — minimal coverage)
- ការ test ដែលគួរបន្ថែម:
  - Login flow + throttle
  - CSRF protection នៅ destructive POST routes
  - Permission check នៅ controllers (មិនមែនតែ Blade ទេ)

## ៩.៥ Branch / PR Workflow

```bash
# Create feature branch
git checkout main && git pull origin main
git checkout -b devin/$(date +%s)-feature-name

# Commit, push, PR
git add -A && git commit -m "feat: ..."
git push -u origin HEAD
gh pr create --fill --base main
```

CI ត្រូវ pass មុនពេល merge ទៅ main។

---

> **ជំពូកទី ១០ — ឯកសារយោង (References)**

---

## ឯកសារ Laravel & libraries

- **Laravel 13 Docs**: https://laravel.com/docs/13.x
- **Laravel Reverb**: https://laravel.com/docs/13.x/reverb
- **Sanctum**: https://laravel.com/docs/13.x/sanctum
- **Spatie Browsershot**: https://github.com/spatie/browsershot
- **Bootstrap 5**: https://getbootstrap.com/docs/5.2/
- **Vite**: https://vitejs.dev/
- **face-api.js**: https://github.com/justadudewhohacks/face-api.js

## File ដែលគួរអាន

- `config/helper.php` — feature flags
- `bootstrap/app.php` — middleware + trusted proxies
- `routes/web.php` — route ទាំងអស់
- `app/Http/Controllers/CustomAuth/LoginController.php` — login + permissions
- `app/User.php` — RBAC API (`checkpermission`, `hasRole`, `permissiongetamt`, `maxdateopenmoney`)
- `resources/views/master.blade.php` — layout + CSRF setup
- `resources/views/mainfunction.blade.php` — dashboard cards
- `resources/views/includes/sidebar.blade.php` — sidebar menu

## អ្នកអភិវឌ្ឍ (Developer Contact)

ប្រព័ន្ធនេះត្រូវបានដាក់ឲ្យដំណើរការសម្រាប់ **ហាងប្ដូរប្រាក់ ឡៅ ពួយឃាង ០៥** ដោយប្រើ
Laravel framework។ បើមានបញ្ហាសូមពិនិត្យ:

- `storage/logs/laravel.log` — Laravel runtime errors
- `storage/logs/` — log files ផ្សេងៗ
- GitHub Issues: https://github.com/samnangitsr/kuongkea/issues
- GitHub PRs: https://github.com/samnangitsr/kuongkea/pulls

---

**សង្ខេបការប្រើប្រាស់រហ័ស (Quick Start Checklist)**

- [ ] `git clone https://github.com/samnangitsr/kuongkea.git`
- [ ] `composer install`
- [ ] `npm install && npm run build`
- [ ] `cp .env.example .env`
- [ ] កំណត់ `.env`: DB, `TRUSTED_PROXIES=` (empty for direct internet), `TELEGRAM_*`, `FB_*`
- [ ] `php artisan key:generate`
- [ ] បង្កើត MySQL database
- [ ] `php artisan migrate` ឬ import SQL dump
- [ ] `php artisan storage:link`
- [ ] បង្កើត admin user តាមដៃ (insert into `users` ជាមួយ bcrypt password)
- [ ] `php artisan serve` (+ `php artisan reverb:start` បើត្រូវការ realtime)
- [ ] Login → ជ្រើស Company → ចូល Dashboard
- [ ] ដាក់ logo ទៅ `public/logo/` និងផ្លាស់ប្តូរ Brand title តាម `/company/register`
- [ ] Ready to use!

---
