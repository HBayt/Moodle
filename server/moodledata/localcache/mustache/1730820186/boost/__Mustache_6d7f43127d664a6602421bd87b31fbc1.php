<?php

class __Mustache_6d7f43127d664a6602421bd87b31fbc1 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '
';
        $value = $context->find('legacycss');
        $buffer .= $this->sectionDc7d5a5b9dc4560fa9f21e6552e8aa79($context, $indent, $value);
        $buffer .= $indent . '
';
        $buffer .= $indent . '<!-- Button to Open the Modal -->
';
        $buffer .= $indent . '<button id="adminerlauncher" type="button" class="btn btn-primary" data-toggle="modal" data-target="#local-adminer-modal">
';
        $buffer .= $indent . '    ';
        $value = $this->resolveValue($context->find('adminerlaunchtitle'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '
';
        $buffer .= $indent . '</button>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<!-- The Modal -->
';
        $buffer .= $indent . '<div class="modal fade" id="local-adminer-modal">
';
        $buffer .= $indent . '    <div class="modal-dialog">
';
        $buffer .= $indent . '        <div class="modal-content">
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '            <!-- Modal Header -->
';
        $buffer .= $indent . '            <div class="modal-header">
';
        $buffer .= $indent . '                <h4 class="modal-title">';
        $value = $this->resolveValue($context->find('title'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '</h4>
';
        $buffer .= $indent . '                <button type="button" class="close" data-dismiss="modal">&times;</button>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '            <!-- Modal body -->
';
        $buffer .= $indent . '            <div class="modal-body embed-responsive embed-responsive-16by9">
';
        $buffer .= $indent . '                <iframe id="adminer-frame"
';
        $buffer .= $indent . '                    class="embed-responsive-item"
';
        $buffer .= $indent . '                    src="about:blank"
';
        $buffer .= $indent . '                    allowfullscreen >
';
        $buffer .= $indent . '                </iframe>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '            <!-- Modal footer -->
';
        $buffer .= $indent . '            <div class="modal-footer">
';
        $buffer .= $indent . '                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</div>
';
        $value = $context->find('js');
        $buffer .= $this->section2b2a0b916de0764a0132bf8a9821eae5($context, $indent, $value);

        return $buffer;
    }

    private function sectionDc7d5a5b9dc4560fa9f21e6552e8aa79(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <link rel="stylesheet" href="{{{legacycss}}}">
';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '    <link rel="stylesheet" href="';
                $value = $this->resolveValue($context->find('legacycss'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '">
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section2b2a0b916de0764a0132bf8a9821eae5(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    require([\'local_adminer/modal_events\', \'local_adminer/add_css\'], function(modalevents, addcss) {
        modalevents.init(\'{{{adminerurl}}}\');
        // The value modalcss must be in back ticks because it has multilines!
        addcss.init(`{{{modalcss}}}`);
    });
';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '    require([\'local_adminer/modal_events\', \'local_adminer/add_css\'], function(modalevents, addcss) {
';
                $buffer .= $indent . '        modalevents.init(\'';
                $value = $this->resolveValue($context->find('adminerurl'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '\');
';
                $buffer .= $indent . '        // The value modalcss must be in back ticks because it has multilines!
';
                $buffer .= $indent . '        addcss.init(`';
                $value = $this->resolveValue($context->find('modalcss'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '`);
';
                $buffer .= $indent . '    });
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
