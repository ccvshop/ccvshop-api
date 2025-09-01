<?php

use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

$finder = (new PhpCsFixer\Finder())
    ->in(getcwd())
    ->exclude([
        'vendor',
    ]);

return (new PhpCsFixer\Config())
    ->setParallelConfig(ParallelConfigFactory::detect())
    ->setUsingCache(false)
    ->setFormat('txt')
    ->setRules([
        '@Symfony' => true,
        'concat_space' => ['spacing' => 'one'],
        'yoda_style' => ['equal' => false, 'identical' => false, 'less_and_greater' => false],
        'increment_style' => ['style' => 'post'],
        'no_mixed_echo_print' => ['use' => 'print'],
        'not_operator_with_space' => false,
        'not_operator_with_successor_space' => true,
        'no_superfluous_phpdoc_tags' => false,
        'phpdoc_to_comment' => ['ignored_tags' => ['var', 'SuppressWarnings']],
        'types_spaces' => ['space_multiple_catch' => 'single'],
    ])
    ->setFinder($finder);
