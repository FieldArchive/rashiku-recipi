@php
    $decisionTree = [
            'start' => [
                'prompt' => 'いまの感じにいちばん近いものを選んでください。',
                'choices' => [
                    ['label' => '相手の雑な対応で反応してしまう', 'next' => 'other-person-trigger-check'],
                    ['label' => '自分の内側からモヤモヤが出ている', 'next' => 'self-trigger-check'],
                    ['label' => 'やるべきことに、やる気が出ない', 'next' => 'work-freeze-check'],
                    ['label' => 'えもいえぬ不安がある', 'next' => 'anxiety-check'],
                    ['label' => '気持ちに余裕があっても、揺さぶられる', 'next' => 'lingering-feeling-check'],
                    ['label' => '自分に紐づいたものの使い方で気持ちが引っかかる', 'next' => 'time-use-check'],
                ],
            ],
            'time-use-check' => [
                'prompt' => 'いま近いのはどちらですか？',
                'choices' => [
                    ['label' => '雑に時間を使ってしまっている', 'article' => 'using-time-sloppily'],
                    ['label' => '整えることに時間を使ったのに、これでいいのかと思う', 'article' => 'restoring-time-doubt'],
                    ['label' => '自分でできることにお金を払うのは損だと思ってしまう（調整中）', 'article' => 'delegating-feels-like-loss', 'draft' => true],
                    ['label' => 'アーカイヴと余白のあいだで、物を手放せない（調整中）', 'article' => 'archive-yohaku-letting-go', 'draft' => true],
                ],
            ],
            'anxiety-check' => [
                'prompt' => 'いま近いのはどちらですか？',
                'choices' => [
                    ['label' => '一銭にもならないことにのめり込んでいて不安', 'article' => 'unpaid-absorption-anxiety'],
                    ['label' => '大勢の空気に飲まれそうで不安（調整中）', 'article' => 'crowd-pressure-anxiety', 'draft' => true],
                    ['label' => 'お金が足りなくなる気がして、買う決断ができない（調整中）', 'article' => 'scarcity-anxiety-rush', 'draft' => true],
            ],
        ],
            'lingering-feeling-check' => [
                'prompt' => 'いま近いのはどちらですか？',
                'choices' => [
                    ['label' => '人に会ったり、出かけたりしたあとでモヤモヤが晴れない', 'article' => 'after-going-out-heavy'],
                    ['label' => '自分らしくしようとすると、痛い思いがよみがえる', 'article' => 'being-yourself-brings-back-pain'],
                    ['label' => '自分の選択を後悔している', 'article' => 'cannot-trust-my-choice'],
                    ['label' => '予期せぬことが重なって、余白が試されている', 'article' => 'yohaku-tested-by-events'],
                ],
            ],
            'other-person-trigger-check' => [
                'prompt' => 'いま近いのはどちらですか？',
                'choices' => [
                    ['label' => 'せっかく気分よかったのに、無遠慮に踏みにじられた', 'article' => 'rude-attitude-stuck'],
                    ['label' => '毎回バッドエンドルートを選んでしまうのはなぜだろうって思えてきた。', 'article' => 'trying-hard-but-bad-ending'],
                    ['label' => '任せた相手の雑さが引っかかって、結局自分で回収したくなる（調整中）', 'article' => 'delegated-work-feels-sloppy', 'draft' => true],
                    ['label' => '自分のお金を納得いかない形で使われてモヤモヤする（調整中）', 'article' => 'money-used-without-consent', 'draft' => true],
                    ['label' => '大切な人が雑に扱われて、自分まで反応しそう', 'article' => 'reacting-to-loved-one-being-hurt'],
                ],
            ],
            'self-trigger-check' => [
                'prompt' => 'いま近いのはどちらですか？',
                'choices' => [
                    ['label' => 'みんながありがたがる空気に引いてしまう（調整中）', 'article' => 'repelled-by-shared-values', 'draft' => true],
                    ['label' => '他者がうまくいっているように見えて、気持ちがねじれる（調整中）', 'article' => 'jealousy-toward-capable-people', 'draft' => true],
                    ['label' => '自分のモヤモヤを相手にぶつけてしまった（調整中）', 'article' => 'projecting-moyamoya-onto-others', 'draft' => true],
                    ['label' => '年下キャラを卒業できず、自分が年上側に立つのが怖い（調整中）', 'article' => 'afraid-of-being-older-side', 'draft' => true],
                    ['label' => '大事な場で、自分らしさが飛んでしまう', 'article' => 'lose-myself-in-important-gatherings'],
                    ['label' => 'モヤモヤのせいで、次の一手を間違えそう', 'article' => 'moyamoya-wrong-next-move'],
                ],
            ],
            'work-freeze-check' => [
                'prompt' => 'いま近いのはどちらですか？',
                'choices' => [
                ['label' => '何もかも手が出ない', 'article' => 'body-heavy-first'],
                ['label' => '頭の中で考えすぎて、やる気が出ない', 'article' => 'mind-still-running'],
                ['label' => 'やらなきゃいけないことから逃げたい', 'article' => 'avoidance-escape'],
                ['label' => 'どの選択にも良さが見えて、動けない', 'article' => 'too-many-good-options-stuck'],
            ],
        ],
    ];
    $movies = \App\Support\RashikuContent::movies();
    $documentaries = \App\Support\RashikuContent::documentaries();
