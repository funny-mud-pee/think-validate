<?php

use funnymudpee\thinkphp\Validate;
use think\exception\ValidateException;

/**
 * @param $ruleOrValidator
 * @param array $data
 * @param array $message
 * @return Validate
 */
function quick_validate($ruleOrValidator, array &$data = [], array $message = []): Validate
{
    if (is_array($ruleOrValidator) || '' === $ruleOrValidator) {
        $v = new Validate();
        if (is_array($ruleOrValidator)) {
            $v->rule($ruleOrValidator);
        }
    } else {
        if (strpos($ruleOrValidator, '.')) {
            // 支持场景
            [$ruleOrValidator, $scene] = explode('.', $ruleOrValidator);
        }
        $class = false !== strpos($ruleOrValidator, '\\') ? $ruleOrValidator : app()->parseClass('validate', $ruleOrValidator);
        /** @var Validate $v */
        $v = new $class();
        if (!empty($scene)) {
            $v->scene($scene);
        }
    }
    $data = $data ?: request()->param();
    $v->message($message)->batch(false)->failException(true)->check($data);
    return $v;
}