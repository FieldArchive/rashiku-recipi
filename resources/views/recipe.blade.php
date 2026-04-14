<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title }} | らしくレシピ</title>
        <style>
            :root {
                --bg: #faf6f0;
                --ink: #3c3028;
                --muted: #6f6258;
                --line: rgba(120, 101, 84, 0.18);
                --paper: rgba(255, 255, 255, 0.6);
            }
            body {
                margin: 0;
                color: var(--ink);
                font-family: "Yu Gothic UI", "Hiragino Sans", "Meiryo", sans-serif;
                background: linear-gradient(180deg, #faf6f0 0%, #f3ede3 100%);
            }
            main {
                width: min(760px, calc(100% - 32px));
                margin: 0 auto;
                padding: 28px 0 80px;
            }
            a { color: inherit; }
            .brand-link {
                display: inline-block;
                margin-bottom: 10px;
                color: var(--muted);
                text-decoration: none;
                letter-spacing: 0.08em;
                font-size: 0.82rem;
                text-transform: uppercase;
            }
            .back {
                display: inline-block;
                margin-bottom: 24px;
                color: var(--muted);
                text-decoration: none;
            }
            h1, h2, h3 {
                font-family: "Yu Mincho", "Hiragino Mincho ProN", serif;
                line-height: 1.2;
            }
            h1 {
                font-size: clamp(2.2rem, 5vw, 3.8rem);
                margin: 0 0 14px;
            }
            .summary {
                margin: 0 0 28px;
                color: var(--muted);
                line-height: 1.9;
                font-size: 1.05rem;
            }
            section {
                margin-top: 18px;
                padding: 20px 22px;
                background: var(--paper);
                border: 1px solid var(--line);
                border-radius: 22px;
            }
            section h2 {
                margin: 0 0 12px;
                font-size: 1.1rem;
            }
            p, li {
                line-height: 1.9;
            }
            p { margin: 0; }
            ul, ol {
                margin: 0;
                padding-left: 1.2rem;
            }
            .to-top {
                position: fixed;
                right: 20px;
                bottom: 20px;
                width: 48px;
                height: 48px;
                border: 1px solid rgba(120, 101, 84, 0.14);
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.82);
                color: var(--ink);
                font-size: 1.1rem;
                cursor: pointer;
                opacity: 0;
                transform: translateY(10px);
                pointer-events: none;
                transition: opacity 180ms ease, transform 180ms ease, background 180ms ease;
            }
            .to-top.is-visible {
                opacity: 1;
                transform: translateY(0);
                pointer-events: auto;
            }
            .to-top:hover,
            .to-top:focus-visible {
                background: rgba(255, 255, 255, 0.96);
                outline: none;
            }
        </style>
    </head>
    <body>
        <main>
            <a class="brand-link" href="{{ url('/') }}">らしくレシピ</a><br>
            <a class="back" href="{{ url('/?resume=1') }}">← 診断にもどる</a>
            <h1>{{ $title }}</h1>
            <p class="summary">{{ $summary }}</p>

            <section>
                <h2>今起きていること</h2>
                <p>{{ $body['why'] }}</p>
            </section>

            <section>
                <h2>まずやること</h2>
                <ol>
                    @foreach ($body['steps'] as $step)
                        <li>{{ $step }}</li>
                    @endforeach
                </ol>
            </section>

            <section>
                <h2>戻る問い</h2>
                <ul>
                    @foreach ($body['questions'] as $question)
                        <li>{{ $question }}</li>
                    @endforeach
                </ul>
            </section>
        </main>
        <button class="to-top" id="to-top" type="button" aria-label="上に戻る">↑</button>
        <script>
            const toTopButton = document.getElementById('to-top');
            let scrollAnimationFrame = null;

            function easeOutCubic(t) {
                return 1 - Math.pow(1 - t, 3);
            }

            function scrollToTopSmoothly(duration = 720) {
                if (scrollAnimationFrame) {
                    cancelAnimationFrame(scrollAnimationFrame);
                }

                const startY = window.scrollY;
                const startTime = performance.now();

                function step(now) {
                    const elapsed = now - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const eased = easeOutCubic(progress);

                    window.scrollTo(0, startY * (1 - eased));

                    if (progress < 1) {
                        scrollAnimationFrame = requestAnimationFrame(step);
                    } else {
                        scrollAnimationFrame = null;
                    }
                }

                scrollAnimationFrame = requestAnimationFrame(step);
            }

            function syncToTopButton() {
                toTopButton.classList.toggle('is-visible', window.scrollY > 240);
            }

            toTopButton.addEventListener('click', () => {
                scrollToTopSmoothly();
            });

            window.addEventListener('scroll', syncToTopButton, { passive: true });
            syncToTopButton();
        </script>
    </body>
</html>
