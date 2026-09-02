import { KpiCard } from "../components/KpiCard";

const metrics = {
  open_leads: 18,
  active_clients: 124,
  open_jobs: 11,
  outstanding_balance: 18450,
};

const recentJobs = [
  { id: 1042, client: "Northstar Properties", title: "Site cleanup", status: "Scheduled", total: 1850 },
  { id: 1041, client: "Morgan Reed", title: "Material removal", status: "In progress", total: 920 },
  { id: 1039, client: "Oak Street Partners", title: "Commercial pickup", status: "Completed", total: 2450 },
];

export default function DashboardPage() {
  return (
    <main className="min-h-screen bg-slate-50 px-6 py-10 text-slate-950">
      <div className="mx-auto max-w-6xl">
        <header className="mb-8 flex flex-col gap-2">
          <p className="text-sm font-semibold uppercase tracking-wider text-slate-500">
            CRM Operations
          </p>
          <h1 className="text-3xl font-bold tracking-tight">Business Dashboard</h1>
          <p className="max-w-2xl text-slate-600">
            Example full-stack workflow connecting leads, clients, jobs, invoices,
            payments, and operational reporting.
          </p>
        </header>

        <section className="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
          <KpiCard label="Open Leads" value={metrics.open_leads} hint="Awaiting follow-up" />
          <KpiCard label="Active Clients" value={metrics.active_clients} />
          <KpiCard label="Open Jobs" value={metrics.open_jobs} hint="Scheduled or in progress" />
          <KpiCard
            label="Outstanding"
            value={new Intl.NumberFormat("en-US", {
              style: "currency",
              currency: "USD",
              maximumFractionDigits: 0,
            }).format(metrics.outstanding_balance)}
            hint="Unpaid invoice balance"
          />
        </section>

        <section className="mt-8 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
          <div className="border-b border-slate-200 px-6 py-5">
            <h2 className="text-lg font-semibold">Recent Jobs</h2>
            <p className="text-sm text-slate-500">Example operational activity</p>
          </div>

          <div className="overflow-x-auto">
            <table className="w-full text-left text-sm">
              <thead className="bg-slate-50 text-slate-500">
                <tr>
                  <th className="px-6 py-3 font-medium">Job</th>
                  <th className="px-6 py-3 font-medium">Client</th>
                  <th className="px-6 py-3 font-medium">Status</th>
                  <th className="px-6 py-3 text-right font-medium">Total</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-slate-100">
                {recentJobs.map((job) => (
                  <tr key={job.id}>
                    <td className="px-6 py-4">
                      <p className="font-medium">{job.title}</p>
                      <p className="text-slate-500">#{job.id}</p>
                    </td>
                    <td className="px-6 py-4">{job.client}</td>
                    <td className="px-6 py-4">{job.status}</td>
                    <td className="px-6 py-4 text-right font-medium">
                      ${job.total.toLocaleString("en-US")}
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </section>
      </div>
    </main>
  );
}
