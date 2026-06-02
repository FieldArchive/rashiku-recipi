<?php

namespace App\Support;

use Illuminate\Support\Str;

class RashikuContent
{
    protected static function normalizeSoftBreaks(string $content): string
    {
        $content = str_replace(["\r\n", "\r"], "\n", trim($content));
        $paragraphs = preg_split("/\n{2,}/", $content) ?: [];

        $paragraphs = array_map(function (string $paragraph): string {
            return preg_replace("/\n/", "  \n", trim($paragraph)) ?? trim($paragraph);
        }, $paragraphs);

        return implode("\n\n", $paragraphs);
    }

    protected static function renderDialogueMarkdown(string $path): string
    {
        $markdown = file_get_contents($path);

        $markdown = preg_replace_callback(
            '/::(me|guide|point|core)\R(.*?)\R::/su',
            function (array $matches): string {
                $role = $matches[1];
                $content = trim($matches[2]);
                $html = Str::markdown(self::normalizeSoftBreaks($content));
                $class = match ($role) {
                    'me' => 'dialogue-bubble dialogue-me',
                    'point' => 'dialogue-point',
                    'core' => 'dialogue-core',
                    default => 'dialogue-guide',
                };

                return sprintf(
                    '<div class="%1$s"><div class="dialogue-body">%2$s</div></div>',
                    $class,
                    $html
                );
            },
            $markdown
        );

        return Str::markdown($markdown);
    }

    public static function articles(): array
    {
        return [
            'being-yourself-brings-back-pain' => [
                'title' => '自分らしくしようとすると、痛い思いがよみがえる時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/being-yourself-brings-back-pain.md')),
            ],
            'cannot-trust-my-choice' => [
                'title' => '自分の選択を後悔している時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/cannot-trust-my-choice.md')),
            ],
            'yohaku-tested-by-events' => [
                'title' => '予期せぬことが重なって、余白が試される時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/yohaku-tested-by-events.md')),
            ],
            'nothing-moves' => [
                'title' => 'やるべきことに、やる気が出ない。さらに、何もかも手が出ない時',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/nothing-moves.md')),
            ],
            'after-going-out-heavy' => [
                'title' => '人に会ったり、出かけたりしたあとから重い時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/after-going-out-heavy.md')),
            ],
            'avoidance-escape' => [
                'title' => 'やりたくないことから逃げたくて、別のことに没頭してしまう時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/avoidance-escape.md')),
            ],
            'body-heavy-first' => [
                'title' => '特に思い当たらないけれど、まず身体が重い時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/body-heavy-first.md')),
            ],
            'lose-myself-in-important-gatherings' => [
                'title' => '大事な場で、自分らしさが飛んでしまう時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/lose-myself-in-important-gatherings.md')),
            ],
            'moyamoya-wrong-next-move' => [
                'title' => 'モヤモヤのせいで、次の一手を間違えそうな時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/moyamoya-wrong-next-move.md')),
            ],
            'mind-still-running' => [
                'title' => '頭の中で、何かがまだ続いている時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/mind-still-running.md')),
            ],
            'too-many-good-options-stuck' => [
                'title' => 'どの選択にも良さが見えて、動けない時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/too-many-good-options-stuck.md')),
            ],
            'unpaid-absorption-anxiety' => [
                'title' => '一銭にもならないことにのめり込んでいて、不安な時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/unpaid-absorption-anxiety.md')),
            ],
            'using-time-sloppily' => [
                'title' => '雑に時間を使ってしまっている時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/using-time-sloppily.md')),
            ],
            'restoring-time-doubt' => [
                'title' => '整えることに時間を使ったのに、これでいいのかと思う時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/restoring-time-doubt.md')),
            ],
            'money-outflow-no-inflow' => [
                'title' => 'お金を出すことはできるのに、入る流れが見えない時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/money-outflow-no-inflow.md')),
            ],
            'value-seeds-to-money-entrance' => [
                'title' => '価値の芽を、お金の入口につなげたい時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/value-seeds-to-money-entrance.md')),
            ],
            'what-is-yohaku' => [
                'title' => '余白ってなに？',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/what-is-yohaku.md')),
            ],
            'trying-hard-but-bad-ending' => [
                'title' => '頑張っているのに、なぜかバッドエンドになってしまう時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/trying-hard-but-bad-ending.md')),
            ],
            'rude-attitude-stuck' => [
                'title' => '失礼な態度そのものが引っかかっている時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/rude-attitude-stuck.md')),
            ],
            'reacting-to-loved-one-being-hurt' => [
                'title' => '大切な人が雑に扱われて、自分まで反応しそうな時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/reacting-to-loved-one-being-hurt.md')),
            ],
            'what-is-zatchy' => [
                'title' => 'ざっちーってなに？',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/what-is-zatchy.md')),
            ],
        ];
    }

    public static function draftArticles(): array
    {
        return [
            'archive-yohaku-letting-go' => [
                'title' => 'アーカイヴと余白のあいだで、物を手放せない時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/archive-yohaku-letting-go.md')),
            ],
            'crowd-pressure-anxiety' => [
                'title' => '大勢の空気に飲まれそうな時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/crowd-pressure-anxiety.md')),
            ],
            'scarcity-anxiety-rush' => [
                'title' => 'お金が足りなくなる気がして、買う決断ができない時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/scarcity-anxiety-rush.md')),
            ],
            'delegated-work-feels-sloppy' => [
                'title' => '任せた相手の雑さが引っかかって、結局自分で回収したくなる時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/delegated-work-feels-sloppy.md')),
            ],
            'money-used-without-consent' => [
                'title' => '自分のお金を納得いかない形で使われてモヤモヤする時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/money-used-without-consent.md')),
            ],
            'repelled-by-shared-values' => [
                'title' => 'みんながありがたがる空気に引いてしまう時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/repelled-by-shared-values.md')),
            ],
            'jealousy-toward-capable-people' => [
                'title' => '他者がうまくいっているように見えて、気持ちがねじれる時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/jealousy-toward-capable-people.md')),
            ],
            'projecting-moyamoya-onto-others' => [
                'title' => '自分のモヤモヤがきっかけで負の連鎖を広げたくない時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/projecting-moyamoya-onto-others.md')),
            ],
            'afraid-of-being-older-side' => [
                'title' => '年下キャラを卒業できず、自分が年上側に立つのが怖い時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/afraid-of-being-older-side.md')),
            ],
        ];
    }

    public static function movies(): array
    {
        return [
            'its-complicated' => [
                'title' => '恋するベーカリー',
                'watched_on' => '2026/5/8',
                'html' => self::renderDialogueMarkdown(resource_path('content/movies/its-complicated.md')),
            ],
            'the-devil-wears-prada' => [
                'title' => 'プラダを着た悪魔',
                'watched_on' => '2026/5/7',
                'html' => self::renderDialogueMarkdown(resource_path('content/movies/the-devil-wears-prada.md')),
            ],
        ];
    }

    public static function documentaries(): array
    {
        return [
            'isai-to-yobarete' => [
                'title' => 'テレメンタリーPlus「異才と呼ばれて」',
                'watched_on' => '2026/5/10',
                'html' => self::renderDialogueMarkdown(resource_path('content/documentaries/isai-to-yobarete.md')),
            ],
        ];
    }

}
