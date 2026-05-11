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
            '/::(me|guide|point)\R(.*?)\R::/su',
            function (array $matches): string {
                $role = $matches[1];
                $content = trim($matches[2]);
                $html = Str::markdown(self::normalizeSoftBreaks($content));
                $class = match ($role) {
                    'me' => 'dialogue-bubble dialogue-me',
                    'point' => 'dialogue-point',
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
            'repelled-by-shared-values' => [
                'title' => 'みんながありがたがる空気に引いてしまう時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/repelled-by-shared-values.md')),
            ],
            'being-yourself-brings-back-pain' => [
                'title' => '自分らしくしようとすると、痛い思いがよみがえる時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/being-yourself-brings-back-pain.md')),
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
            'crowd-pressure-anxiety' => [
                'title' => '(仮) 大勢の空気に飲まれそうな時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/crowd-pressure-anxiety.md')),
            ],
            'delegating-feels-like-loss' => [
                'title' => '自分でできることにお金を払うのは損だと思ってしまう時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/delegating-feels-like-loss.md')),
            ],
            'delegated-work-feels-sloppy' => [
                'title' => '任せた相手の雑さが引っかかって、結局自分で回収したくなる時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/delegated-work-feels-sloppy.md')),
            ],
            'lose-myself-in-important-gatherings' => [
                'title' => '大事な場で、自分らしさが飛んでしまう時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/lose-myself-in-important-gatherings.md')),
            ],
            'scarcity-anxiety-rush' => [
                'title' => '(仮) お金が足りなくなる気がして、買う決断ができない時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/scarcity-anxiety-rush.md')),
            ],
            'mind-still-running' => [
                'title' => '頭の中で、何かがまだ続いている時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/mind-still-running.md')),
            ],
            'jealousy-toward-capable-people' => [
                'title' => '相手に引け目や嫉妬を感じて、気持ちがねじれる時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/jealousy-toward-capable-people.md')),
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
            'what-is-zatchy' => [
                'title' => 'ざっちーってなに？',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/what-is-zatchy.md')),
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

}
