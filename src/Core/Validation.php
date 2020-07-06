<?php

namespace Wiloke\Core;


class Validation
{
    protected $aParams = [];
    protected $aErrors = [];
    
    public function make(array $param)
    {
        $this->aParams = $param;
        
        return $this;
    }
    
    /**
     * @param $aConditionals
     */
    public function passedAllConditional($aConditionals)
    {
        foreach ($aConditionals as $conditional) {
            $isNegative = strpos($conditional, '!') !== false;
            $functionCB = str_replace('!', '', $conditional);
            if (!function_exists($functionCB)) {
                $this->aErrors[] = sprintf('The method %s does not exists', $functionCB);
                
                return false;
            }
            $status = call_user_func_array($functionCB, $this->aParams);
            if (($isNegative && !$status) || (!$isNegative && !$status)) {
                $this->aErrors[] = sprintf('The function %s returned false', $functionCB);
                
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * @param $aConditionals
     *
     * @return bool
     */
    public function passedConditional($aConditionals)
    {
        if (isset($aConditionals[0]) && is_array($aConditionals[0])) {
            foreach ($aConditionals as $aGroupConditional) {
                $status = $this->passedAllConditional($aGroupConditional);
                if (!$status) {
                    return false;
                }
            }
            
            return true;
        }
        
        return $this->passedAllConditional($aConditionals);
    }
    
    public function hasError()
    {
        return !empty($this->aErrors);
    }
    
    public function getErrors()
    {
        return $this->aErrors;
    }
}
