<?php

class __Mustache_b6e10a7ecd2f485e750dfb83958ce9eb extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '
';
        $value = $context->find('hasactionlinks');
        if (empty($value)) {
            
            if ($partial = $this->mustache->loadPartial('core_course/addresourceoractivitybutton')) {
                $buffer .= $partial->renderInternal($context, $indent . '    ');
            }
        }
        $buffer .= $indent . '
';
        $value = $context->find('hasactionlinks');
        $buffer .= $this->section5f24f1d81c1ce7286da48c9642130991($context, $indent, $value);

        return $buffer;
    }

    private function sectionAcd66ef23857ba2b241b6f8f23ef69c2(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' {{activityname}} ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= ' ';
                $value = $this->resolveValue($context->find('activityname'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= ' ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section244607ab42f64f3e7b0f1d4b2d5b2758(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'insertcontentbefore, core, { "activityname": {{#quote}} {{activityname}} {{/quote}} } ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'insertcontentbefore, core, { "activityname": ';
                $value = $context->find('quote');
                $buffer .= $this->sectionAcd66ef23857ba2b241b6f8f23ef69c2($context, $indent, $value);
                $buffer .= ' } ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section5aea184c6a232a3dbce55dc55666255b(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'addcontent, core';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'addcontent, core';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section9b089e00077ec061918a3e4dd2d05479(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' t/add, core ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= ' t/add, core ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section2522d158b0509584ae9e4e73dac18980(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            {{> core/action_link}}
        ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                if ($partial = $this->mustache->loadPartial('core/action_link')) {
                    $buffer .= $partial->renderInternal($context, $indent . '            ');
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section5f24f1d81c1ce7286da48c9642130991(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
<div class="dropdown">
    <button class="btn add-content d-flex justify-content-center align-items-center p-1 icon-no-margin"
            type="button"
            id="dropdownMenuButton"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
            aria-label="{{#str}}insertcontentbefore, core, { "activityname": {{#quote}} {{activityname}} {{/quote}} } {{/str}}"
            tabindex="0"
            title="{{#str}}addcontent, core{{/str}}"
    >
        {{#pix}} t/add, core {{/pix}}
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        {{> core_course/addresourceoractivitybutton }}
        {{#actionlinks}}
            {{> core/action_link}}
        {{/actionlinks}}
    </div>
</div>
';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '<div class="dropdown">
';
                $buffer .= $indent . '    <button class="btn add-content d-flex justify-content-center align-items-center p-1 icon-no-margin"
';
                $buffer .= $indent . '            type="button"
';
                $buffer .= $indent . '            id="dropdownMenuButton"
';
                $buffer .= $indent . '            data-toggle="dropdown"
';
                $buffer .= $indent . '            aria-haspopup="true"
';
                $buffer .= $indent . '            aria-expanded="false"
';
                $buffer .= $indent . '            aria-label="';
                $value = $context->find('str');
                $buffer .= $this->section244607ab42f64f3e7b0f1d4b2d5b2758($context, $indent, $value);
                $buffer .= '"
';
                $buffer .= $indent . '            tabindex="0"
';
                $buffer .= $indent . '            title="';
                $value = $context->find('str');
                $buffer .= $this->section5aea184c6a232a3dbce55dc55666255b($context, $indent, $value);
                $buffer .= '"
';
                $buffer .= $indent . '    >
';
                $buffer .= $indent . '        ';
                $value = $context->find('pix');
                $buffer .= $this->section9b089e00077ec061918a3e4dd2d05479($context, $indent, $value);
                $buffer .= '
';
                $buffer .= $indent . '    </button>
';
                $buffer .= $indent . '    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
';
                if ($partial = $this->mustache->loadPartial('core_course/addresourceoractivitybutton')) {
                    $buffer .= $partial->renderInternal($context, $indent . '        ');
                }
                $value = $context->find('actionlinks');
                $buffer .= $this->section2522d158b0509584ae9e4e73dac18980($context, $indent, $value);
                $buffer .= $indent . '    </div>
';
                $buffer .= $indent . '</div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
