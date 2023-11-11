<?php

namespace App\Traits;

trait HelperTrait
{
    protected function removeSpeicalCharacters(string $text): string
    {
        $cleanedString = preg_replace('/[^A-Za-z0-9]/', '', $text);
        return $cleanedString;
    }

    protected function generateFileName(string $name, string $ext, string $casing = 'lw'): string
    {
        $generatedName = $this->removeSpeicalCharacters($name) . '-' . date('YmdHis') . '-' . mt_rand(100000, 999999);
        if ($casing === 'up') {
            $generatedName = strtoupper($generatedName);
        } else {
            $generatedName = strtolower($generatedName);
        }
        $generatedName = $generatedName . '.' . strtolower($ext);
        return $generatedName;
    }
}
