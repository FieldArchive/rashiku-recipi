@php
    $decisionTree = [
            'start' => [
                'prompt' => 'いまの感じにいちばん近いものを選んでください。',
                'choices' => [
                    ['label' => 'やるべきことに、やる気が出ない', 'next' => 'work-freeze-check'],
                    ['label' => 'えもいえぬ不安がある', 'next' => 'anxiety-check'],
                    ['label' => '人とのことで、自分の調子が乱れそう', 'next' => 'relationship-stuck-check'],
                    ['label' => '雑に時間を使ってしまっている', 'article' => 'using-time-sloppily'],
                ],
            ],
            'anxiety-check' => [
                'prompt' => 'いま近いのはどちらですか？',
                'choices' => [
                    ['label' => '一銭にもならないことにのめり込んでいて不安', 'article' => 'unpaid-absorption-anxiety'],
                ['label' => '大勢の空気に飲まれそうで不安', 'article' => 'crowd-pressure-anxiety'],
                ['label' => '足りない気がして、無駄に焦っている', 'next' => 'scarcity-anxiety-check'],
            ],
        ],
        'scarcity-anxiety-check' => [
            'prompt' => 'いま近いのはどちらですか？',
            'choices' => [
                ['label' => 'お金が足りなくなる気がして、買う決断ができない', 'article' => 'scarcity-anxiety-rush'],
            ],
        ],
        'invasion-article-check' => [
            'prompt' => 'いま近いのはどちらですか？',
            'choices' => [
                ['label' => 'せっかく気分よかったのに、無遠慮に踏みにじられた', 'article' => 'rude-attitude-stuck'],
                ['label' => '毎回バッドエンドルートを選んでしまうのはなぜだろうって思えてきた。', 'article' => 'trying-hard-but-bad-ending'],
            ],
        ],
            'relationship-stuck-check' => [
                'prompt' => '人とのことで、いま近いのはどちらですか？',
                'choices' => [
                    ['label' => '人に会ったり、出かけたりしたあとから重い', 'article' => 'after-going-out-heavy'],
                    ['label' => '失礼な態度をされて、引っかかっている', 'next' => 'invasion-article-check'],
                    ['label' => '相手を不愉快にさせたかもで、引きずっている', 'recipe' => 'social-aftertaste'],
                    ['label' => '相手に引け目や嫉妬を感じて、気持ちがねじれる', 'article' => 'jealousy-toward-capable-people'],
                    ['label' => '人に任せる気になれない', 'next' => 'delegation-anxiety-check'],
                    ['label' => '大事な場で、自分らしさが飛んでしまう', 'article' => 'lose-myself-in-important-gatherings'],
                ],
            ],
            'delegation-anxiety-check' => [
                'prompt' => '人に任せることで、いま近いのはどちらですか？',
                'choices' => [
                    ['label' => '自分でできることにお金を払うのは損だと思ってしまう', 'article' => 'delegating-feels-like-loss'],
                    ['label' => '任せた相手の雑さが引っかかって、結局自分で回収したくなる', 'article' => 'delegated-work-feels-sloppy'],
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
                </section>
            </section>
        </main>

        <script>
            const decisionTree = @json($decisionTree);

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
                    button.textContent = choice.label;
                    button.addEventListener('click', () => {
                        if (choice.recipe || choice.article) {
                            persistDiagnosisState();

                            if (choice.recipe) {
                                window.location.href = `/recipes/${choice.recipe}`;
                                return;
                            }

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
