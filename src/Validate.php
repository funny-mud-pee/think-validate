<?php


namespace funnymudpee\thinkphp;


class Validate extends \think\Validate
{

    private array $data;

    public function __construct()
    {
        parent::__construct();
        // 控制器初始化
        $this->initialize();
    }


    // 初始化
    protected function initialize()
    {
    }

    public function rules(): array
    {
        return $this->rule;
    }
}