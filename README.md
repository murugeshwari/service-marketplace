# Service Marketplace Platform (Laravel 10)

A role-based service marketplace platform built with Laravel 10, allowing customers to send enquiries to service providers without exposing email addresses. Providers can reply via an internal messaging system, and administrators can monitor all activity.

---

## 🏗 Architecture Overview

### Tech Stack
- **Backend:** Laravel 10
- **Frontend:** Blade + Tailwind CSS
- **Authentication:** Laravel Auth (session-based)
- **Database:** MySQL
- **ORM:** Eloquent

---

## 👥 User Roles

| Role | Permissions |
|----|----|
| Guest | Browse listings only |
| Customer | Send enquiries, view replies |
| Provider | Receive enquiries, reply |
| Administrator | View all enquiries and replies |

Role handling is implemented via:
- `role` column in `users` table
- Helper methods (`isAdmin()`, `isCustomer()`, `isProvider()`)
- Route middleware protection

---

## ✉️ Enquiry & Messaging Flow

1. Customer submits an enquiry from a listing
2. Enquiry is stored with:
   - `customer_id`
   - `provider_id`
   - `listing_id`
3. Provider replies via internal system
4. Replies are stored in `enquiry_replies` table
5. **No email addresses are ever exposed**

All communication stays inside the platform.

---

## 🗄 Database Design

### Main Tables
- `users` (roles: admin, customer, provider)
- `listings`
- `enquiries`
- `enquiry_replies`

### Relationships
- User → Listings (Provider)
- Listing → Enquiries
- Enquiry → Replies
- Reply → User

---

## 🔐 Security Decisions

- Role-based route protection
- Authorization checks inside controllers
- No direct email sharing
- Eager loading to prevent N+1 queries

---

## ⚙️ Setup Instructions

### Requirements
- PHP >= 8.1
- Composer
- MySQL
- Node.js & npm

### Installation

```bash
git clone <YOUR_GIT_REPO_URL>
cd service-marketplace
composer install
npm install && npm run build
# service-marketplace