@endphp
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>らしくレシピ</title>
        <style>
            :root {
                --bg: #f6f1e8;
                --bg-deep: #e8ddd0;
                --paper: rgba(255, 252, 246, 0.84);
                --ink: #3c3028;
                --muted: #6f6258;
                --line: rgba(120, 101, 84, 0.18);
                --sand: #efe3d2;
                --sage: #dfe7d7;
                --brick: #b96d4d;
                --accent: #81553f;
                --shadow: 0 18px 50px rgba(70, 46, 27, 0.12);
                --radius-lg: 30px;
                --radius-md: 22px;
                --radius-sm: 16px;
            }

            * {
                box-sizing: border-box;
            }

            html {
                scroll-behavior: smooth;
            }

            body {
                margin: 0;
                min-height: 100vh;
                color: var(--ink);
                font-family: "Yu Gothic UI", "Hiragino Sans", "Meiryo", sans-serif;
                background:
                    radial-gradient(circle at top left, rgba(195, 164, 129, 0.22), transparent 30%),
                    radial-gradient(circle at 85% 15%, rgba(165, 193, 171, 0.2), transparent 24%),
                    linear-gradient(180deg, #faf6f0 0%, var(--bg) 100%);
            }

            body::before {
                content: "";
                position: fixed;
                inset: 0;
                pointer-events: none;
                background-image:
                    linear-gradient(rgba(92, 75, 59, 0.03) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(92, 75, 59, 0.03) 1px, transparent 1px);
                background-size: 30px 30px;
                mask-image: linear-gradient(180deg, rgba(0, 0, 0, 0.45), transparent 75%);
            }

            a {
                color: inherit;
            }

            .shell {
                width: min(980px, calc(100% - 32px));
                margin: 0 auto;
                padding: 28px 0 64px;
            }

            h1, h2, h3 {
                font-family: "Yu Mincho", "Hiragino Mincho ProN", serif;
                line-height: 1.14;
                letter-spacing: 0.02em;
                margin: 0;
            }

            .section {
                margin-top: 8px;
            }

            .section-head {
                display: flex;
                align-items: end;
                justify-content: space-between;
                gap: 16px;
                margin-bottom: 18px;
            }

            .brand-mark {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 10px 14px;
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.68);
                border: 1px solid var(--line);
                color: var(--muted);
                letter-spacing: 0.08em;
                font-size: 0.8rem;
                text-transform: uppercase;
            }

            .brand-mark::before {
                content: "";
                width: 8px;
                height: 8px;
                border-radius: 50%;
                background: var(--brick);
                box-shadow: 0 0 0 6px rgba(185, 109, 77, 0.14);
            }

            .brand-title {
                margin-top: 16px;
                font-size: clamp(2.2rem, 4vw, 3.4rem);
            }

            .guide {
                max-width: 860px;
            }

            .prompt {
                font-size: clamp(1.35rem, 2vw, 1.8rem);
                max-width: none;
                white-space: nowrap;
                margin: 0 0 24px;
            }

            .choice-list {
                display: grid;
                gap: 14px;
                margin-top: 24px;
            }

            .choice-button {
                width: 100%;
                text-align: left;
                padding: 16px 18px;
                border-radius: 20px;
                border: 1px solid rgba(129, 85, 63, 0.15);
                background: linear-gradient(180deg, rgba(255, 255, 255, 0.94), rgba(244, 236, 225, 0.9));
                color: var(--ink);
                font-size: 1rem;
                line-height: 1.65;
                cursor: pointer;
                transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease;
            }

            .choice-button:hover,
            .choice-button:focus-visible {
                transform: translateY(-1px);
                border-color: rgba(129, 85, 63, 0.3);
                box-shadow: 0 12px 24px rgba(64, 43, 28, 0.08);
                outline: none;
            }

            .choice-button:disabled {
                cursor: default;
                opacity: 0.52;
                transform: none;
                box-shadow: none;
            }

            .choice-button.is-draft {
                color: rgba(60, 48, 40, 0.68);
            }

            .choice-draft-slug {
                display: block;
                margin-top: 4px;
                color: rgba(60, 48, 40, 0.45);
                font-size: 0.72rem;
                line-height: 1.4;
            }

            .trail {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-top: 22px;
            }

            .trail span {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 10px 12px;
                border-radius: 999px;
                background: rgba(239, 227, 210, 0.72);
                color: var(--muted);
                font-size: 0.85rem;
            }

            .trail span::after {
                content: "→";
                opacity: 0.45;
            }

            .trail span:last-child::after {
                display: none;
            }

            .utility-row {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-top: 24px;
            }

            .utility-row.is-hidden {
                display: none;
            }

            .taste-section {
                margin-top: 36px;
                padding-top: 26px;
                border-top: 1px solid var(--line);
            }

            .taste-title {
                margin: 0 0 14px;
                color: var(--muted);
                font-size: 0.92rem;
                font-weight: 700;
                letter-spacing: 0.08em;
            }

            .movie-list {
                display: grid;
                gap: 10px;
                margin: 0;
                padding: 0;
                list-style: none;
            }

            .movie-link {
                display: inline-flex;
                align-items: baseline;
                gap: 8px;
                width: fit-content;
                max-width: 100%;
                color: var(--ink);
                text-decoration: none;
                line-height: 1.7;
            }

            .movie-link:hover,
            .movie-link:focus-visible {
                text-decoration: underline;
                outline: none;
            }

            .movie-date {
                color: var(--muted);
                font-size: 0.9rem;
                white-space: nowrap;
            }

            .ghost-button {
                border: 1px solid rgba(129, 85, 63, 0.2);
                background: rgba(255, 255, 255, 0.55);
                color: var(--muted);
                border-radius: 999px;
                padding: 10px 15px;
                cursor: pointer;
            }

            .ghost-button:disabled {
                opacity: 0.4;
                cursor: default;
            }

            .fade-in {
                animation: rise 480ms ease both;
            }

            @keyframes rise {
                from {
                    opacity: 0;
                    transform: translateY(12px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @media (max-width: 680px) {
                .shell {
                    width: min(100%, calc(100% - 20px));
                    padding-top: 12px;
                }

                .prompt {
                    white-space: normal;
                }

            }
        </style>
    </head>
    <body>
        <main class="shell">
            <section class="section fade-in">
                <div class="section-head">
                    <div>
                        <span class="brand-mark">Dialogue Recipe</span>
                        <h1 class="brand-title">らしくレシピ</h1>
                    </div>
                </div>

                <section class="guide fade-in">
                        <h3 class="prompt" id="prompt"></h3>
                        <div class="choice-list" id="choices"></div>
                        <div class="trail" id="trail"></div>
                        <div class="utility-row is-hidden" id="utility-row">
                            <button class="ghost-button" type="button" id="back-button" disabled>一つ前に戻る</button>
                        </div>

                        <section class="taste-section" aria-labelledby="movies-heading">
                            <h2 class="taste-title" id="movies-heading">余白で味わう映画</h2>
                            <ul class="movie-list">
                                @foreach ($movies as $slug => $movie)
                                    <li>
                                        <a class="movie-link" href="{{ route('movies.show', $slug) }}">
                                            <span>{{ $movie['title'] }}</span>
                                            <span class="movie-date">({{ $movie['watched_on'] }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </section>

                        <section class="taste-section" aria-labelledby="documentaries-heading">
                            <h2 class="taste-title" id="documentaries-heading">余白で味わうドキュメンタリー</h2>
                            <ul class="movie-list">
                                @foreach ($documentaries as $slug => $documentary)
                                    <li>
                                        <a class="movie-link" href="{{ route('documentaries.show', $slug) }}">
                                            <span>{{ $documentary['title'] }}</span>
                                            <span class="movie-date">({{ $documentary['watched_on'] }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </section>

                </section>
            </section>
        </main>

        <script>
            const decisionTree = @json($decisionTree);
            const isLocal = @json(app()->environment('local'));

            const promptEl = document.getElementById('prompt');
            const choicesEl = document.getElementById('choices');
            const trailEl = document.getElementById('trail');
            const utilityRowEl = document.getElementById('utility-row');
            const backButtonEl = document.getElementById('back-button');
            const diagnosisStateKey = 'rashiku-diagnosis-state';

            let trail = [];
            let historyStack = [];
            let currentNodeId = 'start';

            function syncUtilityState() {
                backButtonEl.disabled = historyStack.length === 0;
                utilityRowEl.classList.toggle('is-hidden', historyStack.length === 0);
            }

            function renderNode(nodeId) {
                const node = decisionTree[nodeId];
                if (!node) {
                    return;
                }

                currentNodeId = nodeId;
                promptEl.textContent = node.prompt;
                choicesEl.innerHTML = '';
                syncUtilityState();

                node.choices.forEach((choice) => {
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.className = 'choice-button';
                    const label = document.createElement('span');
                    label.textContent = choice.label;
                    button.appendChild(label);
                    if (choice.draft) {
                        button.classList.add('is-draft');
                        if (isLocal && choice.article) {
                            const slug = document.createElement('span');
                            slug.className = 'choice-draft-slug';
                            slug.textContent = `articles/${choice.article}.md`;
                            button.appendChild(slug);
                            button.addEventListener('click', () => {
                                persistDiagnosisState();
                                window.location.href = `/articles/${choice.article}`;
                            });
                        } else {
                            button.disabled = true;
                        }
                        choicesEl.appendChild(button);
                        return;
                    }
                    button.addEventListener('click', () => {
                        if (choice.article) {
                            persistDiagnosisState();

                            window.location.href = `/articles/${choice.article}`;
                            return;
                        }

                        historyStack.push({
                            nodeId,
                            trail: [...trail],
                        });
                        trail.push(choice.label);
                        renderTrail();

                        renderNode(choice.next);
                    });
                    choicesEl.appendChild(button);
                });
            }

            function renderTrail() {
                trailEl.innerHTML = '';
                trail.forEach((item) => {
                    const tag = document.createElement('span');
                    tag.textContent = item;
                    trailEl.appendChild(tag);
                });
            }

            function resetGuide(startNode = 'start') {
                trail = [];
                historyStack = [];
                renderTrail();
                renderNode(startNode);
                syncUtilityState();
                clearDiagnosisState();
            }

            function goBack() {
                const previous = historyStack.pop();
                if (!previous) {
                    return;
                }

                trail = previous.trail;
                renderTrail();
                renderNode(previous.nodeId);
            }

            function persistDiagnosisState() {
                sessionStorage.setItem(diagnosisStateKey, JSON.stringify({
                    trail,
                    historyStack,
                    currentNodeId,
                }));
            }

            function clearDiagnosisState() {
                sessionStorage.removeItem(diagnosisStateKey);
            }

            function restoreDiagnosisState() {
                const raw = sessionStorage.getItem(diagnosisStateKey);
                if (!raw) {
                    return false;
                }

                try {
                    const state = JSON.parse(raw);
                    trail = Array.isArray(state.trail) ? state.trail : [];
                    historyStack = Array.isArray(state.historyStack) ? state.historyStack : [];
                    renderTrail();
                    renderNode(state.currentNodeId || 'start');
                    return true;
                } catch (error) {
                    clearDiagnosisState();
                    return false;
                }
            }

            function clearResumeQuery() {
                const url = new URL(window.location.href);
                if (!url.searchParams.has('resume')) {
                    return;
                }

                url.searchParams.delete('resume');
                const query = url.searchParams.toString();
                const nextUrl = `${url.pathname}${query ? `?${query}` : ''}${url.hash}`;
                window.history.replaceState({}, '', nextUrl);
            }

            backButtonEl.addEventListener('click', goBack);
            const shouldResume = new URLSearchParams(window.location.search).get('resume') === '1';
            if (!(shouldResume && restoreDiagnosisState())) {
                resetGuide();
            }
            clearResumeQuery();
        </script>
    </body>
</html>
