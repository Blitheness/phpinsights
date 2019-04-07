<?php

declare(strict_types=1);

namespace NunoMaduro\PhpInsights\Domain\Insights;

use NunoMaduro\PhpInsights\Domain\Contracts\HasDetails;

/**
 * @internal
 */
final class ForbiddenDefineGlobalConstants extends Insight implements HasDetails
{
    /**
     * {@inheritdoc}
     */
    public function hasIssue(): bool
    {
        return count(array_diff($this->collector->getGlobalConstants(), $this->config['ignore'] ?? [])) > 0;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle(): string
    {
        return 'The use of `globals` is prohibited';
    }


    /**
     * {@inheritdoc}
     */
    public function getDetails(): array
    {
        $globalConstants = $this->collector->getGlobalConstants();

        return array_map(function ($file, $constant) {
            return "$file <fg=red> --> </> $constant";
        }, array_keys($globalConstants), $globalConstants);
    }
}