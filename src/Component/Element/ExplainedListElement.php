<?php
/**
 * Copyright (C) Jyxon, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace Ulrack\Cli\Component\Element;

use Ulrack\Cli\Common\Io\WriterInterface;
use Ulrack\Cli\Component\Theme\VoidStyle;
use Ulrack\Cli\Common\Theme\StyleInterface;
use Ulrack\Cli\Common\Element\ElementInterface;

class ExplainedListElement implements ElementInterface
{
    /**
     * Contains the writer to display the list.
     *
     * @var WriterInterface
     */
    private $writer;

    /**
     * Contains the style of the key.
     *
     * @var StyleInterface
     */
    private $keyStyle;

    /**
     * Contains the style of the description.
     *
     * @var StyleInterface
     */
    private $descriptionStyle;

    /**
     * Contains the entries for the list.
     *
     * @var string[]
     */
    private $items = ['items' => []];

    /**
     * Constructor.
     *
     * @param WriterInterface $writer
     * @param StyleInterface $keyStyle
     * @param StyleInterface $descriptionStyle
     */
    public function __construct(
        WriterInterface $writer,
        StyleInterface $keyStyle = null,
        StyleInterface $descriptionStyle = null
    ) {
        $this->writer = $writer;
        $this->descriptionStyle = $descriptionStyle ?? new VoidStyle();
        $this->keyStyle = $keyStyle ?? new VoidStyle();
    }

    /**
     * Renders the element.
     *
     * @return void
     */
    public function render(): void
    {
        $items = $this->prepareArray(
            $this->items['items']
        );

        $columnWidth = max(
            array_map('strlen', array_keys($items))
        ) + 4;

        foreach ($items as $key => $description) {
            $spaceless = ltrim($key);
            $spaces = str_replace($spaceless, '', $key);
            $this->writer->write($spaces);
            $this->keyStyle->apply();
            $this->writer->write($spaceless);
            $this->keyStyle->reset();
            $this->writer->write(str_repeat(' ', $columnWidth - strlen($key)));
            $this->descriptionStyle->apply();
            $this->writer->write($description);
            $this->descriptionStyle->reset();
            $this->writer->writeLine('');
        }
    }

    /**
     * Prepares the array for rendering.
     *
     * @param array $items
     * @param int $depth
     *
     * @return array
     */
    private function prepareArray(
        array $items,
        int $depth = 0
    ): array {
        $return = [];
        ksort($items);

        foreach ($items as $key => $item) {
            $return[str_repeat(
                '  ',
                $depth
            ) . $key] = $item['description'];

            if (isset($item['items'])
                && !empty($item['items'])
            ) {
                $return = array_merge(
                    $return,
                    $this->prepareArray(
                        $item['items'],
                        $depth + 1
                    )
                );
            }
        }

        return $return;
    }

    /**
     * Adds an item to the list.
     *
     * @param string $description
     * @param string[] $keys
     *
     * @return void
     */
    public function addItem(string $description, string ...$keys): void
    {
        $items = &$this->items;
        foreach ($keys as $key) {
            if (!isset($items['items'][$key])) {
                $items['items'][$key] = ['items' => [], 'description' => ''];
            }

            $items = &$items['items'][$key];
        }

        $items['description'] = $description;
    }
}
