# API Contract

Base path: `/api`

The examples below describe the intended JSON boundary between the Laravel backend and the Next.js frontend.

## Dashboard

### `GET /dashboard`

Returns operational KPIs.

```json
{
  "data": {
    "open_leads": 18,
    "active_clients": 124,
    "open_jobs": 11,
    "outstanding_balance": 18450
  }
}
```

## Convert Lead

### `POST /leads/{lead}/convert`

Converts an eligible lead into a client.

Example response:

```json
{
  "message": "Lead converted successfully.",
  "data": {
    "id": 42,
    "name": "Jordan Smith",
    "email": "jordan@example.test",
    "status": "active"
  }
}
```

Business rule: a lead that is already converted cannot be converted again.

## Record Payment

### `POST /invoices/{invoice}/payments`

Example request:

```json
{
  "amount": 500,
  "method": "card",
  "reference": "DEMO-10001"
}
```

Supported example methods:

- `card`
- `cash`
- `check`
- `ach`

The backend validates the amount and updates the invoice balance/status as part of the payment workflow.

## Error Shape

A production API should provide a predictable error contract. A representative shape is:

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "amount": ["The amount field must be greater than 0."]
  }
}
```

## Authentication

The route example uses Laravel Sanctum authentication. Authentication setup itself is outside the intentionally narrow scope of this showcase.
