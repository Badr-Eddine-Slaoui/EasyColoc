<!DOCTYPE html>

<html class="dark" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', config('app.name', 'EasyColoc'))</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#c72929",
                        "gold": "#D4AF37",
                        "background-light": "#f8f6f6",
                        "background-dark": "#201212",
                        "navy": "#0a192f",
                        "sand": "#f4ede4",
                        "crimson": "#C62828",
                        "navy-dark": "#0a111a",
                        "navy-deep": "#0a1128",
                        "accent-gold": "#fbbf24",
                        "neutral-800": "#2d1b14",
                        "neutral-900": "#1a0f0a",
                        "parchment": "#fdf8e1",
                        "nautical-gold": "#b8860b",
                        "card-dark": "#1c2536",
                        "border-dark": "#2d3a4f",
                        "admin-primary": "#FFD700",
                        "navy": "#001f3f",
                        "danger": "#c72929",
                        "marine-navy": "#1a2a44",
                        "surface-dark": "#2d1a1a",
                        "border-dark": "#432828",
                        "accent": "#d4af37",
                    },
                    fontFamily: {
                        "display": ["Spline Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .parchment-texture {
            background-color: #2a1a1a;
            background-image: radial-gradient(#3a2a2a 1px, transparent 1px);
            background-size: 20px 20px;
        }

        .hero-gradient {
            background: linear-gradient(180deg, rgba(32, 18, 18, 0.6) 0%, rgba(32, 18, 18, 1) 100%);
        }
        .nautical-gradient {
            background: linear-gradient(135deg, #121a20 0%, #1c2e3a 100%);
        }
        .modal-overlay {
            background-color: rgba(15, 10, 10, 0.85);
            backdrop-filter: blur(8px);
        }
        .invitation-parchment-texture {
            background-color: #fdf8e1;
            background-image: linear-gradient(135deg, rgba(184, 134, 11, 0.05) 25%, transparent 25%),
                linear-gradient(225deg, rgba(184, 134, 11, 0.05) 25%, transparent 25%),
                linear-gradient(45deg, rgba(184, 134, 11, 0.05) 25%, transparent 25%),
                linear-gradient(315deg, rgba(184, 134, 11, 0.05) 25%, transparent 25%);
            background-position: 10px 0, 10px 0, 0 0, 0 0;
            background-size: 20px 20px;
            background-repeat: repeat;
        }

        .glow-button {
            box-shadow: 0 0 15px rgba(184, 134, 11, 0.4);
            transition: all 0.3s ease;
        }

        .glow-button:hover {
            box-shadow: 0 0 25px rgba(184, 134, 11, 0.6);
            transform: translateY(-2px);
        }
    </style>
</head>

<body
    class="font-display bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 selection:bg-primary selection:text-white">
    @include('partials.header')
    @yield('content')
    @yield('modals')
    @include('partials.flash-message')
    @include('partials.footer')
</body>

</html>
