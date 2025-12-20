<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Patient Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-50 to-purple-50">
    <div class="max-w-4xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold text-indigo-700 mb-6">Patient Management System</h1>

        <section class="bg-white shadow rounded p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Add New Patient</h2>
            <form id="patientForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="name" placeholder="Full Name" class="border rounded px-3 py-2" required>
                <input type="number" name="age" placeholder="Age" class="border rounded px-3 py-2" required min="1">
                <input type="email" name="email" placeholder="Email" class="border rounded px-3 py-2 md:col-span-2" required>
                <input type="text" name="condition" placeholder="Condition" class="border rounded px-3 py-2 md:col-span-2" required>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded md:col-span-2">Add Patient</button>
            </form>
            <p id="formMsg" class="text-sm mt-3"></p>
        </section>

        <section class="bg-white shadow rounded p-6">
            <h2 class="text-xl font-semibold mb-4">Patients</h2>
            <div id="patients" class="grid gap-4 md:grid-cols-2"></div>
        </section>
    </div>

    <script>
        const apiBase = 'api.php';

        async function fetchPatients() {
            const res = await fetch(`${apiBase}?action=list`);
            const data = await res.json();
            renderPatients(data.patients || []);
        }

        function renderPatients(items) {
            const container = document.getElementById('patients');
            container.innerHTML = '';
            if (!items.length) {
                container.innerHTML = '<p class="text-gray-500">No patients yet.</p>';
                return;
            }
            for (const p of items) {
                const card = document.createElement('div');
                card.className = 'border rounded p-4';
                card.innerHTML = `
                    <div class="flex justify-between">
                        <h3 class="font-bold text-indigo-700">${escapeHtml(p.name)}</h3>
                        <span class="text-sm text-gray-500">#${p.id}</span>
                    </div>
                    <p class="mt-2">Age: ${p.age}</p>
                    <p>Email: ${escapeHtml(p.email)}</p>
                    <p>Condition: ${escapeHtml(p.condition)}</p>
                    <p class="text-xs text-gray-500 mt-2">Created: ${p.created_at}</p>
                `;
                container.appendChild(card);
            }
        }

        function escapeHtml(str) {
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        document.getElementById('patientForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const form = e.target;
            const formMsg = document.getElementById('formMsg');
            const payload = Object.fromEntries(new FormData(form));

            try {
                const res = await fetch(`${apiBase}?action=add`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });
                const data = await res.json();
                if (data.success) {
                    form.reset();
                    formMsg.textContent = 'Patient added successfully.';
                    formMsg.className = 'text-green-600 text-sm mt-3';
                    fetchPatients();
                } else {
                    throw new Error(data.error || 'Failed to add patient.');
                }
            } catch (err) {
                formMsg.textContent = err.message || 'Error';
                formMsg.className = 'text-red-600 text-sm mt-3';
            }
        });

        fetchPatients();
    </script>
</body>
</html>