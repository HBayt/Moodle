<?php

class __Mustache_843efb658aa8d32ca166c036fd6e6f8a extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';

        $buffer .= $indent . '<div id="';
        $value = $this->resolveValue($context->find('idnumber'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '" class="progressbar_container mb-3 ';
        $value = $this->resolveValue($context->find('class'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '" data-recordid="';
        $value = $this->resolveValue($context->find('id'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '">
';
        $buffer .= $indent . '    <div class="progress">
';
        $buffer .= $indent . '        <div id="';
        $value = $this->resolveValue($context->find('idnumber'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '_bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-value="';
        $value = $this->resolveValue($context->find('value'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '" aria-valuemin="0" aria-valuemax="100" style="width: ';
        $value = $this->resolveValue($context->find('value'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '%"></div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '    <div class="d-flex">
';
        $buffer .= $indent . '        <div style="flex: 1 1 0; min-width: 0;">
';
        $buffer .= $indent . '            <div id="';
        $value = $this->resolveValue($context->find('idnumber'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '_status" class="text-truncate">&nbsp;</div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '        <div class="text-end ps-3" style="flex: 0 0 content">
';
        $buffer .= $indent . '            <span id="';
        $value = $this->resolveValue($context->find('idnumber'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '_estimate" class="">&nbsp;</span>
';
        $buffer .= $indent . '            <span id="';
        $value = $this->resolveValue($context->find('idnumber'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '_percentage" class="d-inline-block" style="width: 3em">';
        $value = $this->resolveValue($context->find('value'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '%</span>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<script>
';
        $buffer .= $indent . '(function() {
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    let el = document.getElementById(\'';
        $value = $this->resolveValue($context->find('idnumber'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\');
';
        $buffer .= $indent . '    let progressBar = document.getElementById(\'';
        $value = $this->resolveValue($context->find('idnumber'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '_bar\');
';
        $buffer .= $indent . '    let statusIndicator = document.getElementById(\'';
        $value = $this->resolveValue($context->find('idnumber'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '_status\');
';
        $buffer .= $indent . '    let estimateIndicator = document.getElementById(\'';
        $value = $this->resolveValue($context->find('idnumber'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '_estimate\');
';
        $buffer .= $indent . '    let percentageIndicator = document.getElementById(\'';
        $value = $this->resolveValue($context->find('idnumber'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '_percentage\');
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // Change background colour to red if there was an error.
';
        $buffer .= $indent . '    if (';
        $value = $this->resolveValue($context->find('error'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= ' == 1) {
';
        $buffer .= $indent . '        el.querySelector(\'.progress-bar\').style.background = \'red\';
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    el.addEventListener(\'update\', function(e) {
';
        $buffer .= $indent . '        var msg = e.detail.message,
';
        $buffer .= $indent . '            percent = e.detail.percent,
';
        $buffer .= $indent . '            estimate = e.detail.estimate
';
        $buffer .= $indent . '            error = e.detail.error;
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        statusIndicator.textContent = msg;
';
        $buffer .= $indent . '        progressBar.style.width = percent.toFixed(1) + \'%\';
';
        $buffer .= $indent . '        progressBar.setAttribute(\'value\', percent.toFixed(1));
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        if (error) {
';
        $buffer .= $indent . '            progressBar.classList.add(\'bg-danger\');
';
        $buffer .= $indent . '            progressBar.classList.remove(\'bg-success\');
';
        $buffer .= $indent . '            estimateIndicator.textContent = \'\';
';
        $buffer .= $indent . '        } else if (percent === 100) {
';
        $buffer .= $indent . '            progressBar.classList.add(\'bg-success\');
';
        $buffer .= $indent . '            progressBar.classList.remove(\'progress-bar-striped\');
';
        $buffer .= $indent . '            progressBar.classList.remove(\'progress-bar-animated\');
';
        $buffer .= $indent . '            percentageIndicator.textContent = \'100%\';
';
        $buffer .= $indent . '            estimateIndicator.textContent = \'\';
';
        $buffer .= $indent . '        } else {
';
        $buffer .= $indent . '            estimateIndicator.textContent = estimate;
';
        $buffer .= $indent . '            percentageIndicator.textContent =  percent.toFixed(1) + \'%\';
';
        $buffer .= $indent . '            progressBar.classList.remove(\'bg-success\');
';
        $buffer .= $indent . '        }
';
        $buffer .= $indent . '    });
';
        $buffer .= $indent . '})();
';
        $buffer .= $indent . '</script>
';

        return $buffer;
    }
}
