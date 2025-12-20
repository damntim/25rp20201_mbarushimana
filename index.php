<?php declare(strict_types=1); ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Patient Management</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Patient Management</h1>

    <div class="bg-white shadow rounded p-4 mb-6">
      <h2 class="text-xl font-semibold mb-3">Add Patient</h2>
      <form id="patientForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium">Name</label>
          <input type="text" name="name" required class="mt-1 w-full border rounded p-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">Age</label>
          <input type="number" name="age" min="0" max="150" required class="mt-1 w-full border rounded p-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">Email</label>
          <input type="email" name="email" required class="mt-1 w-full border rounded p-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">Condition</label>
          <input type="text" name="condition" required class="mt-1 w-full border rounded p-2" />
        </div>
        <div class="md:col-span-2">
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add</button>
          <span id="formStatus" class="ml-3 text-sm"></span>
        </div>
      </form>
    </div>

    <div class="bg-white shadow rounded p-4">
      <h2 class="text-xl font-semibold mb-3">Patients</h2>
      <table class="min-w-full border">
        <thead class="bg-gray-50">
        <tr>
          <th class="px-3 py-2 border">ID</th>
          <th class="px-3 py-2 border">Name</th>
          <th class="px-3 py-2 border">Age</th>
          <th class="px-3 py-2 border">Email</th>
          <th class="px-3 py-2 border">Condition</th>
        </tr>
        </thead>
        <tbody id="patientsTable"></tbody>
      </table>
    </div>
  </div>

  <script>
    async function loadPatients() {
      const res = await fetch('api.php?action=list');
      const data = await res.json();
      const tbody = document.getElementById('patientsTable');
      tbody.innerHTML = '';
      (data.patients || []).forEach(p => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td class="px-3 py-2 border">${p.id}</td>
          <td class="px-3 py-2 border">${p.name}</td>
          <td class="px-3 py-2 border">${p.age}</td>
          <td class="px-3 py-2 border">${p.email}</td>
          <td class="px-3 py-2 border">${p.condition}</td>
        `;
        tbody.appendChild(tr);
      });
    }

    function validateForm(form) {
      const status = document.getElementById('formStatus');
      status.textContent = '';
      const email = form.email.value.trim();
      const age = parseInt(form.age.value, 10);
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        status.textContent = 'Invalid email format.';
        status.className = 'ml-3 text-sm text-red-600';
        return false;
      }
      if (age < 0 || age > 150) {
        status.textContent = 'Age must be between 0 and 150.';
        status.className = 'ml-3 text-sm text-red-600';
        return false;
      }
      return true;
    }

    document.getElementById('patientForm').addEventListener('submit', async (e) => {
      e.preventDefault();
      const form = e.target;
      if (!validateForm(form)) return;

      const payload = {
        name: form.name.value.trim(),
        age: parseInt(form.age.value, 10),
        email: form.email.value.trim(),
        condition: form.condition.value.trim(),
      };

      const status = document.getElementById('formStatus');
      status.textContent = 'Submitting...';
      status.className = 'ml-3 text-sm text-gray-600';

      const res = await fetch('api.php?action=add', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload),
      });

      const data = await res.json();
      if (!res.ok) {
        status.textContent = (data.errors || [data.error || 'Error']).join(', ');
        status.className = 'ml-3 text-sm text-red-600';
        return;
      }

      status.textContent = 'Patient added';
      status.className = 'ml-3 text-sm text-green-600';
      form.reset();
      await loadPatients();
    });

    loadPatients();
  </script>
</body>
</html>