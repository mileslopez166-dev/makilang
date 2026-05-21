@php($title = 'Profile Settings')

@extends('layouts.ms')

@section('content')
    <style>
        .settings-shell {
            max-width: 980px;
            margin: 0 auto;
            padding: 14px;
            font-family: Arial, sans-serif;
            color: #111827;
        }

        .settings-header {
            margin-bottom: 22px;
        }

        .settings-header h1 {
            margin: 0;
            font-size: 34px;
        }

        .settings-header p {
            margin: 8px 0 0;
            color: #64748b;
        }

        .settings-grid {
            display: grid;
            gap: 18px;
        }

        .settings-card {
            border-radius: 24px;
            background: #ffffff;
            padding: 22px;
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
        }

        .settings-card h2 {
            margin: 0 0 16px;
            font-size: 20px;
        }

        .settings-row + .settings-row {
            margin-top: 14px;
        }

        .settings-label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 700;
            color: #374151;
        }

        .settings-input {
            width: 100%;
            height: 44px;
            padding: 0 14px;
            border: 1px solid #d1d5db;
            border-radius: 14px;
            background: #f8fafc;
            color: #111827;
        }

        .settings-helper {
            margin-top: 6px;
            font-size: 12px;
            color: #64748b;
        }

        .settings-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 14px 0;
            border-top: 1px solid #e5e7eb;
        }

        .settings-toggle:first-of-type {
            border-top: 0;
            padding-top: 0;
        }

        .settings-switch {
            width: 52px;
            height: 30px;
            border-radius: 999px;
            background: #cbd5e1;
            position: relative;
        }

        .settings-switch::after {
            content: "";
            position: absolute;
            top: 4px;
            left: 4px;
            width: 22px;
            height: 22px;
            border-radius: 999px;
            background: #ffffff;
        }

        .settings-switch.is-on {
            background: #3b82f6;
        }

        .settings-switch.is-on::after {
            left: 26px;
        }

        .settings-actions {
            margin-top: 18px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .settings-button {
            height: 42px;
            padding: 0 18px;
            border-radius: 999px;
            border: 0;
            background: #0f172a;
            color: #ffffff;
            font-weight: 700;
        }

        .settings-button.secondary {
            background: #e2e8f0;
            color: #0f172a;
        }

        .settings-danger-card {
            border: 1px solid #fecdd3;
            background: #fff1f2;
        }

        .settings-danger-copy {
            margin: 0;
            color: #9f1239;
            line-height: 1.6;
        }

        .settings-button.danger {
            background: #be123c;
            color: #ffffff;
        }

        .settings-button.danger:hover {
            background: #9f1239;
        }

        .settings-modal-copy {
            margin: 12px 0 0;
            color: #64748b;
            line-height: 1.6;
        }

        .settings-error {
            margin-top: 10px;
            color: #be123c;
            font-size: 13px;
            font-weight: 600;
        }
    </style>

    <div class="settings-shell">
        <div class="settings-header">
            <h1>Profile Settings</h1>
            <p>Manage your account details and the way your Movie Square profile behaves.</p>
        </div>

        <div class="settings-grid">
            <section class="settings-card">
                <h2>Account Info</h2>

                <div class="settings-row">
                    <label class="settings-label" for="settings-name">Display Name</label>
                    <input id="settings-name" class="settings-input" type="text" value="{{ auth()->user()->name }}" readonly>
                </div>

                <div class="settings-row">
                    <label class="settings-label" for="settings-email">Email Address</label>
                    <input id="settings-email" class="settings-input" type="email" value="{{ auth()->user()->email }}" readonly>
                    <div class="settings-helper">These values are currently read-only in this screen layout.</div>
                </div>
            </section>

            <section class="settings-card">
                <h2>Social Profiles</h2>

                @foreach($socialLinks as $social)
                    <div class="settings-row">
                        <label class="settings-label">{{ $social['label'] }}</label>
                        <input class="settings-input" type="text" value="{{ $social['url'] }}" readonly>
                    </div>
                @endforeach
            </section>

            <section class="settings-card">
                <h2>Preferences</h2>

                <div class="settings-toggle">
                    <div>
                        <strong>Email notifications</strong>
                        <div class="settings-helper">Get alerts when new movies are added.</div>
                    </div>
                    <div class="settings-switch is-on"></div>
                </div>

                <div class="settings-toggle">
                    <div>
                        <strong>Public activity</strong>
                        <div class="settings-helper">Allow your watched movies and comments to show on profile views.</div>
                    </div>
                    <div class="settings-switch is-on"></div>
                </div>

                <div class="settings-toggle">
                    <div>
                        <strong>Auto-save watch history</strong>
                        <div class="settings-helper">Keep your top genres updated from the movies you watch.</div>
                    </div>
                    <div class="settings-switch is-on"></div>
                </div>

                <div class="settings-actions">
                    <button type="button" class="settings-button">Save Changes</button>
                    <button type="button" class="settings-button secondary">Cancel</button>
                </div>
            </section>

            <section class="settings-card settings-danger-card">
                <h2>Delete Account</h2>
                <p class="settings-danger-copy">Permanently delete your Movie Square account. After deletion, you will be signed out and sent to the login page.</p>

                <div class="settings-actions">
                    <button
                        type="button"
                        class="settings-button danger"
                        x-data
                        x-on:click="$dispatch('open-modal', 'confirm-user-deletion')"
                    >
                        Delete Account
                    </button>
                </div>
            </section>
        </div>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">Are you sure you want to delete your account?</h2>
            <p class="settings-modal-copy">This action is permanent. Enter your password to confirm account deletion.</p>

            <div class="mt-6">
                <label class="settings-label" for="delete-password">Password</label>
                <input
                    id="delete-password"
                    name="password"
                    type="password"
                    class="settings-input"
                    placeholder="Password"
                >

                @if($errors->userDeletion->has('password'))
                    <div class="settings-error">{{ $errors->userDeletion->first('password') }}</div>
                @endif
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" class="settings-button secondary" x-on:click="$dispatch('close')">Cancel</button>
                <button type="submit" class="settings-button danger">Delete Account</button>
            </div>
        </form>
    </x-modal>
@endsection
