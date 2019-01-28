<?php
declare(strict_types=1); // on PHP 7+ are standard PHP methods strict to types of given parameters

namespace DrdPlus\Tables\Armaments\Partials;

interface StrengthSanctionsInterface
{
    /**
     * @param int $missingStrength
     * @return bool
     */
    public function canUseIt(int $missingStrength): bool;
}