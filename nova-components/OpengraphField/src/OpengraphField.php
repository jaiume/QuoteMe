<?php

namespace Quoteme\OpengraphField;

use Goutte;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Field;
use OpenGraph;

class OpengraphField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'opengraph-field';

    public function openGraphUrl(?string $url): OpengraphField
    {
        if ($url) {
            $data = \Cache::rememberForever('og-' . md5($url), function () use ($url) {
                try {
                    if (preg_match('/^(https?:\/\/)?(www.)?(amazon.com)/', $url)) {
                        /* If Amazon */
                        $crawler = Goutte::request('GET', $url);

                        $title = $crawler->filter('#productTitle')
                                         ->text();

                        $description = $crawler->filter('#feature-bullets > ul')
                                               ->text();

                        $image = $crawler->filter('#imgTagWrapperId img')
                                         ->eq(0)
                                         ->attr('data-old-hires');

                        return [
                            'image' => $image,
                            'title' => $title,
                            'description' => Str::limit($description, 500),
                        ];
                    }

                    return OpenGraph::fetch($url);
                } catch (\Throwable $e) {
                    return [];
                }
            });

            return $this->withMeta([
                'url' => $url,
                'og_data' => $data,
            ]);
        }

        return $this->withMeta([
            'url' => $url,
            'og_data' => null,
        ]);
    }
}
