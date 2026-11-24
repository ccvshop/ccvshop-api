<?php

use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

$root = getenv('CI_PROJECT_DIR') ?: getcwd();

$finder = (new PhpCsFixer\Finder())
    ->in($root)
    ->exclude([
        'vendor',
    ]);

return (new PhpCsFixer\Config())
    ->setParallelConfig(ParallelConfigFactory::detect())
    ->setUsingCache(false)
    ->setFormat('txt')
    ->setRules([
        '@Symfony' => true,
        'binary_operator_spaces' => [
            'operators' => [
                '=' => 'at_least_single_space',
                '+=' => 'at_least_single_space',
                '-=' => 'at_least_single_space',
                '.=' => 'at_least_single_space',
                '??=' => 'at_least_single_space',
                '=>' => 'at_least_single_space',
            ],
        ],
        'concat_space' => ['spacing' => 'one'],
        'increment_style' => ['style' => 'post'],
        'no_mixed_echo_print' => ['use' => 'print'],
        'no_unneeded_control_parentheses' => ['statements' => ['break', 'clone', 'continue', 'echo_print', 'return', 'switch_case', 'yield']],
        'no_superfluous_phpdoc_tags' => false,
        'not_operator_with_space' => false,
        'not_operator_with_successor_space' => false,
        'phpdoc_to_comment' => ['ignored_tags' => ['var']],
        'types_spaces' => ['space_multiple_catch' => 'single'],
        'yoda_style' => ['equal' => false, 'identical' => false, 'less_and_greater' => false],
    ])
    ->setFinder($finder);
