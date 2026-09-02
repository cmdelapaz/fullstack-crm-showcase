# Full-Stack CRM Showcase

A portfolio project demonstrating the architecture of a modern business CRM using a **Laravel REST API** and a **Next.js / React / TypeScript frontend**.

> **Portfolio showcase:** This repository uses fictional organizations, customers, jobs, invoices, and payments. It is inspired by business workflows I have implemented in larger private applications, but it does not contain private business data, credentials, or proprietary production code.

## Business Workflow

```text
Lead
  ↓
Client
  ↓
Job
  ↓
Quote / Invoice
  ↓
Payment
  ↓
Dashboard & Reporting
```

The goal is to demonstrate how technical architecture connects to a real operational workflow rather than presenting isolated CRUD examples.

## What This Repository Demonstrates

### Backend
- Laravel-style REST API architecture
- Controllers separated from business logic
- Service-layer workflow orchestration
- Request validation patterns
- API resources / structured responses
- Relational domain modeling
- Business-state transitions
- Feature testing concepts

### Frontend
- Next.js App Router structure
- React components
- TypeScript domain models
- Typed API client
- Dashboard composition
- Loading and error states
- Business-oriented UI patterns

### Business Logic
- Lead-to-client conversion
- Client and job relationships
- Job lifecycle states
- Invoice creation
- Payment recording
- Dashboard KPI aggregation

## Repository Structure

```text
backend/
├── app/
│   ├── Http/Controllers/Api/
│   ├── Http/Requests/
│   ├── Http/Resources/
│   ├── Models/
│   └── Services/
├── routes/
└── tests/Feature/

frontend/
├── app/
├── components/
├── lib/
└── types/

docs/
├── ARCHITECTURE.md
└── API.md
```

## Example Domain

The showcase models a fictional service business where a lead can become a client, a client can have multiple jobs, jobs can generate invoices, and invoices can receive payments.

Key entities:

- `Lead`
- `Client`
- `Job`
- `Invoice`
- `Payment`

## Technology Stack

**Backend:** PHP · Laravel · REST APIs · SQL · PHPUnit-style feature testing

**Frontend:** Next.js · React · TypeScript · Fetch API

**Architecture:** Service layer · Typed API boundary · Relational domain model · Business workflow modeling

## API Examples

```http
GET /api/dashboard
GET /api/clients
POST /api/leads/{lead}/convert
GET /api/jobs
POST /api/jobs/{job}/invoices
POST /api/invoices/{invoice}/payments
```

See [`docs/API.md`](docs/API.md) for the example API contract.

## Why This Project Exists

My larger projects include SaaS, CRM, financial, and operational applications that remain private because they contain proprietary business logic or are still under active development.

This repository provides recruiters and engineering teams with a public, focused example of how I structure full-stack business software while keeping those private applications protected.

## Related Portfolio Projects

- [`laravel-saas-showcase`](https://github.com/cmdelapaz/laravel-saas-showcase) — multi-tenant Laravel architecture, authorization, and testing
- [`nextjs-dashboard-showcase`](https://github.com/cmdelapaz/nextjs-dashboard-showcase) — Next.js, React, TypeScript, reusable components, and API integration

## Author

**Carlos Gonzalez**  
Software Developer · Full-Stack Web Development · SaaS & Business Applications

GitHub: [@cmdelapaz](https://github.com/cmdelapaz)
