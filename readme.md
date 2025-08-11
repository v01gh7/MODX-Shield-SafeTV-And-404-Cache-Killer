## 🛡 MODX Shield — SafeTV & 404 Cache Killer — Problem-Solving Plugin

---

## 📜 Description

In MODX, two common issues can **overload the server** and **bloat the cache**:

1. **Missing `$modx->resource`** — calling TVs in chunks or Fenom templates without a resource context can cause fatal errors.
2. **Caching the 404 page** — the "Page Not Found" error page gets cached as if it were a valid page.
   Every unique invalid URL request creates a separate cache file, quickly filling disk space.

---

## 🚨 Problem

This leads to:

* **Cache bloat** — thousands of identical error page cache files.
* **Increased memory/disk usage** — large cache files slow down the site.
* **Site crashes** — calling TVs without a resource causes errors.
* **SEO issues** — search engines may index 404 pages as real content.
* **Performance drop** — unnecessary cache creation increases disk I/O.
* **Higher hosting bills** — on **pay-as-you-go platforms** like Railway, Vercel, Render, this waste directly increases your monthly costs.

---

## 🛠 How This Plugin Solves the Problem

**SafeTV + Disable404Cache** is a **single MODX plugin** that fixes both issues:

* **SafeTV**:

  * Handles missing `$modx->resource` safely.
  * Returns empty strings for TVs instead of throwing errors.
  * Works in both standard chunks and Fenom templates.

* **Disable404Cache**:

  * Detects 404 pages by **error\_page ID** or **HTTP 404 status code**.
  * Disables caching for these pages entirely.
  * Prevents thousands of duplicate cache files from being created.
  * Reduces disk usage and speeds up response times.


---

## 🔧 Installation

1. Go to **Elements → Plugins → Create** in the MODX manager.
2. Name it, for example: **SafeTV + Disable404Cache**.
3. Paste the code from this repository.
4. Enable events:

   * `OnWebPageInit`
   * `OnLoadWebDocument`
   * `OnWebPagePrerender`
5. Save and clear the MODX cache.

---

## 📌 Problem → Solution

| Problem                                                                 | How This Plugin Solves It                                                                                   |
| ----------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------- |
| Calling TVs when no resource is loaded causes errors                    | Overrides TV calls to safely return empty strings.                                                          |
| 404 page is cached like a normal page                                   | Detects by error\_page ID and HTTP code 404, disables caching.                                              |
| Thousands of identical cache files from 404 requests                    | Disables cache generation for 404 + cleans up existing 404 cache files.                                     |
| Disk space bloat and performance loss                                   | Removes unnecessary cache files and stops them from being created.                                          |
| SEO pollution with indexed 404 pages                                    | Prevents caching so these pages aren’t seen as “real” content by search engines.                            |
| Higher monthly hosting costs on pay-as-you-go platforms (Railway, etc.) | Reduces cache size and server I/O, lowering bandwidth and storage usage, which directly cuts monthly bills. |

---

## 📈 Result

After installing this plugin:

* Cache bloat from 404 pages stops immediately.
* Existing 404 cache files are deleted.
* Site performance improves due to reduced disk I/O.
* No more TV-related errors when `$modx->resource` is missing.
* Monthly hosting costs can **drop** on usage-based billing platforms.

---
