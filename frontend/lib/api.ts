import type { DashboardMetrics } from "../types/crm";

const API_URL = process.env.NEXT_PUBLIC_API_URL ?? "http://localhost:8000/api";

type ApiEnvelope<T> = {
  data: T;
  message?: string;
};

async function request<T>(path: string, init?: RequestInit): Promise<T> {
  const response = await fetch(`${API_URL}${path}`, {
    ...init,
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      ...init?.headers,
    },
    credentials: "include",
  });

  if (!response.ok) {
    throw new Error(`API request failed with status ${response.status}`);
  }

  const payload = (await response.json()) as ApiEnvelope<T>;
  return payload.data;
}

export function getDashboard(): Promise<DashboardMetrics> {
  return request<DashboardMetrics>("/dashboard");
}

export function convertLead(leadId: number): Promise<unknown> {
  return request(`/leads/${leadId}/convert`, {
    method: "POST",
  });
}

export function recordPayment(
  invoiceId: number,
  amount: number,
  method: "card" | "cash" | "check" | "ach",
): Promise<unknown> {
  return request(`/invoices/${invoiceId}/payments`, {
    method: "POST",
    body: JSON.stringify({ amount, method }),
  });
}
