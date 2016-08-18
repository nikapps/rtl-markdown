<?php
namespace Nikapps\RtlMarkDown;

class RtlDetector
{
    /*
     * Right-to-left Unicode blocks for modern scripts are:
     *
     * Consecutive range of the main letters:
     * U+0590  to U+05FF  - Hebrew
     * U+0600  to U+06FF  - Arabic/Persian
     * U+0700  to U+074F  - Syriac
     * U+0750  to U+077F  - Arabic Supplement
     * U+0780  to U+07BF  - Thaana
     * U+07C0  to U+07FF  - N'Ko
     * U+0800  to U+083F  - Samaritan
     *
     * Arabic Extended:
     * U+08A0  to U+08FF  - Arabic Extended-A
     *
     * Consecutive presentation forms:
     * U+FB1D  to U+FB4F  - Hebrew presentation forms
     * U+FB50  to U+FDFF  - Arabic presentation forms A
     *
     * More Arabic presentation forms:
     * U+FE70  to U+FEFF  - Arabic presentation forms B
     *
     * @see https://github.com/twitter/RTLtextarea/blob/master/src/RTLText.module.js
     */
    protected $rtlCharacters = '/([\x{0590}-\x{083F}]|[\x{08A0}-\x{08FF}]|[\x{FB1D}-\x{FDFF}]|[\x{FE70}-\x{FEFF}])/iu';
    protected $ignoredCharacters = '/[^\pL\pN]/iu';
    protected $rtlThreshold = 0.3;

    public function isRtl($text)
    {
        $characters = $this->characters(trim($text));
        $totalCharacters = 0;
        $totalRtlCharacters = 0;

        foreach ($characters as $character) {
            if ($this->isIgnoredCharacter($character)) {
                continue;
            }
            $totalCharacters++;
            if ($this->isRtlCharacter($character)) {
                $totalRtlCharacters++;
            }
        }

        return ($totalRtlCharacters / $totalCharacters) >= $this->rtlThreshold;
    }

    protected function characters($text)
    {
        return preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
    }

    /**
     * @param string $character
     * @return bool
     */
    protected function isIgnoredCharacter($character)
    {
        return preg_match($this->ignoredCharacters, $character);
    }

    /**
     * @param string $character
     * @return bool
     */
    protected function isRtlCharacter($character)
    {
        return preg_match($this->rtlCharacters, $character);
    }
}