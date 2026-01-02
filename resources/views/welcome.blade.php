<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Engine | Build Real Discipline</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .hero {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 20px;
            background: linear-gradient(to right, #fff, var(--primary));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero p {
            font-size: 1.1rem;
            color: var(--text-muted);
            max-width: 400px;
            margin-bottom: 40px;
            line-height: 1.6;
        }
        .feature-grid {
            margin-top: 50px;
            display: grid;
            gap: 20px;
            width: 100%;
            max-width: 450px;
        }
        .feature-item {
            display: flex;
            align-items: center;
            text-align: left;
            background: rgba(255,255,255,0.03);
            padding: 15px;
            border-radius: 16px;
            border: 1px solid var(--glass-border);
        }
        .feature-item i {
            font-size: 1.5rem;
            color: var(--primary);
            margin-right: 15px;
            width: 30px;
        }
        .auth-buttons {
            display: flex;
            gap: 15px;
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>
    <div class="gradient-bg"></div>
    
    <div class="container hero">
        <div class="animate-fade">
            <div style="margin-bottom: 20px; display: inline-block; background: rgba(99, 102, 241, 0.1); color: var(--primary); padding: 8px 16px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; letter-spacing: 1px;">
                ENGINEered FOR DISCIPLINE
            </div>
            <h1>Control Your<br>Money Flow.</h1>
            <p>A personal financial assistant that learns your habits, warns of drift, and protects your future.</p>

            <div class="auth-buttons">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-primary" style="flex: 2;">Get Started</a>
                    <a href="{{ route('login') }}" class="btn" style="flex: 1; border: 1px solid var(--glass-border);">Login</a>
                @endauth
            </div>

            <div class="feature-grid">
                <div class="feature-item">
                    <i class="fas fa-brain"></i>
                    <div>
                        <strong style="display: block; font-size: 0.9rem;">Behavioral AI</strong>
                        <span style="font-size: 0.75rem; color: var(--text-muted);">Predicts month-end balance & alerts leaks.</span>
                    </div>
                </div>
                <div class="feature-item">
                    <i class="fas fa-shield-halved"></i>
                    <div>
                        <strong style="display: block; font-size: 0.9rem;">Military-Grade Security</strong>
                        <span style="font-size: 0.75rem; color: var(--text-muted);">AES-256 encryption at rest. Pure privacy.</span>
                    </div>
                </div>
                <div class="feature-item">
                    <i class="fas fa-bullseye"></i>
                    <div>
                        <strong style="display: block; font-size: 0.9rem;">Goal Lock</strong>
                        <span style="font-size: 0.75rem; color: var(--text-muted);">Stay on track for ₦500k by Dec 2026.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer style="position: absolute; bottom: 30px; width: 100%; text-align: center; font-size: 0.7rem; color: var(--text-muted); opacity: 0.5;">
        © 2026 Financial Discipline & Life Control Engine. Built for the disciplined.
    </footer>
</body>
</html>
