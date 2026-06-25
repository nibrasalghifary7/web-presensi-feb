<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <title>M-PRESENCE FEB — UIN Syarif Hidayatullah Jakarta</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --navy-900: #0a1628;
            --navy-800: #001149;
            --navy-700: #0c1a3d;
            --blue-600: #25429f;
            --blue-500: #3d8ade;
            --blue-400: #5a9ee6;
            --blue-300: #93c5fd;
            --slate-400: #94a3b8;
            --slate-500: #64748b;
            --white-10: rgba(255, 255, 255, 0.1);
            --white-06: rgba(255, 255, 255, 0.06);
            --radius: 16px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--navy-900);
            color: #fff;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ===== NOISE TEXTURE OVERLAY ===== */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            opacity: 0.03;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
        }

        /* ===== BACKGROUND LAYERS ===== */
        .bg-layer {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }

        .bg-layer::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -20%;
            width: 800px;
            height: 800px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(37, 66, 159, 0.25) 0%, transparent 70%);
            filter: blur(80px);
        }

        .bg-layer::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -15%;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(61, 138, 222, 0.15) 0%, transparent 70%);
            filter: blur(60px);
        }

        .bg-img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.08;
        }

        /* ===== GRID PATTERN ===== */
        .grid-pattern {
            position: fixed;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse 60% 50% at 50% 50%, black 20%, transparent 100%);
            -webkit-mask-image: radial-gradient(ellipse 60% 50% at 50% 50%, black 20%, transparent 100%);
        }

        /* ===== NAVBAR ===== */
        .nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 200;
            padding: 0 48px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(10, 22, 40, 0.6);
            backdrop-filter: blur(20px) saturate(1.5);
            -webkit-backdrop-filter: blur(20px) saturate(1.5);
            border-bottom: 1px solid var(--white-06);
            transition: 0.3s;
        }

        .nav.scrolled {
            background: rgba(10, 22, 40, 0.92);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-logo {
            width: auto;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-title {
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 1.5px;
            color: #fff;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-links a {
            color: var(--slate-400);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 8px;
            transition: 0.2s;
        }

        .nav-links a:hover {
            color: #fff;
            background: var(--white-06);
        }

        .nav-cta {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-login {
            padding: 9px 20px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            color: #fff;
            background: linear-gradient(135deg, var(--blue-600), var(--blue-500));
            box-shadow: 0 2px 16px rgba(37, 66, 159, 0.35);
            transition: 0.25s;
            letter-spacing: 0.3px;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 24px rgba(37, 66, 159, 0.5);
        }

        .nav-hamburger {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            padding: 8px;
        }

        /* ===== HERO ===== */
        .hero {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 120px 48px 80px;
        }

        .hero-wrap {
            max-width: 1280px;
            margin: 0 auto;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        .hero-text {
            max-width: 560px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px 6px 8px;
            background: var(--white-06);
            border: 1px solid var(--white-10);
            border-radius: 100px;
            font-size: 12px;
            font-weight: 600;
            color: var(--blue-300);
            margin-bottom: 28px;
        }

        .hero-badge .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 8px rgba(34, 197, 94, 0.5);
            animation: pulse-dot 2s ease-in-out infinite;
        }

        @keyframes pulse-dot {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .hero-text h1 {
            font-size: 54px;
            font-weight: 800;
            line-height: 1.08;
            letter-spacing: -1.5px;
            margin-bottom: 20px;
        }

        .hero-text h1 .gradient-text {
            background: linear-gradient(135deg, var(--blue-400), var(--blue-300));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-text .desc {
            font-size: 16px;
            font-weight: 500;
            line-height: 1.7;
            color: var(--slate-400);
            margin-bottom: 36px;
            max-width: 460px;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            color: #fff;
            background: linear-gradient(135deg, var(--blue-600), var(--blue-500));
            box-shadow: 0 4px 24px rgba(37, 66, 159, 0.4);
            transition: 0.25s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(37, 66, 159, 0.5);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            color: var(--slate-400);
            border: 1px solid var(--white-10);
            background: transparent;
            transition: 0.25s;
        }

        .btn-ghost:hover {
            color: #fff;
            border-color: rgba(255, 255, 255, 0.25);
            background: var(--white-06);
        }

        /* hero right */
        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .deko-wrapper {
            position: relative;
            width: 100%;
            max-width: 520px;
            height: 480px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .deko-glow {
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(37, 66, 159, 0.4) 0%, rgba(61, 138, 222, 0.2) 40%, transparent 70%);
            filter: blur(50px);
            z-index: 0;
            animation: glow-pulse 4s ease-in-out infinite;
        }

        .deko-glow-2 {
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(90, 158, 230, 0.25) 0%, transparent 70%);
            filter: blur(35px);
            z-index: 0;
            top: 10%;
            right: 5%;
            animation: glow-pulse 4s ease-in-out infinite 2s;
        }

        @keyframes glow-pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.7;
                transform: scale(1.08);
            }
        }

        .deko-ring {
            position: absolute;
            width: 460px;
            height: 460px;
            border-radius: 50%;
            border: 1px solid rgba(61, 138, 222, 0.12);
            z-index: 1;
            animation: ring-spin 20s linear infinite;
        }

        .deko-ring::before {
            content: '';
            position: absolute;
            top: -5px;
            left: 50%;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--blue-400);
            box-shadow: 0 0 16px rgba(61, 138, 222, 0.7);
        }

        .deko-ring-2 {
            position: absolute;
            width: 540px;
            height: 540px;
            border-radius: 50%;
            border: 1px dashed rgba(61, 138, 222, 0.07);
            z-index: 1;
            animation: ring-spin 30s linear infinite reverse;
        }

        @keyframes ring-spin {
            to {
                transform: rotate(360deg);
            }
        }

        .deko-image {
            position: relative;
            z-index: 2;
            width: 380px;
            height: auto;
            object-fit: contain;
            filter: drop-shadow(0 12px 50px rgba(61, 138, 222, 0.3));
            animation: deko-float 5s ease-in-out infinite;
        }

        @keyframes deko-float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        /* floating badges */
        .float-badge {
            position: absolute;
            padding: 12px 18px;
            background: rgba(0, 17, 73, 0.7);
            border: 1px solid var(--white-10);
            border-radius: 14px;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 12px;
            font-weight: 600;
            color: #fff;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
            z-index: 10;
        }

        .float-badge.top-right {
            top: 10%;
            right: -10px;
            animation: float-br 5s ease-in-out infinite;
        }

        .float-badge.bottom-left {
            bottom: 15%;
            left: -10px;
            animation: float-bl 5s ease-in-out infinite 2.5s;
        }

        .float-badge.mid-right {
            top: 55%;
            right: -20px;
            animation: float-br 6s ease-in-out infinite 1s;
        }

        .float-badge .fb-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        @keyframes float-br {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(4px, -8px);
            }
        }

        @keyframes float-bl {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(-4px, -10px);
            }
        }

        /* ===== SECTION DIVIDER ===== */
        .section-divider {
            position: relative;
            z-index: 10;
            height: 1px;
            max-width: 1280px;
            margin: 0 auto;
            background: linear-gradient(90deg, transparent, var(--white-10), transparent);
        }

        /* ===== FITUR ===== */
        .fitur {
            position: relative;
            z-index: 10;
            padding: 100px 48px;
            max-width: 1280px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 64px;
        }

        .section-tag {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--blue-400);
            background: rgba(61, 138, 222, 0.1);
            border: 1px solid rgba(61, 138, 222, 0.15);
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 40px;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 16px;
        }

        .section-header p {
            font-size: 16px;
            font-weight: 500;
            color: var(--slate-400);
            max-width: 480px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .fitur-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .fitur-card {
            padding: 32px 28px;
            background: rgba(0, 17, 73, 0.35);
            border: 1px solid var(--white-06);
            border-radius: var(--radius);
            transition: 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .fitur-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--blue-500), transparent);
            opacity: 0;
            transition: 0.35s;
        }

        .fitur-card:hover {
            transform: translateY(-4px);
            border-color: rgba(61, 138, 222, 0.2);
            background: rgba(0, 17, 73, 0.5);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.2);
        }

        .fitur-card:hover::before {
            opacity: 1;
        }

        .fitur-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 22px;
        }

        .fi-blue {
            background: linear-gradient(135deg, rgba(37, 66, 159, 0.3), rgba(61, 138, 222, 0.3));
            color: var(--blue-400);
        }

        .fi-green {
            background: linear-gradient(135deg, rgba(16, 94, 50, 0.3), rgba(34, 197, 94, 0.3));
            color: #4ade80;
        }

        .fi-purple {
            background: linear-gradient(135deg, rgba(80, 30, 160, 0.3), rgba(168, 85, 247, 0.3));
            color: #c084fc;
        }

        .fi-amber {
            background: linear-gradient(135deg, rgba(120, 60, 10, 0.3), rgba(245, 158, 11, 0.3));
            color: #fbbf24;
        }

        .fi-red {
            background: linear-gradient(135deg, rgba(120, 25, 25, 0.3), rgba(239, 68, 68, 0.3));
            color: #f87171;
        }

        .fi-cyan {
            background: linear-gradient(135deg, rgba(10, 80, 110, 0.3), rgba(6, 182, 212, 0.3));
            color: #22d3ee;
        }

        .fitur-card h3 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.3px;
        }

        .fitur-card p {
            font-size: 13px;
            font-weight: 500;
            color: var(--slate-400);
            line-height: 1.7;
        }

        /* ===== CARA KERJA ===== */
        .cara-kerja {
            position: relative;
            z-index: 10;
            padding: 100px 48px;
            max-width: 1280px;
            margin: 0 auto;
        }

        .steps {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            position: relative;
        }

        .steps::before {
            content: '';
            position: absolute;
            top: 40px;
            left: 12.5%;
            right: 12.5%;
            height: 2px;
            background: linear-gradient(90deg, var(--blue-600), var(--blue-500), var(--blue-400));
            opacity: 0.3;
        }

        .step {
            text-align: center;
            position: relative;
        }

        .step-num {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--blue-600), var(--blue-500));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 800;
            color: #fff;
            margin: 0 auto 20px;
            box-shadow: 0 4px 20px rgba(37, 66, 159, 0.4);
            position: relative;
            z-index: 2;
        }

        .step h4 {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .step p {
            font-size: 12px;
            font-weight: 500;
            color: var(--slate-400);
            line-height: 1.6;
            max-width: 200px;
            margin: 0 auto;
        }

        /* ===== CTA ===== */
        .cta {
            position: relative;
            z-index: 10;
            padding: 100px 48px;
        }

        .cta-box {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
            padding: 64px 48px;
            background: linear-gradient(135deg, rgba(0, 17, 73, 0.6), rgba(37, 66, 159, 0.2));
            border: 1px solid rgba(61, 138, 222, 0.15);
            border-radius: 24px;
            position: relative;
            overflow: hidden;
        }

        .cta-box::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 30%, rgba(61, 138, 222, 0.08) 0%, transparent 50%);
            pointer-events: none;
        }

        .cta-box h2 {
            font-size: 36px;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 16px;
            position: relative;
        }

        .cta-box p {
            font-size: 15px;
            font-weight: 500;
            color: var(--slate-400);
            margin-bottom: 32px;
            max-width: 440px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.7;
            position: relative;
        }

        .cta-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            position: relative;
        }

        /* ===== FOOTER ===== */
        .footer {
            position: relative;
            z-index: 10;
            padding: 32px 48px;
            border-top: 1px solid var(--white-06);
        }

        .footer-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .footer-logo {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--blue-600), var(--blue-500));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 900;
        }

        .footer-left span {
            font-size: 13px;
            font-weight: 700;
            color: var(--slate-400);
        }

        .footer-right {
            font-size: 12px;
            font-weight: 500;
            color: var(--slate-500);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .nav {
                padding: 0 28px;
            }

            .hero {
                padding: 100px 28px 60px;
            }

            .hero-wrap {
                grid-template-columns: 1fr;
                gap: 48px;
            }

            .hero-text {
                max-width: 100%;
                text-align: center;
            }

            .hero-text .desc {
                margin: 0 auto 36px;
            }

            .hero-actions {
                justify-content: center;
            }

            .hero-visual {
                order: -1;
            }

            .deko-wrapper {
                max-width: 400px;
                height: 380px;
            }

            .deko-image {
                width: 300px;
            }

            .deko-ring {
                width: 360px;
                height: 360px;
            }

            .deko-ring-2 {
                width: 420px;
                height: 420px;
            }

            .deko-glow {
                width: 320px;
                height: 320px;
            }

            .hero-text h1 {
                font-size: 42px;
            }

            .fitur,
            .cara-kerja,
            .cta {
                padding: 80px 28px;
            }

            .fitur-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .steps {
                grid-template-columns: repeat(2, 1fr);
                gap: 32px;
            }

            .steps::before {
                display: none;
            }

            .float-badge.mid-right {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .nav {
                padding: 0 20px;
                height: 64px;
            }

            .nav-links,
            .nav-cta {
                display: none;
            }

            .nav-hamburger {
                display: block;
            }

            .hero {
                padding: 90px 20px 50px;
            }

            .hero-text h1 {
                font-size: 34px;
                letter-spacing: -1px;
            }

            .hero-actions {
                flex-direction: column;
                width: 100%;
            }

            .btn-primary,
            .btn-ghost {
                width: 100%;
                justify-content: center;
            }

            .deko-wrapper {
                max-width: 320px;
                height: 300px;
            }

            .deko-image {
                width: 240px;
            }

            .deko-ring {
                width: 280px;
                height: 280px;
            }

            .deko-ring-2 {
                width: 340px;
                height: 340px;
            }

            .deko-glow {
                width: 240px;
                height: 240px;
            }

            .float-badge {
                display: none;
            }

            .fitur,
            .cara-kerja,
            .cta {
                padding: 60px 20px;
            }

            .section-header h2 {
                font-size: 30px;
            }

            .fitur-grid {
                grid-template-columns: 1fr;
            }

            .steps {
                grid-template-columns: 1fr;
            }

            .cta-box {
                padding: 48px 24px;
            }

            .cta-box h2 {
                font-size: 28px;
            }

            .cta-actions {
                flex-direction: column;
            }

            .footer {
                padding: 24px 20px;
            }

            .footer-inner {
                flex-direction: column;
                gap: 12px;
                text-align: center;
            }
        }

        @media (max-width: 450px) {
            .hero-text h1 {
                font-size: 28px;
            }

            .deko-image {
                width: 150px;
            }
        }
    </style>
</head>

<body>

    <!-- Background layers -->
    <div class="bg-layer">
        <img class="bg-img" alt="" src="<?php echo e(asset('mansy-graphics-V1NQ60y4UK0-unsplash.jpg')); ?>">
    </div>
    <div class="grid-pattern"></div>

    <!-- Navbar -->
    <nav class="nav" id="navbar">
        <div class="nav-left">
            <img class="nav-logo" alt="Logo"
                src="<?php echo e(asset('005d5b9dc825d74b4f47a1a022a7913f-removebg-preview-1@2x.png')); ?>">
            <span class="nav-title">M-PRESENCE</span>
        </div>
        <div class="nav-links">
            <a href="#beranda">Beranda</a>
            <a href="#fitur">Fitur</a>
            <a href="#cara-kerja">Cara Kerja</a>
        </div>
        <div class="nav-cta">
            <a href="<?php echo e(route('login')); ?>" class="btn-login"><i class="fas fa-right-to-bracket"></i> Masuk</a>
        </div>
        <button class="nav-hamburger" onclick="toggleMobile()"><i class="fas fa-bars"></i></button>
    </nav>

    <!-- Hero -->
    <section class="hero" id="beranda">
        <div class="hero-wrap">
            <div class="hero-text">
                <h1>Kelola Absensi<br>Kelas Jadi<br><span class="gradient-text">Lebih Mudah</span></h1>
                <p class="desc">Platform manajemen kehadiran mahasiswa berbasis web untuk UIN Syarif Hidayatullah
                    Jakarta. Pantau, kelola, dan rekap absensi dalam satu tempat.</p>
                <div class="hero-actions">
                    <a href="<?php echo e(route('login')); ?>" class="btn-primary"><i class="fas fa-right-to-bracket"></i> Masuk
                        Aplikasi</a>
                    <a href="<?php echo e(route('register-mahasiswa')); ?>" class="btn-ghost"><i class="fas fa-user-plus"></i> Buat
                        Akun</a>
                </div>
            </div>

            <div class="hero-visual">
                <!-- Floating badges -->
                <div class="float-badge top-right">
                    <div class="fb-icon" style="background:rgba(34,197,94,0.15);color:#4ade80;"><i
                            class="fas fa-check"></i></div>
                    Absensi tercatat
                </div>
                <div class="float-badge bottom-left">
                    <div class="fb-icon" style="background:rgba(61,138,222,0.15);color:var(--blue-400);"><i
                            class="fas fa-bell"></i></div>
                    Jadwal hari ini
                </div>
                <div class="float-badge mid-right">
                    <div class="fb-icon" style="background:rgba(245,158,11,0.15);color:#fbbf24;"><i
                            class="fas fa-star"></i></div>
                    92% kehadiran
                </div>

                <!-- Deko image + glow -->
                <div class="deko-wrapper">
                    <div class="deko-glow"></div>
                    <div class="deko-glow-2"></div>
                    <div class="deko-ring"></div>
                    <div class="deko-ring-2"></div>
                    <img class="deko-image" alt="M-Presence" src="<?php echo e(asset('images/hero.png')); ?>">
                </div>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- Fitur -->
    <section class="fitur" id="fitur">
        <div class="section-header">
            <div class="section-tag">Fitur</div>
            <h2>Semua yang Kamu Butuhkan</h2>
            <p>Dirancang khusus untuk kebutuhan absensi kelas di lingkungan kampus.</p>
        </div>
        <div class="fitur-grid">
            <div class="fitur-card">
                <div class="fitur-icon fi-blue"><i class="fas fa-fingerprint"></i></div>
                <h3>Absensi Multi-Metode</h3>
                <p>Absen lewat PIN 6 digit, password, atau sensor biometrik. Fleksibel sesuai perangkat yang tersedia.
                </p>
            </div>
            <div class="fitur-card">
                <div class="fitur-icon fi-green"><i class="fas fa-calendar-days"></i></div>
                <h3>Jadwal Terintegrasi</h3>
                <p>Jadwal mata kuliah otomatis terhubung dengan dosen dan kelas. Atur sekali, berlaku selamanya.</p>
            </div>
            <div class="fitur-card">
                <div class="fitur-icon fi-purple"><i class="fas fa-file-arrow-up"></i></div>
                <h3>Pengajuan Izin Digital</h3>
                <p>Ajukan izin atau sakit langsung dari dashboard. Upload bukti surat dalam format PDF atau Word.</p>
            </div>
            <div class="fitur-card">
                <div class="fitur-icon fi-amber"><i class="fas fa-users-gear"></i></div>
                <h3>Multi-Role Akses</h3>
                <p>Admin kelola data, Dosen pantau kehadiran, Mahasiswa catat absensi. Semua punya dashboard sendiri.
                </p>
            </div>
            <div class="fitur-card">
                <div class="fitur-icon fi-red"><i class="fas fa-shield-halved"></i></div>
                <h3>Keamanan Berlapis</h3>
                <p>Password terenkripsi bcrypt, lock akun setelah 5x gagal, dan session protection aktif.</p>
            </div>
            <div class="fitur-card">
                <div class="fitur-icon fi-cyan"><i class="fas fa-chart-pie"></i></div>
                <h3>Rekap & Laporan</h3>
                <p>Persentase kehadiran per mahasiswa, rekap per kelas, dan laporan bulanan yang bisa di-export.</p>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- Cara Kerja -->
    <section class="cara-kerja" id="cara-kerja">
        <div class="section-header">
            <div class="section-tag">Alur Kerja</div>
            <h2>Mulai dalam 4 Langkah</h2>
            <p>Prosesnya simpel — dari daftar sampai absen cuma butuh beberapa menit.</p>
        </div>
        <div class="steps">
            <div class="step">
                <div class="step-num">1</div>
                <h4>Daftar Akun</h4>
                <p>Buat akun dengan NIM dan email akademik kamu.</p>
            </div>
            <div class="step">
                <div class="step-num">2</div>
                <h4>Login ke Portal</h4>
                <p>Masuk pakai NIM, email, atau PIN yang sudah dibuat.</p>
            </div>
            <div class="step">
                <div class="step-num">3</div>
                <h4>Pilih Jadwal</h4>
                <p>Lihat mata kuliah hari ini dan pilih jadwal yang aktif.</p>
            </div>
            <div class="step">
                <div class="step-num">4</div>
                <h4>Catat Kehadiran</h4>
                <p>Klik absen, dan kehadiranmu langsung tercatat di sistem.</p>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- CTA -->
    <section class="cta">
        <div class="cta-box">
            <h2>Siap Mulai?</h2>
            <p>Bergabung bersama ribuan mahasiswa dan dosen yang sudah menggunakan M-Presence FEB.</p>
            <div class="cta-actions">
                <a href="<?php echo e(route('register-mahasiswa')); ?>" class="btn-primary"><i class="fas fa-user-plus"></i>
                    Daftar Sekarang</a>
                <a href="<?php echo e(route('login')); ?>" class="btn-ghost"><i class="fas fa-right-to-bracket"></i> Sudah Punya
                    Akun?</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-left">
                <img class="nav-logo" alt="Logo"
                    src="<?php echo e(asset('005d5b9dc825d74b4f47a1a022a7913f-removebg-preview-1@2x.png')); ?>">

                <span>M-Presence FEB</span>
            </div>
            <div class="footer-right">
                &copy; <?php echo e(date('Y')); ?> Fakultas Ekonomi dan Bisnis — UIN Syarif Hidayatullah Jakarta
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 20);
        });

        // Mobile menu toggle
        function toggleMobile() {
            const links = document.querySelector('.nav-links');
            const cta = document.querySelector('.nav-cta');
            links.style.display = links.style.display === 'flex' ? 'none' : 'flex';
            cta.style.display = cta.style.display === 'flex' ? 'none' : 'flex';
        }
    </script>

</body>

</html>
<?php /**PATH C:\laragon\www\web-presensi-feb\resources\views/index.blade.php ENDPATH**/ ?>