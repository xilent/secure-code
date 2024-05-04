<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Classes\Validators;

use Veeqtoh\DoorAccess\Classes\Traits\ConfigTrait;
use Veeqtoh\DoorAccess\Contracts\CodeValidator;

/**
 * Class MinimumUniqueCharactersValidator
 * This class provides validation against minimum unique characters.
 *
 * @package Veeqtoh\DoorAccess\Classes\Validators
 */
class MinimumUniqueCharactersValidator implements CodeValidator
{
    use ConfigTrait;
    
    public function isValid(string $code): bool
    {
        $allowedCharactersCount = count_chars($this->getAllowedCharacters(), 1);
        $codeCharactersCount    = count_chars($code, 1);

        $uniqueCharactersCount = 0;

        foreach ($codeCharactersCount as $character => $count) {
            if (isset($allowedCharactersCount[$character])) {
                $uniqueCharactersCount++;
            }
        }

        return $uniqueCharactersCount >= $this->getCharacterRepeatedLimit();
    }

}