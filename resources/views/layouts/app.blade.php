<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Simpatik Tailor') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
        
        <!-- Icons -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#F7F3EC] text-gray-800 relative">
        
        {{-- High-End Animated Background: Spotlight Beams & Twinkling Sparkles --}}
        <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
            
            {{-- Spotlight Beam 1 (Left Corner Sorot) --}}
            <div class="absolute -top-20 -left-20 w-[600px] h-[800px] bg-gradient-to-br from-[#C5A059]/25 via-[#7A4B2A]/10 to-transparent blur-2xl transform origin-top-left animate-beam"></div>

            {{-- Spotlight Beam 2 (Right Corner Sorot) --}}
            <div class="absolute -top-20 -right-20 w-[600px] h-[800px] bg-gradient-to-bl from-[#E6C987]/25 via-[#9C6A43]/10 to-transparent blur-2xl transform origin-top-right animate-beam" style="animation-delay: -5s;"></div>

            {{-- Soft Glow Orbs --}}
            <div class="absolute top-1/3 left-1/2 -translate-x-1/2 w-[500px] h-[500px] rounded-full bg-gradient-to-tr from-[#C5A059]/15 via-krem/30 to-transparent blur-3xl animate-orb-1"></div>
            <div class="absolute -bottom-32 left-1/4 w-[450px] h-[450px] rounded-full bg-gradient-to-tl from-[#7A4B2A]/15 via-transparent to-transparent blur-3xl animate-orb-2"></div>

            {{-- Subtle Grid Overlay --}}
            <div class="absolute inset-0 bg-[radial-gradient(#7A4B2A_1px,transparent_1px)] [background-size:28px_28px] opacity-15"></div>

            {{-- Blink-Blink Sparkle Stars (Bintang Kerlap-Kerlip) --}}
            <div class="absolute top-16 left-20 text-[#C5A059] animate-sparkle-1">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 0L14.59 9.41L24 12L14.59 14.59L12 24L9.41 14.59L0 12L9.41 9.41L12 0Z"/></svg>
            </div>

            <div class="absolute top-36 right-32 text-[#E6C987] animate-sparkle-2">
                <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24"><path d="M12 0L14.59 9.41L24 12L14.59 14.59L12 24L9.41 14.59L0 12L9.41 9.41L12 0Z"/></svg>
            </div>

            <div class="absolute top-2/3 left-16 text-[#C5A059] animate-sparkle-3">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 0L14.59 9.41L24 12L14.59 14.59L12 24L9.41 14.59L0 12L9.41 9.41L12 0Z"/></svg>
            </div>

            <div class="absolute top-1/2 right-20 text-[#C5A059] animate-sparkle-4">
                <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24"><path d="M12 0L14.59 9.41L24 12L14.59 14.59L12 24L9.41 14.59L0 12L9.41 9.41L12 0Z"/></svg>
            </div>

            <div class="absolute bottom-24 left-1/3 text-[#E6C987] animate-sparkle-2">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 0L14.59 9.41L24 12L14.59 14.59L12 24L9.41 14.59L0 12L9.41 9.41L12 0Z"/></svg>
            </div>

            <div class="absolute bottom-16 right-1/4 text-[#C5A059] animate-sparkle-1">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 0L14.59 9.41L24 12L14.59 14.59L12 24L9.41 14.59L0 12L9.41 9.41L12 0Z"/></svg>
            </div>

        </div>

        <div class="min-h-screen relative z-10">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/80 backdrop-blur-md border-b border-krem-dark/30 shadow-2xs">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('scripts')
    </body>
</html>
