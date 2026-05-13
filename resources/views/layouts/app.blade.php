<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCore | @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style type="text/tailwindcss">
        @layer components {
            body { font-family: 'Inter', sans-serif; }

            .nav-link {
                @apply flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-slate-500 hover:bg-slate-50;
            }
            .nav-link-active {
                @apply bg-blue-50 text-blue-700 font-semibold;
            }

            .card-container {
                @apply bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden p-10;
            }
            .table-container {
                @apply bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden;
            }

            .label-text {
                @apply block text-sm font-bold text-slate-700 mb-2;
            }
            .input-field {
                @apply w-full border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-4 focus:ring-blue-50 focus:border-blue-500 transition-all bg-white;
            }
            .input-error {
                @apply border-rose-500 ring-rose-50;
            }

            .btn-primary {
                @apply bg-blue-600 text-white px-10 py-4 rounded-2xl font-bold shadow-lg shadow-blue-100 hover:bg-blue-700 transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2;
            }
            .btn-secondary {
                @apply bg-slate-100 text-slate-600 px-10 py-4 rounded-2xl font-bold hover:bg-slate-200 transition-all inline-block text-center;
            }
            
            .badge {
                @apply px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider;
            }
        }
    </style>
</head>

<body class="bg-[#f8fafc] text-slate-900">
    <div class="min-h-screen flex">

        {{-- Sidebar --}}
        <aside class="w-72 bg-white border-r border-slate-200 hidden lg:flex flex-col sticky top-0 h-screen">
            <div class="p-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 text-blue-600 group">
                    <div class="p-2 bg-blue-600 rounded-lg text-white group-hover:shadow-lg transition-all">
                        <i data-feather="activity"></i>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-slate-800">MediCore</span>
                </a>
            </div>

            <nav class="flex-1 px-6 space-y-2">
                <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Main Menu</p>

                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'nav-link-active' : '' }}">
                    <i data-feather="pie-chart" class="w-5 h-5"></i>
                    <span>Overview</span>
                </a>

                <a href="{{ route('patients.index') }}" class="nav-link {{ request()->routeIs('patients.*') ? 'nav-link-active' : '' }}">
                    <i data-feather="users" class="w-5 h-5"></i>
                    <span>Patients</span>
                </a>

                <a href="{{ route('doctors.index') }}" class="nav-link {{ request()->routeIs('doctors.*') ? 'nav-link-active' : '' }}">
                    <i data-feather="shield" class="w-5 h-5"></i>
                    <span>Doctors</span>
                </a>

                <a href="{{ route('appointments.index') }}" class="nav-link {{ request()->routeIs('appointments.*') ? 'nav-link-active' : '' }}">
                    <i data-feather="calendar" class="w-5 h-5"></i>
                    <span>Appointments</span>
                </a>

                <a href="{{ route('medical_records.index') }}" class="nav-link {{ request()->routeIs('medical_records.*') ? 'nav-link-active' : '' }}">
                    <i data-feather="file-text" class="w-5 h-5"></i>
                    <span>Medical Records</span>
                </a>
            </nav>

            {{-- Sidebar bottom user info --}}
            <div class="p-6 border-t border-slate-100">
                <div class="flex items-center gap-3 p-2">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                        <i data-feather="user" class="w-5 h-5 text-blue-600"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-sm font-bold text-slate-700">{{ auth()->user()->name }}</span>
                        <span class="text-xs text-slate-400">Hospital Staff</span>
                    </div>
                </div>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1">

            {{-- Top Header --}}
            {{-- <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-10 flex items-center justify-between px-10">
                <h1 class="text-xl font-bold text-slate-800">@yield('header_title')</h1> --}}

                <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-10 flex items-center justify-between px-10">
    <h1 class="text-xl font-bold text-slate-800">@yield('header_title')</h1>

    {{-- Global Search --}}
    <div class="relative w-96" x-data="{ open: false }">
        <div class="relative">
            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-slate-400">
                <i data-feather="search" class="w-4 h-4"></i>
            </div>
            <input type="text" id="globalSearch"
                placeholder="Search patients, doctors..."
                class="w-full border border-slate-200 rounded-xl pl-11 pr-4 py-2.5 outline-none focus:ring-4 focus:ring-blue-50 focus:border-blue-500 transition-all text-sm"
                autocomplete="off">
        </div>
        {{-- Results Dropdown --}}
        <div id="searchResults"
            class="absolute top-full left-0 right-0 mt-2 bg-white rounded-2xl border border-slate-200 shadow-xl z-50 hidden max-h-96 overflow-y-auto">
        </div>
    </div>

                <div class="flex items-center gap-4">

                    {{-- Success Message --}}
                    @if(session('success'))
                    <div id="success-alert" class="flex items-center gap-2 bg-emerald-50 text-emerald-700 px-4 py-2 rounded-lg border border-emerald-100 text-sm font-bold transition-opacity duration-500">
                        <i data-feather="check-circle" class="w-4 h-4"></i>
                        {{ session('success') }}
                    </div>
                    @endif

                    {{-- Logged in user name --}}
                    <span class="text-sm text-slate-500 font-medium">
                        {{ auth()->user()->name }}
                    </span>

                    {{-- Logout button --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 bg-rose-50 text-rose-600 px-4 py-2 rounded-xl text-sm font-bold hover:bg-rose-100 transition-all">
                            <i data-feather="log-out" class="w-4 h-4"></i>
                            Logout
                        </button>
                    </form>

                </div>
            </header>

            {{-- Page Content --}}
            <div class="p-10 max-w-7xl mx-auto">
                @yield('content')
            </div>

        </main>
    </div>

    
              <script>
    // Global Search
    const searchInput = document.getElementById('globalSearch');
    const searchResults = document.getElementById('searchResults');
    let searchTimeout;

    searchInput.addEventListener('input', function () {
        clearTimeout(searchTimeout);
        const query = this.value.trim();

        if (query.length < 2) {
            searchResults.classList.add('hidden');
            return;
        }

        searchTimeout = setTimeout(() => {
            fetch(`/search?query=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    renderResults(data);
                });
        }, 300);
    });

    document.addEventListener('click', function (e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.classList.add('hidden');
        }
    });

    function getIcon(type) {
        const icons = {
            patient:     'users',
            doctor:      'shield',
            record:      'file-text',
            appointment: 'calendar',
        };
        return icons[type] || 'search';
    }

    function getColor(type) {
        const colors = {
            patient:     'text-blue-600 bg-blue-50',
            doctor:      'text-emerald-600 bg-emerald-50',
            record:      'text-rose-600 bg-rose-50',
            appointment: 'text-violet-600 bg-violet-50',
        };
        return colors[type] || 'text-slate-600 bg-slate-50';
    }

    function getLabel(type) {
        const labels = {
            patient:     'Patient',
            doctor:      'Doctor',
            record:      'Medical Record',
            appointment: 'Appointment',
        };
        return labels[type] || type;
    }

    function renderResults(data) {
        const all = [
            ...data.patients,
            ...data.doctors,
            ...data.records,
            ...data.appointments,
        ];

        if (all.length === 0) {
            searchResults.innerHTML = `
                <div class="p-6 text-center text-slate-400">
                    <i data-feather="search" class="w-8 h-8 mx-auto mb-2"></i>
                    <p class="text-sm">No results found</p>
                </div>`;
            searchResults.classList.remove('hidden');
            feather.replace();
            return;
        }

        // Group by type
        let html = '';
        const groups = {
            patient: { label: 'Patients', items: data.patients },
            doctor: { label: 'Doctors', items: data.doctors },
            record: { label: 'Medical Records', items: data.records },
            appointment: { label: 'Appointments', items: data.appointments },
        };

        for (const [type, group] of Object.entries(groups)) {
            if (group.items.length === 0) continue;

            html += `<div class="px-4 pt-3 pb-1">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">${group.label}</p>
            </div>`;

            group.items.forEach(item => {
                const color = getColor(type);
                const icon = getIcon(type);
                html += `
                    <a href="${item.url}" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 transition-all">
                        <div class="p-2 rounded-lg ${color}">
                            <i data-feather="${icon}" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-700">${item.title}</p>
                            <p class="text-xs text-slate-400">${item.subtitle}</p>
                        </div>
                        <div class="ml-auto">
                            <span class="text-[10px] font-bold px-2 py-1 rounded-full ${color}">${getLabel(type)}</span>
                        </div>
                    </a>`;
            });
        }

        html += `<div class="p-3 border-t border-slate-100 text-center">
            <p class="text-xs text-slate-400">${all.length} result(s) found</p>
        </div>`;

        searchResults.innerHTML = html;
        searchResults.classList.remove('hidden');
        feather.replace();
    }
</script>   
    
    <script>
        feather.replace();
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 3000);
            }
        });
    </script>
</body>
</html>