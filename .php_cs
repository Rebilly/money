<?php
/**
 * This source file is proprietary and part of Rebilly.
 *
 * (c) Rebilly SRL
 *     Rebilly Ltd.
 *     Rebilly Inc.
 *
 * @see https://www.rebilly.com
 */

declare(strict_types=1);

$header = <<<'EOF'
This source file is proprietary and part of Rebilly.

(c) Rebilly SRL
    Rebilly Ltd.
    Rebilly Inc.

@see https://www.rebilly.com
EOF;

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules(
        [
            '@PSR2' => true,
            'array_syntax' => ['syntax' => 'short'],
            'binary_operator_spaces' => true,
            'blank_line_before_statement' => true,
            'cast_spaces' => true,
            'class_attributes_separation' => true,
            'combine_consecutive_issets' => true,
            'combine_consecutive_unsets' => true,
            'compact_nullable_typehint' => true,
            'concat_space' => ['spacing' => 'one'],
            'declare_equal_normalize' => ['space' => 'none'],
            // 'declare_strict_types' => true,
            'dir_constant' => true,
            'ereg_to_preg' => true,
            'explicit_indirect_variable' => true,
            'explicit_string_variable' => true,
            'general_phpdoc_annotation_remove' => ['annotations' => ['author', 'version']],
            'global_namespace_import' => [
                'import_classes' => true,
                'import_constants' => true,
                'import_functions' => true,
            ],
            // 'header_comment' => [
            //     'header' => $header,
            //     'commentType' => 'PHPDoc',
            //     'separate' => 'bottom',
            //     'location' => 'after_open',
            // ],
            'heredoc_to_nowdoc' => true,
            'increment_style' => ['style' => 'pre'],
            'list_syntax' => ['syntax' => 'short'],
            'lowercase_cast' => true,
            'magic_constant_casing' => true,
            'mb_str_functions' => true,
            'method_argument_space' => ['ensure_fully_multiline' => true],
            'method_chaining_indentation' => true,
            'modernize_types_casting' => true,
            'native_function_casing' => true,
            // 'native_function_invocation' => true,
            'new_with_braces' => true,
            'no_alias_functions' => true,
            'no_blank_lines_after_class_opening' => true,
            'no_blank_lines_after_phpdoc' => true,
            'no_empty_comment' => true,
            'no_empty_phpdoc' => true,
            'no_empty_statement' => true,
            'no_extra_blank_lines' => ['tokens' => ['break', 'continue', 'extra', 'return', 'throw', 'use', 'parenthesis_brace_block', 'square_brace_block', 'curly_brace_block']],
            'no_homoglyph_names' => true,
            'no_leading_import_slash' => true,
            'no_leading_namespace_whitespace' => true,
            'no_mixed_echo_print' => true,
            'no_multiline_whitespace_around_double_arrow' => true,
            'no_null_property_initialization' => true,
            'no_php4_constructor' => true,
            'no_short_bool_cast' => true,
            'no_singleline_whitespace_before_semicolons' => true,
            'no_spaces_around_offset' => true,
            'no_superfluous_elseif' => true,
            'no_trailing_comma_in_singleline_array' => true,
            'no_unneeded_control_parentheses' => true,
            'no_unneeded_curly_braces' => true,
            'no_unneeded_final_method' => true,
            'no_unreachable_default_argument_value' => true,
            'no_unused_imports' => true,
            'no_useless_else' => true,
            'no_useless_return' => true,
            'no_whitespace_before_comma_in_array' => true,
            'no_whitespace_in_blank_line' => true,
            'normalize_index_brace' => true,
            'ordered_class_elements' => true,
            'ordered_imports' => true,
            'php_unit_construct' => true,
            'php_unit_dedicate_assert' => true,
            'php_unit_expectation' => true,
            'php_unit_mock' => true,
            'php_unit_namespaced' => true,
            'php_unit_no_expectation_annotation' => true,
            'php_unit_strict' => true,
            'php_unit_test_annotation' => ['style' => 'prefix'],
            'phpdoc_add_missing_param_annotation' => true,
            // Temporary disabled because @inheritdoc can be explicit inheritance tag now
            // see: https://github.com/FriendsOfPHP/PHP-CS-Fixer/pull/2619
            // 'phpdoc_inline_tag' => true,
            'phpdoc_no_access' => true,
            'phpdoc_no_alias_tag' => true,
            'phpdoc_no_empty_return' => true,
            'phpdoc_no_package' => true,
            'phpdoc_no_useless_inheritdoc' => true,
            'phpdoc_order' => true,
            'phpdoc_separation' => true,
            'phpdoc_types_order' => true,
            'phpdoc_var_without_name' => true,
            'pow_to_exponentiation' => true,
            'protected_to_private' => true,
            'random_api_migration' => true,
            'return_type_declaration' => true,
            'self_accessor' => true,
            'semicolon_after_instruction' => true,
            'short_scalar_cast' => true,
            'single_blank_line_before_namespace' => true,
            'single_line_comment_style' => true,
            'single_quote' => true,
            'standardize_not_equals' => true,
            'strict_comparison' => true,
            'strict_param' => true,
            'ternary_to_null_coalescing' => true,
            'trailing_comma_in_multiline_array' => true,
            'trim_array_spaces' => true,
            'unary_operator_spaces' => true,
            'yoda_style' => false,
            'object_operator_without_whitespace' => true,
        ]
    )
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->exclude(['vendor', 'src/views'])
            ->in([__DIR__ . '/src', __DIR__ . '/tests'])
    );
