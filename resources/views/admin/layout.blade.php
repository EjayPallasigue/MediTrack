<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'MediTrack') }} — Admin</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen grid grid-cols-12">
            <aside class="col-span-2 bg-brand text-white p-4 space-y-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <img class="h-8" src="{{ asset('brand/logo.png') }}" alt="MediTrack" />
                    <span class="font-semibold">MediTrack</span>
                </a>
                <nav class="space-y-2 text-sm">
                    <a class="block px-3 py-2 rounded hover:bg-brand-dark" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <a class="block px-3 py-2 rounded hover:bg-brand-dark" href="{{ route('patients.index') }}">Patients</a>
                    <a class="block px-3 py-2 rounded hover:bg-brand-dark" href="{{ route('appointments.index') }}">Appointments</a>
                    <a class="block px-3 py-2 rounded hover:bg-brand-dark" href="{{ route('invoices.index') }}">Billing</a>
                    <a class="block px-3 py-2 rounded hover:bg-brand-dark" href="{{ route('inventory.index') }}">Inventory</a>
                    <a class="block px-3 py-2 rounded hover:bg-brand-dark" href="{{ route('staff.index') }}">Staff</a>
                </nav>
            </aside>
            <main class="col-span-10 p-6">
                {{ $slot }}
            </main>
        </div>
    </body>
 </html>


