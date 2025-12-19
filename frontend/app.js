function getApiBaseUrl() {
  const input = document.getElementById('apiBaseUrl');
  const base = (input?.value || '').trim();
  return base.endsWith('/') ? base.slice(0, -1) : base;
}

function apiUrl(path) {
  const base = getApiBaseUrl();
  if (!base) return path;
  if (path.startsWith('/')) return `${base}${path}`;
  return `${base}/${path}`;
}

function setText(id, text) {
  const el = document.getElementById(id);
  if (el) el.textContent = text;
}

function escapeHtml(value) {
  return String(value)
    .replaceAll('&', '&amp;')
    .replaceAll('<', '&lt;')
    .replaceAll('>', '&gt;')
    .replaceAll('"', '&quot;')
    .replaceAll("'", '&#039;');
}

function renderPatients(patients) {
  const list = document.getElementById('patientsList');
  if (!list) return;

  if (!Array.isArray(patients) || patients.length === 0) {
    list.innerHTML =
      '<div class="rounded-xl border border-slate-800 bg-slate-900/40 p-4 text-sm text-slate-300">No patients yet.</div>';
    return;
  }

  list.innerHTML = patients
    .map((p) => {
      const created = p.created_at ? new Date(p.created_at).toLocaleString() : '';
      return `
        <div class="rounded-xl border border-slate-800 bg-slate-900/40 p-4">
          <div class="flex items-start justify-between gap-4">
            <div>
              <div class="text-sm font-semibold text-slate-100">${escapeHtml(p.name || '')}</div>
              <div class="mt-1 text-xs text-slate-400">ID: ${escapeHtml(p.id ?? '')}${created ? ` • ${escapeHtml(created)}` : ''}</div>
            </div>
            <div class="shrink-0 rounded-full border border-slate-700 bg-slate-950/30 px-3 py-1 text-xs text-slate-200">
              Age: ${escapeHtml(p.age ?? '')}
            </div>
          </div>
          <div class="mt-3 grid gap-1 text-sm">
            <div><span class="text-slate-400">Email:</span> <span class="text-slate-200">${escapeHtml(p.email || '')}</span></div>
            <div><span class="text-slate-400">Condition:</span> <span class="text-slate-200">${escapeHtml(p.condition || '')}</span></div>
          </div>
        </div>
      `;
    })
    .join('');
}

async function fetchPatients() {
  setText('listStatus', 'Loading...');
  try {
    const res = await fetch(apiUrl('/api/patients.php'));
    const data = await res.json();
    if (!res.ok) {
      throw new Error(data?.error || `Request failed (${res.status})`);
    }
    renderPatients(data);
    setText('listStatus', `${Array.isArray(data) ? data.length : 0} patients`);
  } catch (e) {
    renderPatients([]);
    setText('listStatus', e?.message || 'Failed');
  }
}

async function createPatient(payload) {
  const res = await fetch(apiUrl('/api/patients.php'), {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(payload),
  });

  const data = await res.json().catch(() => ({}));

  if (!res.ok) {
    throw new Error(data?.error || `Request failed (${res.status})`);
  }

  return data;
}

function init() {
  const form = document.getElementById('patientForm');
  const refreshBtn = document.getElementById('refreshBtn');

  refreshBtn?.addEventListener('click', () => {
    fetchPatients();
  });

  form?.addEventListener('submit', async (event) => {
    event.preventDefault();

    const formData = new FormData(form);
    const payload = {
      name: String(formData.get('name') || '').trim(),
      age: Number(formData.get('age') || 0),
      email: String(formData.get('email') || '').trim(),
      condition: String(formData.get('condition') || '').trim(),
    };

    setText('formStatus', 'Submitting...');

    try {
      await createPatient(payload);
      setText('formStatus', 'Saved.');
      form.reset();
      await fetchPatients();
    } catch (e) {
      setText('formStatus', e?.message || 'Failed');
    }
  });

  fetchPatients();
}

init();
