@php($title = 'Profile')

@extends('layouts.ms')

@section('content')
    <style>
        .profile-shell {
            max-width: 1320px;
            margin: 0 auto;
            padding: 10px 14px 28px;
            font-family: Arial, sans-serif;
            color: #111827;
        }

        .profile-topbar {
            display: grid;
            grid-template-columns: auto minmax(0, 1fr) auto;
            gap: 18px;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-menu {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            border: 1px solid #d8dbe3;
            background: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05);
        }

        .profile-search {
            position: relative;
            max-width: 520px;
        }

        .profile-search svg {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: #6b7280;
        }

        .profile-search input {
            width: 100%;
            height: 46px;
            padding: 0 42px 0 18px;
            border: 1px solid #e5e7eb;
            border-radius: 999px;
            background: linear-gradient(180deg, #f6f1fb 0%, #f8f5fc 100%);
            color: #475569;
            font-size: 14px;
            outline: none;
        }

        .profile-search input:focus {
            border-color: #c4b5fd;
            box-shadow: 0 0 0 3px rgba(196, 181, 253, 0.22);
        }

        .profile-avatar-chip {
            width: 52px;
            height: 52px;
            border-radius: 18px;
            background: #f3f4f6;
            border: 1px solid #d8dbe3;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #475569;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 270px minmax(0, 1fr) 170px;
            gap: 20px;
        }

        .profile-panel {
            border-radius: 24px;
            background: #f3f4f6;
            padding: 18px;
        }

        .profile-card {
            overflow: hidden;
        }

        .profile-cover {
            height: 198px;
            border-radius: 18px;
            background: linear-gradient(180deg, #7c7474 0%, #6c6666 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f8fafc;
        }

        .profile-cover svg {
            width: 78px;
            height: 78px;
        }

        .profile-user {
            margin-top: 14px;
            font-size: 13px;
            line-height: 1.6;
            color: #374151;
        }

        .profile-user strong {
            display: block;
            font-size: 18px;
            color: #111827;
        }

        .profile-edit-trigger {
            margin-top: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 38px;
            padding: 0 14px;
            border: 0;
            border-radius: 999px;
            background: #111827;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .profile-edit-trigger:hover {
            background: #1f2937;
        }

        .profile-socials {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: 18px;
            margin-bottom: 14px;
            color: #1f2937;
        }

        .profile-socials a {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            background: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: inherit;
            text-decoration: none;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.08);
        }

        .profile-socials svg {
            width: 30px;
            height: 30px;
        }

        .profile-nav {
            display: grid;
            gap: 12px;
            margin-top: 10px;
        }

        .profile-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 14px;
            text-decoration: none;
            color: #374151;
            font-size: 13px;
            font-weight: 600;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .profile-link.is-active,
        .profile-link:hover {
            background: #ffffff;
            color: #111827;
        }

        .profile-link svg {
            width: 18px;
            height: 18px;
        }

        .profile-status {
            margin-top: 12px;
            padding: 10px 12px;
            border-radius: 12px;
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
            font-weight: 700;
        }

        .profile-main {
            border-radius: 24px;
            background: #ffffff;
            padding: 18px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        }

        .profile-section + .profile-section {
            margin-top: 26px;
        }

        .profile-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 18px;
        }

        .profile-section-title {
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #4b5563;
        }

        .profile-share {
            color: #374151;
            width: 18px;
            height: 18px;
        }

        .genre-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px 28px;
        }

        .genre-item {
            display: grid;
            grid-template-columns: 88px minmax(0, 1fr);
            gap: 14px;
            align-items: center;
        }

        .genre-name {
            font-size: 13px;
            color: #111827;
        }

        .genre-track {
            height: 3px;
            border-radius: 999px;
            background: #ede9fe;
            overflow: hidden;
        }

        .genre-fill {
            height: 100%;
            border-radius: 999px;
            background: #4c1d95;
        }

        .watched-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px 20px;
        }

        .watched-card {
            text-decoration: none;
            color: inherit;
        }

        .watched-thumb {
            height: 114px;
            border-radius: 18px;
            overflow: hidden;
            background: #e5e7eb;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.08);
        }

        .watched-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .watched-title {
            margin-top: 10px;
            font-size: 12px;
            text-align: center;
            color: #1f2937;
        }

        .profile-reco-title {
            margin-bottom: 14px;
            text-align: center;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #4b5563;
        }

        .profile-reco-list {
            display: grid;
            gap: 18px;
        }

        .profile-reco-card {
            text-decoration: none;
            color: inherit;
        }

        .profile-reco-thumb {
            height: 98px;
            border-radius: 16px;
            overflow: hidden;
            background: #e5e7eb;
        }

        .profile-reco-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .profile-reco-name {
            margin-top: 8px;
            font-size: 12px;
            text-align: center;
            color: #111827;
        }

        .profile-modal-copy {
            margin: 10px 0 0;
            color: #6b7280;
            line-height: 1.6;
        }

        .profile-form-row {
            margin-top: 16px;
        }

        .profile-form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 700;
            color: #374151;
        }

        .profile-form-input {
            width: 100%;
            height: 44px;
            padding: 0 14px;
            border: 1px solid #d1d5db;
            border-radius: 14px;
            background: #f8fafc;
            color: #111827;
            outline: none;
        }

        .profile-form-input:focus {
            border-color: #93c5fd;
            box-shadow: 0 0 0 3px rgba(147, 197, 253, 0.25);
        }

        .profile-form-error {
            margin-top: 8px;
            color: #b91c1c;
            font-size: 12px;
            font-weight: 700;
        }

        .profile-modal-actions {
            margin-top: 22px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .profile-modal-button {
            height: 40px;
            padding: 0 16px;
            border: 0;
            border-radius: 999px;
            font-weight: 700;
            cursor: pointer;
        }

        .profile-modal-button.secondary {
            background: #e5e7eb;
            color: #111827;
        }

        .profile-modal-button.primary {
            background: #111827;
            color: #ffffff;
        }

        @media (max-width: 1100px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }

            .profile-topbar {
                grid-template-columns: auto minmax(0, 1fr);
            }

            .profile-avatar-chip {
                display: none;
            }

            .watched-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 760px) {
            .profile-topbar {
                grid-template-columns: 1fr;
            }

            .profile-search {
                max-width: none;
            }

            .genre-grid,
            .watched-grid {
                grid-template-columns: 1fr;
            }

            .genre-item {
                grid-template-columns: 1fr;
                gap: 10px;
            }
        }
    </style>

    <div class="profile-shell">
        <div class="profile-topbar">
            <button type="button" class="profile-menu" aria-label="Open menu">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M4 7h16"></path>
                    <path d="M4 12h16"></path>
                    <path d="M4 17h16"></path>
                </svg>
            </button>

            <label class="profile-search" for="profile-search">
                <input id="profile-search" type="text" placeholder="Hinted search text">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="M21 21l-4.3-4.3"></path>
                </svg>
            </label>

            <div class="profile-avatar-chip" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M20 21a8 8 0 0 0-16 0"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>
        </div>

        <div class="profile-grid">
            <aside class="profile-panel profile-card">
                <div class="profile-cover">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M20 21a8 8 0 0 0-16 0"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>

                <div class="profile-user">
                    <strong>{{ auth()->user()->name }}</strong><br>
                    {{ auth()->user()->email }}

                    @if (session('status') === 'profile-updated')
                        <div class="profile-status">Profile name updated successfully.</div>
                    @endif
                </div>

                <button
                    type="button"
                    class="profile-edit-trigger"
                    x-data
                    x-on:click="$dispatch('open-modal', 'edit-user-name')"
                >
                    Edit User
                </button>

                <div class="profile-socials">
                    <a href="{{ $socialLinks[0]['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $socialLinks[0]['label'] }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9">
                            <path d="M15 3h4v4"></path>
                            <path d="M14 10h5"></path>
                            <path d="M14 21v-7a4 4 0 0 1 4-4"></path>
                            <path d="M9 21V12H6"></path>
                        </svg>
                    </a>
                    <a href="{{ $socialLinks[1]['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $socialLinks[1]['label'] }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9">
                            <rect x="3" y="3" width="18" height="18" rx="5"></rect>
                            <circle cx="12" cy="12" r="4"></circle>
                            <circle cx="17.5" cy="6.5" r="1"></circle>
                        </svg>
                    </a>
                    <a href="{{ $socialLinks[2]['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $socialLinks[2]['label'] }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <path d="M3.3 7l8.7 5 8.7-5"></path>
                            <path d="M12 22V12"></path>
                        </svg>
                    </a>
                </div>

                <nav class="profile-nav">
                    <a href="{{ route('dashboard') }}" class="profile-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M12 3l9 7-1.5 11h-15L3 10l9-7z"></path>
                        </svg>
                        Dashboard
                    </a>
                    <a href="#" class="profile-link">Ratings</a>
                    <a href="#" class="profile-link">List</a>
                    <a href="#" class="profile-link">Watchlist</a>
                    <a href="#" class="profile-link">Checkins</a>
                    <a href="{{ route('me.reviews') }}" class="profile-link {{ request()->routeIs('me.reviews') ? 'is-active' : '' }}">Review</a>
                    <a href="{{ route('me.settings') }}" class="profile-link {{ request()->routeIs('me.settings') ? 'is-active' : '' }}">Profile Settings</a>
                </nav>
            </aside>

            <section class="profile-main">
                <div class="profile-section">
                    <div class="profile-section-header">
                        <div class="profile-section-title">Top-Rated Genre</div>
                        <svg class="profile-share" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="18" cy="5" r="2"></circle>
                            <circle cx="6" cy="12" r="2"></circle>
                            <circle cx="18" cy="19" r="2"></circle>
                            <path d="M8 12l8-6"></path>
                            <path d="M8 12l8 6"></path>
                        </svg>
                    </div>

                    <div class="genre-grid">
                        @foreach($genreBars as $genre)
                            <div class="genre-item">
                                <div class="genre-name">{{ $genre['name'] }}</div>
                                <div class="genre-track">
                                    <div class="genre-fill" style="width: {{ $genre['width'] }};"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="profile-section">
                    <div class="profile-section-header">
                        <div class="profile-section-title">Watched Movies</div>
                        <svg class="profile-share" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="18" cy="5" r="2"></circle>
                            <circle cx="6" cy="12" r="2"></circle>
                            <circle cx="18" cy="19" r="2"></circle>
                            <path d="M8 12l8-6"></path>
                            <path d="M8 12l8 6"></path>
                        </svg>
                    </div>

                    <div class="watched-grid">
                        @foreach($watchedMovies as $movie)
                            <a href="{{ route('movies.show', $movie['id']) }}" class="watched-card">
                                <div class="watched-thumb">
                                    <img src="{{ $movie['image'] }}" alt="{{ $movie['title'] }}">
                                </div>
                                <div class="watched-title">{{ $movie['title'] }}</div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>

            <aside class="profile-panel">
                <div class="profile-reco-title">Recommended</div>

                <div class="profile-reco-list">
                    @foreach($recommendedMovies as $movie)
                        <a href="{{ route('movies.show', $movie['id']) }}" class="profile-reco-card">
                            <div class="profile-reco-thumb">
                                <img src="{{ $movie['image'] }}" alt="{{ $movie['title'] }}">
                            </div>
                            <div class="profile-reco-name">{{ $movie['title'] }}</div>
                        </a>
                    @endforeach
                </div>
            </aside>
        </div>
    </div>

    <x-modal name="edit-user-name" :show="$errors->has('name')" focusable>
        <form method="post" action="{{ route('profile.update') }}" class="p-6">
            @csrf
            @method('patch')

            <h2 class="text-lg font-medium text-gray-900">Edit User</h2>
            <p class="profile-modal-copy">Update your display name for your Movie Square profile.</p>

            <div class="profile-form-row">
                <label class="profile-form-label" for="profile-name">Name</label>
                <input
                    id="profile-name"
                    name="name"
                    type="text"
                    class="profile-form-input"
                    value="{{ old('name', auth()->user()->name) }}"
                    required
                >

                @if($errors->has('name'))
                    <div class="profile-form-error">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <input type="hidden" name="email" value="{{ auth()->user()->email }}">

            <div class="profile-modal-actions">
                <button type="button" class="profile-modal-button secondary" x-on:click="$dispatch('close')">Cancel</button>
                <button type="submit" class="profile-modal-button primary">Save</button>
            </div>
        </form>
    </x-modal>
@endsection
