# Architecture

## Purpose

This repository is a focused portfolio example of a business CRM architecture. It intentionally keeps the domain small enough to review quickly while demonstrating patterns used in larger applications.

## System Boundary

```text
Browser
   |
   v
Next.js / React / TypeScript
   |
   | JSON over HTTPS
   v
Laravel REST API
   |
   +--> Controllers
   |      |
   |      v
   |    Services
   |      |
   |      v
   +--> Eloquent Models
          |
          v
     Relational Database
```

## Backend Responsibilities

The backend owns business rules and persistence.

Controllers are intentionally thin. They validate or receive validated input, delegate workflow logic to services, and return HTTP responses.

Services coordinate operations that affect multiple records or require transactional consistency. For example, converting a lead creates a client and changes the lead state in one database transaction. Recording a payment creates the payment and recalculates invoice state in one transaction.

## Frontend Responsibilities

The frontend owns presentation and user interaction. TypeScript interfaces describe the API-facing domain, while the API client centralizes HTTP behavior so components do not need to know endpoint details.

This separation makes it easier to replace mock data with live API responses without redesigning presentation components.

## Domain Relationships

```text
Lead --conversion--> Client
                      |
                      | 1:N
                      v
                     Job
                      |
                      | 1:N
                      v
                   Invoice
                      |
                      | 1:N
                      v
                   Payment
```

## Business Invariants

Examples represented in this showcase:

- A converted lead should not be converted a second time.
- Lead conversion should be transactional.
- Payments must be positive.
- A payment cannot exceed the invoice balance.
- Invoice balance and payment status are recalculated after payment.
- Dashboard metrics are derived from operational data rather than stored independently.

## Production Considerations

A production implementation would additionally include policies and granular permissions, pagination, idempotency for payment operations, stronger money handling using integer minor units or a money value object, background jobs for email/document delivery, observability, audit trails, rate limiting, and expanded automated tests.

Those concerns are documented rather than artificially presented as completed functionality in this portfolio repository.
