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

    public static function recipes(): array
    {
        return [
            'body-reset' => [
                'title' => '身体由来で重い日のレシピ',
                'summary' => '今日は心を説得しなくていい日です。まず身体のざわつきを静めて、これ以上削らない運用に切り替えます。',
                'why' => '寝不足、食べすぎ、呼吸の浅さ、温度の低さで余白が閉じている時は、考えるほど重くなりやすいです。',
                'steps' => [
                    '白湯か水を飲む。',
                    '5分だけ横になるか、座って背中を預ける。',
                    '今日は決めない、と先に決める。',
                    'スマホや情報を増やさず、温かくして静かに戻す。',
                ],
                'questions' => [
                    'いま私は、心より身体が重い？',
                    '食べたもの、寝不足、冷え、呼吸を無視していない？',
                ],
            ],
            'loss-release' => [
                'title' => '損した気持ちが抜けない日のレシピ',
                'summary' => '損の感情が残っている日は、正しさより先に回収モードを止めるのが先です。',
                'why' => '損した、回収したい、取り返したいが続くと、出来事より損得の物語に巻き込まれて余白が閉じます。',
                'steps' => [
                    '「損トリガーだ」と名前をつける。',
                    '今日は回収しない時間だと決める。',
                    '小さく秩序が戻る行動を一つする。机を整える、湯を沸かす、庭を見る。',
                    '解決や反論は、余白が戻ってから考える。',
                ],
                'questions' => [
                    'いま苦しいのは、出来事そのもの？ それとも損した感じ？',
                    '回収したい気持ちが、今日の自分をさらに重くしていない？',
                ],
            ],
            'comparison-soften' => [
                'title' => '比較で余白が飛んだ日のレシピ',
                'summary' => '比較の最中に答えを出さなくていいです。まず比較の自動再生から一歩降ります。',
                'why' => '比較は「足りない私」を増幅しやすく、余白がなくなると必要以上に深く刺さります。',
                'steps' => [
                    'その場を離れるか、視線を切る。',
                    '呼吸が浅くないか、みぞおちが固くないかを見る。',
                    '「比較が起きているだけ」と言葉にする。',
                    '今日の勝ち筋は、判断しないで戻ることに置き直す。',
                ],
                'questions' => [
                    '私は今、誰かと比べて自分を削っていない？',
                    '今日は評価ではなく、余白残量を見る日ではない？',
                ],
            ],
            'work-guilt-freeze' => [
                'title' => 'やるべきことだけ重い日のレシピ',
                'summary' => '怠けているのではなく、お金・自己価値・何者か焦りが乗って、仕事や表現だけが重くなっている状態かもしれません。',
                'why' => '本を読む、片づける、整えることはできるのに、仕事や発信だけに罪悪感と焦りが乗る時は、「やるべき」が余白回復の行為まで汚していることがあります。',
                'steps' => [
                    'まず「何もできない」ではなく「やるべきことだけ重い」と言い直す。',
                    '今日は仕事しない自分を裁くのを止める。',
                    '片づけや読書を逃避ではなく、余白回復として正式に扱う。',
                    '少し戻ったら、仕事を進める代わりに「次の一手を一つだけ決める」で終える。',
                ],
                'questions' => [
                    '私は仕事そのものが嫌なのではなく、仕事に乗っている意味や価値の重さで固まっていない？',
                    '整える行為にまで「そんなことしてていいの？」が混ざっていない？',
                ],
            ],
            'social-aftertaste' => [
                'title' => '相手を不愉快にさせたかもで苦しい日のレシピ',
                'summary' => '反省が必要というより、気まずさと自己攻撃が混ざって、余白を失っている状態かもしれません。',
                'why' => 'そんなつもりはなかったのに空気が悪くなった気がすると、出来事そのものより「私はまずかったのか」が頭の中で増幅しやすいです。',
                'steps' => [
                    'まず「やってしまったかも」で止まっている状態だと認める。',
                    'その場の空気を何度も再生して、自分を裁くのをいったん止める。',
                    '今すぐ説明や挽回をしない。余白が戻るまで連絡しない。',
                    '少し落ち着いたら、必要なら短く確認するか、そのまま静かに戻す。',
                ],
                'questions' => [
                    '私は事実を見ている？ それとも相手の反応を全部自分のせいにしている？',
                    'いま必要なのは謝罪の文面づくり？ それとも余白を戻してから見ること？',
                ],
            ],
        ];
    }

    public static function articles(): array
    {
        return [
            'nothing-moves' => [
                'title' => 'やるべきことに、やる気が出ない。さらに、何もかも手が出ない時',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/nothing-moves.md')),
            ],
            'after-going-out-heavy' => [
                'title' => '人に会ったり、出かけたりしたあとから重い時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/after-going-out-heavy.md')),
            ],
            'body-heavy-first' => [
                'title' => '特に思い当たらないけれど、まず身体が重い時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/body-heavy-first.md')),
            ],
            'mind-still-running' => [
                'title' => '頭の中で、何かがまだ続いている時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/mind-still-running.md')),
            ],
            'unpaid-absorption-anxiety' => [
                'title' => '一銭にもならないことにのめり込んでいて、不安な時のレシピ',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/unpaid-absorption-anxiety.md')),
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
            'zatchy-case' => [
                'title' => '(仮) ざっちー案件とは？',
                'html' => self::renderDialogueMarkdown(resource_path('content/articles/zatchy-case.md')),
            ],
        ];
    }
}
