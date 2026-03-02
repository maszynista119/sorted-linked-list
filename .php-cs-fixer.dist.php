<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests')
;

return (new PhpCsFixer\Config())
    ->setRules([
        'declare_strict_types' => true,
        'no_unused_imports' => true,
        'single_blank_line_at_eof' => true,
        'array_syntax' => ['syntax' => 'short'],
        'braces' => true,
        'blank_line_after_opening_tag' => true,
        'phpdoc_separation' => true,
        'no_extra_blank_lines' => true,
        'concat_space' => ['spacing' => 'one'],
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true)
;
