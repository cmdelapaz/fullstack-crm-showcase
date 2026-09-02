export type JobStatus =
  | "draft"
  | "scheduled"
  | "in_progress"
  | "completed"
  | "cancelled";

export type InvoiceStatus =
  | "draft"
  | "sent"
  | "partial"
  | "paid"
  | "overdue";

export interface DashboardMetrics {
  open_leads: number;
  active_clients: number;
  open_jobs: number;
  outstanding_balance: number;
}

export interface Client {
  id: number;
  name: string;
  email: string | null;
  phone: string | null;
  status: "active" | "inactive";
}

export interface Job {
  id: number;
  client_id: number;
  title: string;
  scheduled_at: string | null;
  status: JobStatus;
  total: number;
}

export interface Invoice {
  id: number;
  job_id: number;
  number: string;
  total: number;
  amount_paid: number;
  balance_due: number;
  status: InvoiceStatus;
}
